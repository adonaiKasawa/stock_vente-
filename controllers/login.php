<?php
/**
 * Copyright (c) 2022, BUO.
 * Powered by Elysée Asad Luboya
 * Soft-Logistique
 * 
 * @package   Soft-Logistique
 * @author    
 * @copyright Copyright (c) 2022, BUO.  (http://buo-rdc.com)
 * @since     Version 1.0.0
 */

class Login extends Controller {

    function __construct() {
        parent::__construct();

        //initialise la session
        Session::init();

        //redirection si la session est on
        if (Session::get('connect_valide')) {
            header('location: ' . URL . 'home');
        }

        /**
         * insertion des js et css particulier pour ce module
         */
        $this->view->js = array('login/js/default.js');
        $this->view->css = array('login/css/default.css');

    }

    /**
     * Dirige vers la page de connexion
     */
    function index() {
        $this->view->render('login/index', true);
    }

    /**
     * Connexion au systeme
     */
    function connect(){

        $login = htmlspecialchars($_POST['login']);
        //$password = sha1(htmlspecialchars($_POST['password']));
        $password = htmlspecialchars($_POST['password']);

        if ($login == '' || $password == '') {
            $notification = "champs_vide";
            $this->view->login = $login;
            $this->view->notification = $notification;
            $this->view->render('login/index', true);
        } else {

            $user_data = $this->model->connect($login, $password);

            if (empty($user_data)) {
                $notification = "c_pas_ton_compte";
                $this->view->login = $login;
                $this->view->notification = $notification;
                $this->view->render('login/index', true);
            }else if($user_data['etat_user'] == 'inactif'){
                $notification = "not_active";
                $this->view->login = $login;
                $this->view->notification = $notification;
                $this->view->render('login/index', true);
            } else {

                //definit les variables de session
                Session::set('connected', true);
                Session::set('privilege', $user_data['id_privilege']);
                // Session::set('privilege_actions', $privilege_actions);
                Session::set('nom_privilege', $user_data['nom_privilege']);
                Session::set('prenom', $user_data['prenom_user']);
                Session::set('postnom', $user_data['postnom_user']);
                Session::set('nom', $user_data['nom_user']);
                Session::set('sexe', $user_data['sexe_user']);
                Session::set('etat', $user_data['etat_user']);
                Session::set('login', $user_data['login_user']);
                // Session::set('password_user', $user_data['password']);
                Session::set('user_id', $user_data['user_id']);

                //on redirige vers la home page du compte
                header('location: ' . URL . 'home');
            }
        }

    }

    /**
     * deconnexion
     */
    function logout() {
        Session::destroy();
        header('location: ' . URL . 'login');
        exit;
    }
    
}
