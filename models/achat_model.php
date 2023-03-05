<?php

class Achat_model extends Model
{

  function __construct()
  {
    parent::__construct();
  }

  function xhr_entrees_DataTable()
  { 
    $query = "SELECT * FROM entrees e LEFT OUTER JOIN produit p ON e.id_produit = p.produit_id ";

    if (isset($_POST["search"]["value"])) {
      $query .= 'WHERE designation LIKE "%' . $_POST["search"]["value"] . '%" ';
      $query .= 'OR barcode LIKE "%' . $_POST["search"]["value"] . '%" ';
      $query .= 'OR created_entree LIKE "%' . $_POST["search"]["value"] . '%" ';
    }
    if (isset($_POST["order"])) {
      $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
      $query .= 'ORDER BY entrees_id DESC ';
    }
    if ($_POST["length"] != -1) {
      $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
    }

    $sth = $this->db->prepare($query);
    $sth->execute();
    $result = $sth->fetchAll();
    $data = array();
    $filtered_rows = $sth->rowCount();
    $i = 1;
    foreach ($result as $row) {
      $sub_array = array();
      $sub_array[] = $i;
      $sub_array[] = $row["created_entree"];
      $sub_array[] = $row["barcode"];
      $sub_array[] = $row["designation"];
      $sub_array[] = $row["qt_entrees"];
      $sub_array[] = $row["prix_entrees"]."FC";
      $sub_array[] = "<a style='cursor: pointer;' class='btn btn-primary btn-xs btn_show_modal_update_produit btn_update_produit_modal' id='" . $row["produit_id"] . "' title='Mettre à jour le produit'><i class='fa fa-edit'></i></a>
                <a style='cursor: pointer;' class='btn btn-danger btn-xs btn_delete_produit_modal' id='" . $row["produit_id"] . "' title='Supprimer le produit'><i class='fa fa-times'></i></a>";
      $i++;
      $data[] = $sub_array;
    }
    $results = array(
      "draw" => intval($_POST["draw"]),
      "recordsTotal" => $filtered_rows,
      "recordsFiltered" => $this->get_total_all_records("SELECT * FROM entrees e LEFT OUTER JOIN produit p ON e.id_produit = p.produit_id"),
      "data" => $data
    );
    echo json_encode($results);
  }

  public function submit_entrees(array $data)
  {
    return $this->db->insert("entrees", $data);
  }

}