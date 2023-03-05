<?php

class Configuration extends Controller
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
        $this->view->js = array('configuration/js/default.js');
        $this->view->css = array('configuration/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index()
    {
        $this->view->render('configuration/index');
    }

    // Render de la page produit et categorie
    function produit()
    {
        $this->view->categories =  $this->model->getAll('categorie');
        $this->view->produits = $this->model->getAll("produit");
        $this->view->render('configuration/produits');
    }
     // Render de la page produit et categorie
    function fournisseurs()
    {
      $this->view->fournisseur =  $this->model->getAll('fournisseur');
      $this->view->render('configuration/fournisseur');
    }

    function categorie()
    {
      $this->view->fournisseur =  $this->model->getAll('categorie');
      $this->view->render('configuration/categorie');
    }

    function utilisateur()
    {
      $this->view->fournisseur =  $this->model->getAll('categorie');
      $this->view->render('configuration/utilisateur');
    }

    // Donne les donnes initiales pour les categories (DataTables)
    function categorie_datatable(){
        $this->model->xhr_categorie_DataTable();
    }
    // Donne les donnes initiales pour les produits (DataTables)
    function produit_datatable(){
      $this->model->xhr_produit_DataTable();
    }

    // Donne les donnes initiales pour les entreée mise en vente (DataTables)
    function prix_produit_datatable()
    {
      $this->model->xhr_prix_produit_DataTable();
    }

    // Ajouter une categorie
    function ajouter_categorie()
    {
        $result =  $this->model->ajouter_categorie($_POST['designation'], $_POST['description']);

        $std = new stdClass();
        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        echo json_encode($std);
    }

    // Ajouter un produit
    function ajouter_produit()
    {
        $result =  $this->model->ajouter_produit($_POST['designation_prod'], $_POST['barcode'],$_POST['caracteristique'],(int) $_POST['categorie_prod']);

        $std = new stdClass();
        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        echo json_encode($std);
    }

    function getEntreeByProduit()
    {
      if (isset($_POST["produit"])) {
        $produit = htmlspecialchars($_POST["produit"]);
        $get = $this->model->getEntreeByProduit($produit);
        $ouput = '<option value="NULL">Choisir une entree</option>';
        if (!empty($get)) {
          foreach ($get as $key) {
            $ouput .= '<option value="'.$key['entrees_id'].'" data-prix="'.$key['prix_entrees'].'">' . $key['designation'] . '(Qt: ' . $key['qt_entrees'] . '; Prix: ' . $key['prix_entrees'] . 'FC )</option>';
          }
        }
        echo $ouput;
      }
    }

    function getEntreeById()
    {
      if (isset($_POST["id_entree"])) {
        $id_entree = htmlspecialchars($_POST["id_entree"]);
        $get = $this->model->getEntreeById($id_entree);
        if (!empty($get)) {
          echo $get[0]['prix_entrees'];
        }
      }
    }

    function validet_mise_envente()
    {
      $prix = htmlspecialchars($_POST["prix"]);
      $id_entree = htmlspecialchars($_POST['id_entree']);
      if (!empty($prix) && !empty($id_entree)) {
        $checkExiste = $this->model->check_entree_in_prix_produit($id_entree);
        if (empty($checkExiste)) {
          $create = $this->model->insert_in_prix_produit(array(
            "created_time" => $this->date_time(),
            "id_entrees" => (int) $id_entree,
            "prix" => (int) $prix
          ));
          if ($create) {
            $update = $this->model->update_entree("entrees", array("status_entrees" => "onsale"), (int) $id_entree);
            if ($update) {
              echo "success";
            }else{
              $delete = $this->model->delete_entree_mise_envente((int) $id_entree);
              if($delete){
                echo "failed_to_create";
              }else{
                $this->model->delete_entree_mise_envente((int) $id_entree);
                echo "failed_to_create";
              }
            }
          }else{
            echo "failed_to_create";
          }
        }else {
          echo "enter_is_existe";
        }
      }else{
        echo "champt_vide";
      }
    }
}
