<?php

class Logistique_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Renvoie la liste de toutes les elements dans le stock
     */
    function get_produit_categorie()
    {
        return $this->db->select("SELECT * FROM produit, categorie WHERE categorie.categorie_id = produit.id_categorie");
    }

    function entreesAwaiting($produit_id, $type = "awaiting")
    {
        $requete = $this->db->select("SELECT * FROM entrees WHERE id_produit =:p and status_entrees =:s", array("p" => $produit_id, "s" => $type));
        $qt = 0;
        $i = 0;
        foreach ($requete as $key ) {
            $qt += $key["qt_entrees"];
            $i++;
        }
        return array("qt" => $qt, "nbrEnter" => $i, "result" => $requete);
    }

    function entreesSalt($produit_id)
    {
        $sold = $this->entreesAwaiting($produit_id, 'onsale');
        $qt = 0;
        foreach ($sold["result"] as $key) {
            $prix_produit = $this->db->select("SELECT * FROM prix_produit WHERE id_entrees = :entrees", array("entrees" => $key['entrees_id']));
            $ventes = $this->db->select("SELECT * FROM ventes where id_produit_prix =:id_p_p", array("id_p_p" => $prix_produit[0]['prix_id']));
            foreach ($ventes as $row) {
                $qt += $row["qt_produit"];
            }
        }
        return  $sold["qt"] - $qt;

    }

    function produit_vendu($produit)
    {
        $entrees = $this->db->select("SELECT * FROM entrees, prix_produit  where entrees.entrees_id = prix_produit.id_entrees and entrees.id_produit =:p", array("p" => $produit));
        $qt = 0;
        foreach ($entrees as $key) {
            $ventes = $this->db->select("SELECT * FROM ventes where id_produit_prix =:e", array("e" => $key["prix_id"]));
            foreach ($ventes as $row) {
                $qt += $row["qt_produit"];
            }
        }
        return $qt;
    }

    /**
     * Renvoie la liste de tous les bons de livraison
     */
    function xhr_bon_livraison_DataTable()
    {
        $query = "SELECT * FROM bon_livraison bon LEFT OUTER JOIN fournisseur four ON bon.id_fournisseur = four.fournisseur_id ";

        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE numero_bon LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR date_livraison LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR nom_fournisseur LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY bon_livraison_id DESC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();

        $data = array();
        $filtered_rows = $sth->rowCount();

        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $row["numero_bon"];
            $sub_array[] = $row["date_livraison"];
            $sub_array[] = $row["nom_fournisseur"];
            $sub_array[] = "
                <button class='btn btn-primary btn-xs btn_modal_voir_bon_livraison' id='".$row["bon_livraison_id"]."'><i class='fa fa-eye'></i></button>
                <button class='btn btn-primary btn-xs btn_modal_voir_bon_livraison_image' img_src='".$row["lien_bon_image"]."' id='".$row["bon_livraison_id"]."'><i class='fa fa-image'></i></button>
            ";
            $data[] = $sub_array;
        }
        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM bon_livraison bon LEFT OUTER JOIN fournisseur four ON bon.id_fournisseur = four.fournisseur_id"),
            "data" => $data
        );
        echo json_encode($results);
    }


    /**
     * Renvoie le journal du stock
     */
    function xhr_journal_stock_DataTable()
    {
        $query = "SELECT  vw.DTE,
                            vw.TYPE_OP AS TYPE_OP,
                            p.designation,
                            c.designation_cat,
                            vw.QTE
                    
                    FROM vw_journal_stock vw LEFT OUTER JOIN produit p ON vw.PRODUIT = p.produit_id 
                         LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id ";

        if (isset($_POST["search"]["value"])) {
            $query .= 'WHERE designation LIKE "%' . $_POST["search"]["value"] . '%" ';
            $query .= 'OR DTE LIKE "%' . $_POST["search"]["value"] . '%" ';
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY DTE DESC ';
        }
        
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll();

        // var_dump($result);

        // echo count($result);
        // exit();

        $data = array();
        $filtered_rows = $sth->rowCount();

        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $row["DTE"];
            $sub_array[] = utf8_encode($row["TYPE_OP"]);
            $sub_array[] = $row["designation"];
            $sub_array[] = $row["designation_cat"];
            $sub_array[] = $row["QTE"];
            $data[] = $sub_array;
        }
        $results = array(
            // "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM vw_journal_stock vw LEFT OUTER JOIN produit p ON vw.PRODUIT = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id"),
            "data" => $data
        );
        echo json_encode($results);
    }
   
    /**
     * Renvoie toutes entrées dans le stock , mouvement
     */
    function xhr_mouvement_entree_stock_DataTable($type_filtre = null, $ondate = null, $datedebut = null, $datefin = null, $fournisseur = null, $produit = null, $categorie = null)
    {
        if ($type_filtre == null) {
            $query = "SELECT * FROM detail_bon_livraison d LEFT OUTER JOIN produit p ON d.id_produit = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id LEFT OUTER JOIN bon_livraison bon ON d.id_bon_livraison = bon.bon_livraison_id LEFT OUTER JOIN fournisseur four ON bon.id_fournisseur = four.fournisseur_id ";
            if (isset($_POST["search"]["value"])) {
                $query .= 'WHERE designation LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR date_livraison LIKE "%' . $_POST["search"]["value"] . '%" ';
            }
        } else if ($type_filtre == 'date'){
            $query = "SELECT * FROM detail_bon_livraison d LEFT OUTER JOIN produit p ON d.id_produit = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id LEFT OUTER JOIN bon_livraison bon ON d.id_bon_livraison = bon.bon_livraison_id LEFT OUTER JOIN fournisseur four ON bon.id_fournisseur = four.fournisseur_id WHERE date_livraison LIKE '%" . $ondate . "%' ";
            if (intval($fournisseur) != 0) {
                $query .= "AND fournisseur_id = '" . $fournisseur . "' ";
            }
            if (intval($produit) != 0) {
                $query .= "AND produit_id = '" . $produit . "' ";
            }
            if (intval($categorie) != 0) {
                $query .= "AND categorie_id = '" . $categorie . "' ";
            }
            if (isset($_POST["search"]["value"])) {
                $query .= ' AND (designation LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR designation_cat LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR id_fournisseur LIKE "%' . $_POST["search"]["value"] . '%" ) ';
            }
        } else if ($type_filtre == 'periode'){
            $query = "SELECT * FROM detail_bon_livraison d LEFT OUTER JOIN produit p ON d.id_produit = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id LEFT OUTER JOIN bon_livraison bon ON d.id_bon_livraison = bon.bon_livraison_id LEFT OUTER JOIN fournisseur four ON bon.id_fournisseur = four.fournisseur_id WHERE (date_livraison >= '" . $datedebut . " 00:00:00' AND date_livraison <= '" . $datefin . " 23:59:59' ) ";
            if (intval($fournisseur) != 0) {
                $query .= "AND fournisseur_id = '" . $fournisseur . "' ";
            }
            if (intval($produit) != 0) {
                $query .= "AND produit_id = '" . $produit . "' ";
            }
            if (intval($categorie) != 0) {
                $query .= "AND categorie_id = '" . $categorie . "' ";
            }
            if (isset($_POST["search"]["value"])) {
                $query .= ' AND (designation LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR designation_cat LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR id_fournisseur LIKE "%' . $_POST["search"]["value"] . '%" ) ';
            }
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY detail_bon_id DESC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();

        $data = array();
        $filtered_rows = $sth->rowCount();
        $total = 0;

        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $row["date_livraison"];
            $sub_array[] = $row["designation"];
            $sub_array[] = $row["designation_cat"];
            $sub_array[] = $row["nom_fournisseur"];
            $sub_array[] = $row["quantite_detail_bon"];

            $total += floatval($row["quantite_detail_bon"]);

            $data[] = $sub_array;
        }
        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM detail_bon_livraison d LEFT OUTER JOIN produit p ON d.id_produit = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id LEFT OUTER JOIN bon_livraison bon ON d.id_bon_livraison = bon.bon_livraison_id LEFT OUTER JOIN fournisseur four ON bon.id_fournisseur = four.fournisseur_id"),
            "data" => $data,
            "total" => number_format($total, 0, ',', ' ')
        );
        echo json_encode($results);
    }

    
    /**
     * Renvoie toutes sorties stock , mouvement
     */
    function xhr_mouvement_sortie_stock_DataTable($type_filtre = null, $ondate = null, $datedebut = null, $datefin = null, $fournisseur = null, $produit = null, $categorie = null, $agent = null, $projet = null)
    {
        if ($type_filtre == null) {
            $query = "SELECT * FROM sortie_stock s LEFT OUTER JOIN produit p ON s.id_produit = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id LEFT OUTER JOIN agent ag ON s.id_agent = ag.agent_id LEFT OUTER JOIN projet proj ON s.id_projet = proj.projet_id ";
            if (isset($_POST["search"]["value"])) {
                $query .= 'WHERE designation LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR date_sortie LIKE "%' . $_POST["search"]["value"] . '%" ';
            }
        } else if ($type_filtre == 'date'){
            $query = "SELECT * FROM sortie_stock s LEFT OUTER JOIN produit p ON s.id_produit = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id LEFT OUTER JOIN agent ag ON s.id_agent = ag.agent_id LEFT OUTER JOIN projet proj ON s.id_projet = proj.projet_id WHERE date_sortie LIKE '%" . $ondate . "%' ";
            if (intval($fournisseur) != 0) {
                $query .= "AND fournisseur_id = '" . $fournisseur . "' ";
            }
            if (intval($produit) != 0) {
                $query .= "AND produit_id = '" . $produit . "' ";
            }
            if (intval($categorie) != 0) {
                $query .= "AND categorie_id = '" . $categorie . "' ";
            }
            if (intval($agent) != 0) {
                $query .= "AND agent_id = '" . $agent . "' ";
            }
            if (intval($projet) != 0) {
                $query .= "AND projet_id = '" . $projet . "' ";
            }
            if (isset($_POST["search"]["value"])) {
                $query .= ' AND (designation LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR designation_cat LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR id_projet LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR id_agent LIKE "%' . $_POST["search"]["value"] . '%" ) ';
            }
        } else if ($type_filtre == 'periode'){
            $query = "SELECT * FROM sortie_stock s LEFT OUTER JOIN produit p ON s.id_produit = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id LEFT OUTER JOIN agent ag ON s.id_agent = ag.agent_id LEFT OUTER JOIN projet proj ON s.id_projet = proj.projet_id WHERE (date_sortie >= '" . $datedebut . " 00:00:00' AND date_sortie <= '" . $datefin . " 23:59:59' ) ";
            if (intval($fournisseur) != 0) {
                $query .= "AND fournisseur_id = '" . $fournisseur . "' ";
            }
            if (intval($produit) != 0) {
                $query .= "AND produit_id = '" . $produit . "' ";
            }
            if (intval($categorie) != 0) {
                $query .= "AND categorie_id = '" . $categorie . "' ";
            }
            if (intval($agent) != 0) {
                $query .= "AND agent_id = '" . $agent . "' ";
            }
            if (intval($projet) != 0) {
                $query .= "AND projet_id = '" . $projet . "' ";
            }
            if (isset($_POST["search"]["value"])) {
                $query .= ' AND (designation LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR designation_cat LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR id_projet LIKE "%' . $_POST["search"]["value"] . '%" '
                        . 'OR id_agent LIKE "%' . $_POST["search"]["value"] . '%" ) ';
            }
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY sortie_stock_id DESC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();

        $data = array();
        $filtered_rows = $sth->rowCount();

        // $total = 0;
        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $row["date_sortie"];
            $sub_array[] = $row["designation"];
            $sub_array[] = $row["designation_cat"];
            // $sub_array[] = $row["nom_agent"].' '.$row["postnom_agent"].' '.$row["prenom_agent"];
            $sub_array[] = "Motif de la sortie"; 
            $sub_array[] = $row["qte_sortie"];

            // $total += floatval($row["qte_sortie"]);

            $data[] = $sub_array;
        }
        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM detail_bon_livraison d LEFT OUTER JOIN produit p ON d.id_produit = p.produit_id LEFT OUTER JOIN categorie c ON p.id_categorie = c.categorie_id LEFT OUTER JOIN bon_livraison bon ON d.id_bon_livraison = bon.bon_livraison_id LEFT OUTER JOIN fournisseur four ON bon.id_fournisseur = four.fournisseur_id"),
            "data" => $data
            // "total" => number_format($total, 0, ',', ' ')
        );
        echo json_encode($results);
    }

    // Renvoie le total en stock pour un produit
    function get_total_prod_stock($produit_id){
        $query = "SELECT * FROM stock_pro_somme WHERE id_produit = :id ";
        $statement = $this->db->prepare($query);
        $statement->execute(array(
            ':id' => $produit_id
        ));
        $produit = $statement->fetch();
        $statement->closeCursor();
        return $produit;
    }

    //Ajout de la qte sur le champ quantite_sortie de l'entree la plus ancienne
    function update_qte_plus_ancienne_entree($stock_id,$quantite){
        $query = "UPDATE stock SET quantite_sortie = quantite_sortie + :quantite_out WHERE stock_id = :stock_id";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':quantite_out' => $quantite,
            ':stock_id' => $stock_id
        ));
        // $result = $this->db->lastInsertId();
        return $result;
    }

}
