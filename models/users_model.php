<?php
/**
 * Copyright (c) 2019, Innovate For Future Tech.
 * Powered by Elysée Asad Luboya
 * Soft-Mat
 * 
 * @package   Soft-Mat
 * @author    Dread Luiz Kiamputu & Elysée Asad Luboya (email:nel7luboya@gmail.com, Tél:+243 819664909)
 * @copyright Copyright (c) 2019, Innovate For Future Tech.  (http://innovateforfuture.com)
 * @since     Version 1.3.0
 */

class Users_model extends Model {

    function __construct() {
        parent:: __construct();
    }

    /**
     * Renvoie la liste des users
     * @return array usersList
     */
    public function users_list() {

        $query = "SELECT * FROM users";

        $statement = $this->db->prepare($query);
        $statement->execute();
        $usersList = $statement->fetchAll();
        $statement->closeCursor();
        return $usersList;
    }

    /**
     * Enregiste un utilisateur dans base de dinnees
     * @return boolean
     */
    public function insert_user($prenom, $nom,$login, $password, $user_titre, $user_poste, $user_sexe, $privilege, $etat) {
        $query = "INSERT INTO users (prenom,nom,login,password,user_titre,user_poste,user_sexe,privilege,etat) VALUES (:prenom,:nom,:login,:password,:user_titre,:user_poste,:user_sexe,:privilege,:etat) ";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':login' => $login,
            ':password' => $password,
            ':user_titre' => $user_titre,
            ':user_poste' => $user_poste,
            ':user_sexe' => $user_sexe,
            ':privilege' => $privilege,
            ':etat' => $etat
        ));

        return $result;
    }

    /**
     * Renvoie un user avec tout se details
     * @param int $user_id
     * @return Array User
     */
    public function get_user($user_id) {
        $query = "SELECT * FROM users WHERE users_id = :user_id";
        $statement = $this->db->prepare($query);
        $statement->execute(array(':user_id' => $user_id));
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }

    /**
     * Edition d'un compte user par un admin
     * @param int $user_id
     * @param String $nom
     * @param String $prenom
     * @param String $privilege
     * @param String $statut
     * @param String $email
     * @return Bool
     */
    public function admin_edit_user($users_id, $prenom, $nom, $login, $privilege, $etat) {
        $query = "UPDATE users SET prenom = :prenom, nom = :nom, privilege = :privilege, etat = :etat, login = :login WHERE users_id = :users_id";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':privilege' => $privilege,
            ':login' => $login,
            ':etat' => $etat,
            ':users_id' => (int)$users_id
        ));

        return $result;
    }
    
    public function edit_own_account($user_id,$prenom,$nom,$email,$login,$password) {
        $query = "UPDATE users SET prenom = :prenom, nom = :nom, login = :login, password = :password, email = :email WHERE user_id = :user_id";
        $statement = $this->db->prepare($query);
        $result = $statement->execute(array(
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':login' => $login,
            ':email' => $email,
            ':password' => $password,
            ':user_id' => (int)$user_id
        ));

        return $result;
    }
    

    /**
     * rendre un user actif
     * @param int $user_id
     * @return Bool
     */
    public function active_user($user_id) {
        $query = "UPDATE users SET etat = 'actif' WHERE users_id = :users_id";

        $statement = $this->db->prepare($query);
        $statement->bindValue(':users_id', $user_id);
        $result = $statement->execute();
        return $result;
    }

    /**
     * rendre un user inactif
     * @param int $user_id
     * @return Bool
     */
    public function block_user($user_id) {
        $query = "UPDATE users SET etat = 'inactif' WHERE users_id = :users_id";

        $statement = $this->db->prepare($query);
        $statement->bindValue(':users_id', $user_id);
        $result = $statement->execute();
        return $result;
    }

}
