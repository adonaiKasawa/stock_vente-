<?php

class Achat extends Controller
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
    $this->view->js = array('achat/js/default.js');
    $this->view->css = array('achat/css/default.css');
  }

  function index()
  {
    $this->view->produits = $this->model->getAll('produit');
    $this->view->render('achat/index');
  }

  function xhr_entrees_DataTable()
  {
    $this->model->xhr_entrees_DataTable();
  }

  function submit_entrees()
  {
    $produit_entree = htmlspecialchars($_POST["produit_entree"]);
    $quantite_entree = htmlspecialchars($_POST["quantite_entree"]);
    $prix_entree = htmlspecialchars($_POST["prix_entree"]);
    $result = $this->model->submit_entrees(array(
      "created_entree" => $this->date_time(),
      "deleted_entree" => null,
      "id_produit" => (int) $produit_entree,
      "qt_entrees" => (int) $quantite_entree,
      "prix_entrees" => (int) $prix_entree,
      "id_user" => (int) $this->user_id,
      "status_entrees" => "awaiting"
    ));
    $std = new stdClass();
    if ($result) {
      $std->reponse = 'bien';
    } else {
      $std->reponse = 'pas_bien';
    }
    echo json_encode($std);
  }


}
