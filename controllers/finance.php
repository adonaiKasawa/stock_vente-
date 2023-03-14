<?php

class Finance extends Controller {

    function __construct() {
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
        }else{
            //si tout va bien
            Session::set('connect_valide', true);
        }
        /**
         * insertion des js et css particulier pour ce module
         */
        $this->view->js = array('finance/js/default.js');
        $this->view->css = array('finance/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index() {
        $this->view->render('finance/index');
    }

    function getAllFinance()
    {
        $totalAchat = 0;
        $totalVente = 0;
        $beneficeAttendu = 0;
        $beneficeRealise = 0;
        $perte = 0;
        $totalTva = 0;

        $getEntree = $this->model->getEntree();
        foreach ($getEntree as $key) {
            $totalAchat += $key["prix_entrees"] * $key["qt_entrees"];
        }

        $getVentes = $this->model->getVente();
        foreach ($getVentes as $ventes) {
            $totalVente += $ventes["prix"] * $ventes["qt_produit"];
            $beneficeRealise += ($ventes['prix'] - $ventes['prix_entrees']) * $ventes['qt_produit'];
        }

        $getPrixProduit = $this->model->getPrixProduit();
        foreach ($getPrixProduit as $row) {
           $beneficeAttendu += ($row['prix'] - $row['prix_entrees']) * $row['qt_entrees'];
        }
        $perte = $beneficeAttendu - $beneficeRealise;
        echo json_encode(array(
            "totalAchat" => $totalAchat,
            "totalVente" => $totalVente,
            "beneficeAttendu" => $beneficeAttendu,
            "beneficeRealise" => $beneficeRealise,
            "perte" => $perte
        ));
    }

}
