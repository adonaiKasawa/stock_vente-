<?php

class Users extends Controller {

    function __construct() {
        parent::__construct();

        //redirection si la session est off
        Session::init();
        $logged = Session::get('connected');
        $privilege = Session::get('privilege');
        $etat = Session::get('etat');
        $login = Session::get('login');

        if ($logged == false || ($privilege !='1') || $etat != 'actif') {
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
        $this->view->js = array('users/js/default.js');
        $this->view->css = array('users/css/default.css');
    }

    /**
     * Donne la home page du module users
     */
    function index() {

        //recupere la liste des users
        $this->view->users_list = $this->model->users_list();

        $this->view->render('users/index', false);
    }

    /**
     * Insert un nouveau user dans la base
     */
    function new_user() {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $user_titre = $_POST['user_titre'];
        $user_poste = $_POST['user_poste'];
        $user_sexe = $_POST['user_sexe'];
        $confirme_password = $_POST['confirme_password'];
        $privilege = $_POST['privilege'];
        $etat = $_POST['etat'];

        //Insert user
        $result = $this->model->insert_user($prenom, $nom,$login, $password, $user_titre, $user_poste, $user_sexe, $privilege, $etat);

        if ($result) {
            echo 'inserted';
        } else {
            echo 'not_inserted';
        }
    }

    /**
     * Montre un user avec tout les details
     * @param int $user_id
     */
    function show_one() {
        
        $user_id = $_POST['user_id'];

        //return all of this user
        $user = $this->model->get_user($user_id);

        echo json_encode($user);
    }

    //validation des modification effectuer
    function edit_user() {
        $users_id = $_POST['hidden_users_id'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $login = $_POST['login'];
        $privilege = $_POST['privilege'];
        $etat = $_POST['etat'];
        

        //done_edition
        $return = $this->model->admin_edit_user($users_id, $prenom, $nom, $login, $privilege, $etat);

        if ($return) {
            echo 'bien';
        } else {
            echo 'pas_bien';
        }
    }

    /**
     * Voir son propre profil
     */
    function profil() {
        //return all of this user
        $this->view->user = $this->model->get_user(Session::get('user_id'));

        $this->view->render('users/profil', false);
    }

    function save_profil_edit() {
        $user_id = $_POST['hidden_user_id'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $confirme_password = $_POST['confirme_password'];

        if ($prenom == '' || $nom == '' || $login == '' || $password == '' || $confirme_password == '') {
            header('location: ' . URL . 'users/profil/?message=champs_vide');
        } else {
            if ($password != $confirme_password) {
                header('location: ' . URL . 'users/profil/?message=confirmation_invalide');
            } else {

                //done_edition
                $return = $this->model->edit_own_account($user_id,$prenom,$nom,$email,$login,$password);

                if ($return) {
                    header('location: ' . URL . 'users/profil/');
                } else {
                    header('location: ' . URL . 'users/edit_user/' . $user_id . '/?message=echec');
                }
            }
        }
    }

    /**
     * make user active
     */
    function active_user() {

        $user_id = $_POST['user_id'];

        // make user active
        $result = $this->model->active_user($user_id);

        if ($result) {
            echo 'done';
        } else {
            echo 'failed';
        }
    }

    /**
     * make user inactive
     */
    function block_user() {

        $user_id = $_POST['user_id'];

        // make user inactive
        $result = $this->model->block_user($user_id);

        if ($result) {
            echo 'done';
        } else {
            echo 'failed';
        }
    }

}
