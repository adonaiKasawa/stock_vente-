<?php

class Cartes_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Renvoie la liste de tous entrees d'impression cartes
     */
    function xhr_impression_cartes_DataTable($type_filtre = null, $ondate = null, $datedebut = null, $datefin = null, $agent = null, $site = null, $projet = null)
    {
        if ($type_filtre == null) {
            $query = "SELECT * FROM rapport_agent rap LEFT OUTER JOIN agent ag ON rap.id_agent = ag.agent_id LEFT OUTER JOIN site si ON rap.id_site = si.site_id LEFT OUTER JOIN projet pro ON si.id_projet = pro.projet_id  ";
            if (isset($_POST["search"]["value"])) {
                $query .= 'WHERE date_rapport_agent LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR nom_agent LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR postnom_agent LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR prenom_agent LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR libelle_site LIKE "%' . $_POST["search"]["value"] . '%" ';
                $query .= 'OR libelle_projet LIKE "%' . $_POST["search"]["value"] . '%" ';
            }
        } else if ($type_filtre == 'date') {
            $query = "SELECT * FROM rapport_agent rap LEFT OUTER JOIN agent ag ON rap.id_agent = ag.agent_id LEFT OUTER JOIN site si ON rap.id_site = si.site_id LEFT OUTER JOIN projet pro ON si.id_projet = pro.projet_id WHERE date_rapport_agent LIKE '%" . $ondate . "%' ";
            if (intval($agent) != 0) {
                $query .= "AND agent_id = '" . $agent . "' ";
            }
            if (intval($site) != 0) {
                $query .= "AND site_id = '" . $site . "' ";
            }
            if (intval($projet) != 0) {
                $query .= "AND projet_id = '" . $projet . "' ";
            }
            if (isset($_POST["search"]["value"])) {
                $query .= ' AND (date_rapport_agent LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR nom_agent LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR postnom_agent LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR prenom_agent LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR libelle_site LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR libelle_projet LIKE "%' . $_POST["search"]["value"] . '%" ) ';
            }
        } else if ($type_filtre == 'periode') {
            $query = "SELECT * FROM rapport_agent rap LEFT OUTER JOIN agent ag ON rap.id_agent = ag.agent_id LEFT OUTER JOIN site si ON rap.id_site = si.site_id LEFT OUTER JOIN projet pro ON si.id_projet = pro.projet_id WHERE (date_rapport_agent >= '" . $datedebut . " 00:00:00' AND date_rapport_agent <= '" . $datefin . " 23:59:59' ) ";
            if (intval($agent) != 0) {
                $query .= "AND agent_id = '" . $agent . "' ";
            }
            if (intval($site) != 0) {
                $query .= "AND site_id = '" . $site . "' ";
            }
            if (intval($projet) != 0) {
                $query .= "AND projet_id = '" . $projet . "' ";
            }
            if (isset($_POST["search"]["value"])) {
                $query .= ' AND (date_rapport_agent LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR nom_agent LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR postnom_agent LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR prenom_agent LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR libelle_site LIKE "%' . $_POST["search"]["value"] . '%" '
                    . 'OR libelle_projet LIKE "%' . $_POST["search"]["value"] . '%" ) ';
            }
        }

        if (isset($_POST["order"])) {
            $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
        } else {
            $query .= 'ORDER BY rapport_agent_id DESC ';
        }
        if ($_POST["length"] != -1) {
            $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }

        $sth = $this->db->prepare($query);
        $sth->execute();
        $result =  $sth->fetchAll();

        $data = array();
        $filtered_rows = $sth->rowCount();

        $total_imprimees = 0;
        $total_ratees = 0;

        foreach ($result as $row) {
            $sub_array = array();
            $sub_array[] = $row["date_rapport_agent"];
            $sub_array[] = $row["nom_agent"] . ' ' . $row["postnom_agent"] . ' ' . $row["prenom_agent"];
            $sub_array[] = $row["libelle_site"];
            $sub_array[] = $row["libelle_projet"];
            $sub_array[] = $row["nbre_imprimees"];
            $sub_array[] = $row["nbre_ratees"];

            $total_imprimees += floatval($row["nbre_imprimees"]);
            $total_ratees += floatval($row["nbre_ratees"]);

            $data[] = $sub_array;
        }
        $results = array(
            "draw" => intval($_POST["draw"]),
            "recordsTotal" => $filtered_rows,
            "recordsFiltered" => $this->get_total_all_records("SELECT * FROM rapport_agent rap LEFT OUTER JOIN agent ag ON rap.id_agent = ag.agent_id LEFT OUTER JOIN site si ON rap.id_site = si.site_id LEFT OUTER JOIN projet pro ON si.id_projet = pro.projet_id"),
            "data" => $data,
            "total_imprimees" => number_format($total_imprimees, 0, ',', ' '),
            "total_ratees" => number_format($total_ratees, 0, ',', ' ')
        );
        echo json_encode($results);
    }

    // Ajouter un rapport journalier
    function ajouter_rapport_journalier($rapport_date, $rapport_cartes_imprimees, $rapport_cartes_ratees, $rapport_agent, $rapport_site)
    {
        $query = "INSERT INTO rapport_agent (date_rapport_agent,nbre_imprimees,nbre_ratees,id_agent,id_site) VALUES (:date_rapport_agent,:nbre_imprimees,:nbre_ratees,:id_agent,:id_site)";
        $statement = $this->db->prepare($query);

        $result = $statement->execute(array(
            ':date_rapport_agent' => $rapport_date,
            ':nbre_imprimees' => $rapport_cartes_imprimees,
            ':nbre_ratees' => $rapport_cartes_ratees,
            ':id_agent' => $rapport_agent,
            ':id_site' => $rapport_site
        ));
        return $result;
    }
}
