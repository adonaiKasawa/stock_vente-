<?php

class Configuration_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Renvoie la liste de toutes les categories
     */
    function xhr_categorie_DataTable()
    {
        $query = "SELECT * FROM categorie ";

        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE categorie_id LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR designation_cat LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR description_cat LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY categorie_id DESC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();

        $data = array();
        $filtered_rows = $sth->rowCount();
        $i = 1;
        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row["designation_cat"];
            $sub_array[] = $row["description_cat"];
            $sub_array[] = "
            <a style='cursor: pointer;' class='btn btn-primary btn-xs btn_update_categorie_modal' id='" . $row["categorie_id"] . "' title='Mettre à jour la catégorie'><i class='fa fa-edit'></i></a>
            <a style='cursor: pointer;' class='btn btn-danger btn-xs btn_delete_categorie_modal' id='" . $row["categorie_id"] . "' title='Supprimer la catégorie'><i class='fa fa-times'></i></a>
                    ";
            $i++;
            $data[] = $sub_array;

        }
        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM categorie"),
            "data" => $data
        );
        echo json_encode($results);
    }

    /**
     * Renvoie la liste de tous les produits
     */
    function xhr_produit_DataTable()
    {
        $query = "SELECT * FROM produit p LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id ";

        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE produit_id LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR designation LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR barcode LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY produit_id DESC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();

        $data = array();
        $filtered_rows = $sth->rowCount();
        $i = 1;
        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row["designation"];
            $sub_array[] = $row["barcode"];
            $sub_array[] = $row["caracteristique"];
            //$sub_array[] = $row["nbre_par_pq"];
            $sub_array[] = $row["designation_cat"];
            $sub_array[] = "<a style='cursor: pointer;' class='btn btn-primary btn-xs btn_show_modal_update_produit btn_update_produit_modal' id='" . $row["produit_id"] . "' title='Mettre à jour le produit'><i class='fa fa-edit'></i></a>
                <a style='cursor: pointer;' class='btn btn-danger btn-xs btn_delete_produit_modal' id='" . $row["produit_id"] . "' title='Supprimer le produit'><i class='fa fa-times'></i></a>";
            $i++;
            $data[] = $sub_array;
        }
        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM produit p LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id"),
            "data" => $data
        );
        echo json_encode($results);
    }

    public function xhr_prix_produit_DataTable()
    {
        $query = "SELECT * FROM prix_produit px LEFT OUTER JOIN entrees e ON px.id_entrees = e.entrees_id JOIN produit pr ON pr.produit_id = e.id_produit ";

        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE prix_id LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR designation LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR barcode LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR created_time LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR qt_entrees LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY prix_id DESC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();

        $data = array();
        $filtered_rows = $sth->rowCount();
        $i = 1;
        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $i;
            $sub_array[] = $row["created_time"];
            $sub_array[] = $row["barcode"];
            $sub_array[] = $row["designation"];
            $sub_array[] = $row["qt_entrees"];
            $sub_array[] = $row["prix_entrees"]."FC";
            $sub_array[] = $row["prix"]."FC";
            $sub_array[] = "<a style='cursor: pointer;' class='btn btn-primary btn-xs btn_show_modal_update_produit btn_update_produit_modal' id='" . $row["produit_id"] . "' title='Mettre à jour le produit'><i class='fa fa-edit'></i></a>
                <a style='cursor: pointer;' class='btn btn-danger btn-xs btn_delete_produit_modal' id='" . $row["produit_id"] . "' title='Supprimer le produit'><i class='fa fa-times'></i></a>";
            $i++;
            $data[] = $sub_array;
        }
        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM prix_produit px LEFT OUTER JOIN entrees e ON px.id_entrees = e.entrees_id JOIN produit pr ON pr.produit_id = e.id_produit"),
            "data" => $data
        );
        echo json_encode($results);
    }



    // Ajouter une categorie
    function ajouter_categorie($designation, $description)
    {
        $query = "INSERT INTO categorie (designation_cat,description_cat) VALUES (:designation_cat,:description_cat)";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':designation_cat' => $designation,
            ':description_cat' => $description
        ));
        return $result;
    }

    // Ajouter un produit
    function ajouter_produit($designation_prod, $barcode, $caracteristique, $categorie_prod)
    {
        $query = "INSERT INTO produit (designation,barcode,caracteristique,nbre_par_pq,id_categorie) VALUES (:designation,:barcode,:caracteristique,:nbre_par_pq,:id_categorie)";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':designation' => $designation_prod,
            ':barcode' => $barcode,
            ':caracteristique' => $caracteristique,
            ':nbre_par_pq' => 0,
            ':id_categorie' => $categorie_prod
        ));
        return $result;
    }

    function getEntreeByProduit(int $id_produit)
    {
      return $this->db->select("SELECT * FROM entrees, produit where id_produit =:id_produit AND produit.produit_id = entrees.id_produit AND status_entrees =:status_entrees", array("id_produit" => $id_produit, "status_entrees" => "awaiting" ));
    }

    function getEntreeById(int $entree_id)
    {
        return $this->db->select("SELECT * FROM entrees where entrees_id =:id",array("id" => $entree_id));
    }

    function check_entree_in_prix_produit(int $id_entree)
    {
        return $this->db->select("SELECT * FROM prix_produit where id_entrees =:id",array("id" => $id_entree));
    }

    function insert_in_prix_produit(array $data)
    {
        return $this->db->insert("prix_produit", $data);
    }

    function update_entree(string $table,  array $data, int $id_entree)
    {
      return $this->db->update($table, $data, "entrees_id = $id_entree");   
    }

    function delete_entree_mise_envente(int $id_entree)
    {
      return $this->db->delete("prix_produit","entrees_id = $id_entree");   
    }
}

