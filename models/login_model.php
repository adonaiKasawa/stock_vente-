<?php

class Login_model extends Model{

    function __construct() {
        parent:: __construct();
    }

    /**
     * Check pour la connexion
     * @param type $login_ou_email
     * @param type $password
     */
    public function connect($login, $password) {
        $query = "SELECT * FROM users u LEFT OUTER JOIN privilege p ON u.id_privilege = p.privilege_id WHERE login_user = :login AND password_user = :password";
        
        $statement = $this->db->prepare($query);

        $statement->bindValue(':login', $login);
        $statement->bindValue(':password', $password);
        
        $statement->execute();
        $user_data = $statement->fetch();
        
        return $user_data;
    }

    // get all actions of a privilege
    public function get_privilege_actions($id_privilege){
        $query = "SELECT * FROM action_privilege ap LEFT OUTER JOIN actions a ON ap.id_action = a.action_id WHERE id_privilege = :id_privilege";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id_privilege', $id_privilege);
        $statement->execute();
        $privilege_actions = $statement->fetchAll();
        
        return $privilege_actions;
    }

}
