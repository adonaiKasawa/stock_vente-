<?php

class Logistique extends Controller
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
        $this->view->js = array('logistique/js/default.js');
        $this->view->css = array('logistique/css/default.css');
    }

    /**
     * Affiche l'accueil du module
     */
    function index()
    {
        $this->view->agents =  $this->model->getAll('users');
        $this->view->produits =  $this->model->get_total_from_request("SELECT * FROM  produit");
        $this->view->categories =  $this->model->getAll('categorie');
        $this->view->render('logistique/index');
    }

    // Donne les donnes initiales pour le stock (DataTables)
    function xhr_stock_DataTable()
    {
        $this->model->xhr_stock_DataTable();
    }

    // Donne les donnes initiales bons de livraison (DataTables)
    function xhr_bon_livraison_DataTable()
    {
        $this->model->xhr_bon_livraison_DataTable();
    }

    // Donne les donnes initiales pour le journal de stock (DataTables)
    function xhr_journal_stock_DataTable()
    {
        $this->model->xhr_journal_stock_DataTable();
    }

    // Donne les donnes initiales pour entrée en stock (DataTables)
    function xhr_mouvement_entree_stock_DataTable()
    {
        $this->model->xhr_mouvement_entree_stock_DataTable();
    }
    // Donne les donnees initiales pour entrée en stock (date), mouvement (DataTables)
    function xhrDatatableGetMouvementEntreeDate($date)
    {
        $this->model->xhr_mouvement_entree_stock_DataTable('date', $date, null, null, $_GET['fournisseur'], $_GET['produit'], $_GET['categorie']);
    }
    // Donne les donnees initiales pour entrée en stock  (periode), mouvement (DataTables)
    function xhrDatatableGetMouvementEntreePeriode($datedebut, $datefin)
    {
        $this->model->xhr_mouvement_entree_stock_DataTable('periode', null, $datedebut, $datefin, $_GET['fournisseur'], $_GET['produit'], $_GET['categorie']);
    }


    // Donne les donnes initiales pour Sortie en stock (DataTables)
    function xhr_mouvement_sortie_stock_DataTable()
    {
        $this->model->xhr_mouvement_sortie_stock_DataTable();
    }
    // Donne les donnees initiales pour Sortie en stock (date), mouvement (DataTables)
    function xhrDatatableGetMouvementSortieDate($date)
    {
        $this->model->xhr_mouvement_sortie_stock_DataTable('date', $date, null, null, $_GET['fournisseur'], $_GET['produit'], $_GET['categorie'], $_GET['agent'], $_GET['projet']);
    }
    // Donne les donnees initiales pour Sortie en stock  (periode), mouvement (DataTables)
    function xhrDatatableGetMouvementSortiePeriode($datedebut, $datefin)
    {
        $this->model->xhr_mouvement_sortie_stock_DataTable('periode', null, $datedebut, $datefin, $_GET['fournisseur'], $_GET['produit'], $_GET['categorie'], $_GET['agent'], $_GET['projet']);
    }



    // get stock element by id
    function get_produit_element_by_id()
    {
        $produit_id = $_POST['produit_id'];
        $produit = $this->model->get_total_from_request("SELECT * FROM produit p LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id WHERE produit_id = $produit_id ");
        echo json_encode($produit);
    }

    // Valider approvisionnement
    function valider_approvisionnement()
    {
        // $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/mi_pro/public/images/bon/';
        // $target_file = $target_dir . basename($_FILES["appro_bon_livraison_image"]["name"]);
        // $result_import = move_uploaded_file($_FILES["appro_bon_livraison_image"]["tmp_name"], $target_file);
        // // $result_inserted_bon = true;
        // if ($result_import) {

        //     $result_inserted_bon =  $this->model->insert_bon_livraison($_POST['appro_date'], $_POST['appro_fournisseur'], $_POST['appro_numero_bon'], basename($_FILES["appro_bon_livraison_image"]["name"]), $_POST['appro_commande']);

        //     if ($_POST['appro_commande'] != 'NULL') {
        //         $this->model->set_commande_satisfaite($_POST['appro_commande']);
        //     }

        //     if ($result_inserted_bon) {
        //         $details_bon = json_decode($_POST['details_bon']);
        //         foreach ($details_bon as $key => $row) {
        //             $this->model->insert_detail_bon_livraison($row[2], $result_inserted_bon, $row[4], Session::get('user_id'));
        //             $this->model->approv_update_stock($row[2], $row[4], $result_inserted_bon);
        //         }
        //     }
        // } else {
        //     $result = $result_import;
        // }
        // echo json_encode($result_inserted_bon);
    }
}
