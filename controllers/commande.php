<?php

class Commande extends Controller
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
        $this->view->js = array('commande/js/default.js');
        $this->view->css = array('commande/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index()
    {
        $this->view->fournisseurs =  $this->model->getAll('fournisseur');
        $this->view->produits =  $this->model->getAll('produit');

        $this->view->render('commande/index');
    }

    // Donne les donnes initiales pour les commandes (DataTables)
    function xhr_commandes_DataTable()
    {
        $this->model->xhr_commandes_DataTable();
    }
    // Donne les donnees initiales les commandes (date), filtre (DataTables)
    function xhrDatatableGetCommandeDate($date)
    {
        $this->model->xhr_commandes_DataTable('date', $date, null, null, $_GET['fournisseur'], $_GET['etat']);
    }
    // Donne les donnees initiales les commandes (periode), filtre (DataTables)
    function xhrDatatableGetCommandePeriode($datedebut, $datefin)
    {
        $this->model->xhr_commandes_DataTable('periode', null, $datedebut, $datefin, $_GET['fournisseur'], $_GET['etat']);
    }


    // Ajouter une commande
    function ajouter_une_commande()
    {
        $std = new stdClass();
        $tab_produit_commande = json_decode($_POST['details_commande']);
        $date_commande = $_POST['ajout_commande_date'];
        $fournisseur = $_POST['ajout_commande_fournisseur'];

        $result_inserted_commande =  $this->model->insert_commande($date_commande, $fournisseur, Session::get('user_id'));

        if ($result_inserted_commande) {
            foreach ($tab_produit_commande as $key => $row) {
                $this->model->insert_commande_produit($row[0], $row[2], $result_inserted_commande);
            }
        }

        if ($result_inserted_commande) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        echo json_encode($std);
    }

    // Valider commande
    function valider_commande()
    {
        $std = new stdClass();
        $result = $this->model->valider_commande($_POST['commande_id']);
        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        echo json_encode($std);
    }
    // Annuler commande
    function annuler_commande()
    {
        $std = new stdClass();
        $result = $this->model->annuler_commande($_POST['commande_id']);
        if ($result) {
            $std->reponse = 'bien';
        } else {
            $std->reponse = 'pas_bien';
        }
        echo json_encode($std);
    }

    // voir une commande
    function voir_commande()
    {
        $result = $this->model->voir_commande($_POST['commande_id']);
        echo json_encode($result);
    }
}
