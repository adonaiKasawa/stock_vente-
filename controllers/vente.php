<?php

class Vente extends Controller
{

  function __construct()
  {
    parent::__construct();

    //redirection si la session est off
    Session::init();
    $logged = Session::get('connected');
    $privilege = Session::get('privilege');
    $etat = Session::get('etat');
    $login = Session::get('login');
    $this->user_id = Session::get("user_id");

    if ($logged == false || $etat != 'actif') {
      //Quand la session est off , le user n'est pas un admin ou le user n'est pas actif
      Session::destroy();
      header('location: ' . URL . 'login');
      exit;
    } else {
      //si tout va bien
      Session::set('connect_valide', true);
    }

    /**
     * insertion des js et css particulier pour ce module
     */
    $this->view->js = array('vente/js/default.js');
    $this->view->css = array('vente/css/default.css');
  }

  function index()
  {
    $this->view->produits = $this->model->getAll('produit');

    $this->view->render('vente/index');
  }

  function effectuer()
  {
    $this->view->produitOnSale = $this->model->getProduitOnSale();
    $this->view->render('vente/effectuer');
  }

  function submit_vente()
  {
    if(isset($_POST["action"]) == "axssmvslpkjdfiowjfscnxlzkdmczx7xcc"){
      // $id_client = htmlspecialchars($_POST["client"]);
      $prodQt = $_POST['prodQt'];
      // print_r($prodQt);
      // die;
      $code = $this->str_random(16);
      if (!empty($prodQt)) {
        $ouput = "";
        foreach ($prodQt as $item) {
          if(!empty($item["id_produit"]) && !empty($item["qt"])){
            $checkEntrees = $this->model->checkQtOnSaleByProduit((int) htmlspecialchars($item["id_produit"]) );
            $getVente = $this->model->getAllSaleByEnterOnSale((int) htmlspecialchars($item["id_produit"]), $checkEntrees[0]["entrees_id"]);
            $getPrixProduitByEnter = $this->model->getPrixProduitByEnter($checkEntrees[0]["entrees_id"]);
            $AllQt = 0;
            foreach ($getVente as $key) {
              $AllQt += $key["qt_produit"];
            }
            if (($AllQt + (int)$item["qt"]) <= $checkEntrees[0]["qt_entrees"]) {
              $createVente = $this->model->submit_vente(array(
                "created_vente" => $this->date_time(),
                "id_produit_prix" => (int) $getPrixProduitByEnter[0]["prix_id"],
                "id_user" => (int) $this->user_id,
                "id_client" =>  0,
                "qt_produit" => (int) $item["qt"],
                "code" => $code,
                "status_ventes" => "sold"
              ));
              if ($createVente) {
                if(($AllQt + (int)$item["qt"]) == $checkEntrees[0]["qt_entrees"]){
                  $update = $this->model->update_entree(array("status_entrees" => "sold"), (int) $checkEntrees[0]["entrees_id"]);
                }
                $ouput = "200";
              }else{
                $ouput = "500";
              }
            }else{
              $ouput = "qt_sup";
            }
          }else{
            $ouput = "champ_vide";
          }
        }
        echo $ouput;
      }else{
        echo "data empty";
      }
    }else{
      echo "401";
    }
  }

  function checkQauntite()
  {
    if (isset($_POST["qt"]) && isset($_POST["id_produit"])) {
      $qt = (int) htmlspecialchars($_POST['qt']);
      $id_produit = (int) htmlspecialchars($_POST['id_produit']);
      $checkEntrees = $this->model->checkQtOnSaleByProduit($id_produit);
      $getVente = $this->model->getAllSaleByEnterOnSale($id_produit, $checkEntrees[0]["entrees_id"]);
      $getPrixProduitByEnter = $this->model->getPrixProduitByEnter($checkEntrees[0]["entrees_id"]);
      $AllQt = 0;
      foreach ($getVente as $key) {
        $AllQt += $key["qt_produit"];
      }
      if (($AllQt +  $qt) <= $checkEntrees[0]["qt_entrees"] ) {
        echo json_encode(array(
          "qt_reste" => $checkEntrees[0]["qt_entrees"] - $AllQt,
          "qt_dem" => $qt,
          "pv" => $getPrixProduitByEnter[0]["prix"],
          "state" => "success"
        ));
      }else{
        echo json_encode(array(
          "qt_reste" => $checkEntrees[0]["qt_entrees"] - $AllQt,
          "qt_dem" => $qt,
          "pv" => $getPrixProduitByEnter[0]["prix"],
          "state" => "error"
        ));
      }
    }
  }

  function xhr_vente_DataTable()
  {
    $this->model->xhr_vente_DataTable();
  }
}















