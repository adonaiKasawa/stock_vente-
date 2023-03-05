<?php

class Model {

    function __construct() {
         $this->db = new Database();
    }

    /**
     * Renvoie le nombre d'enregistrement total (pour la datatable)
     */
    function get_total_all_records($query) {
        $sth2 = $this->db->prepare($query);
        $sth2->execute();
        return $sth2->rowCount();
    }

    /**
     * Renvoie les enregistrements pour la requete
     */
    function get_total_from_request($query) {
        $statement = $this->db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    /**
     * Get user by privilege
     */
    function get_users_by_privilege($privilege){
        $query = "SELECT * FROM users WHERE privilege = :privilege ";

        $statement = $this->db->prepare($query);
        $statement->execute(array(
            'privilege' => $privilege
        ));
        $medecins = $statement->fetchAll();
        $statement->closeCursor();
        return $medecins;
    }

    // Select all from a table
    function getAll($table){
        $query = "SELECT * FROM $table";
        $statement = $this->db->prepare($query);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();
        return $rows;
    }

    // select from $table, select a row by Id
    function getByIdFromTable($table, $id_name, $id_value){
        $query = "SELECT * FROM $table WHERE $id_name = :id ";
        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':id' => $id_value
        ));
        $rows = $statement->fetch();
        $statement->closeCursor();
        return $rows;
    }

    
}
