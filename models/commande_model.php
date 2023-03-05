<?php

class Commande_model extends Model
{

  function __construct()
  {
    parent::__construct();
  }


  /**
   * Renvoie toutes les commandes
   */
  function xhr_commandes_DataTable($type_filtre = null, $ondate = null, $datedebut = null, $datefin = null, $fournisseur = null, $etape_commande = null)
  {
    if ($type_filtre == null) {
      $query = "SELECT * FROM commande c LEFT OUTER JOIN fournisseur f ON c.id_fournisseur = f.fournisseur_id LEFT OUTER JOIN users u ON c.id_utilisateur = u.user_id ";
      if (isset($_POST["search"]["value"])) {
        $query .= 'WHERE date_commande LIKE "%' . $_POST["search"]["value"] . '%" ';
        $query .= 'OR nom_fournisseur LIKE "%' . $_POST["search"]["value"] . '%" ';
      }
    } else if ($type_filtre == 'date') {
      $query = "SELECT * FROM commande c LEFT OUTER JOIN fournisseur f ON c.id_fournisseur = f.fournisseur_id LEFT OUTER JOIN users u ON c.id_utilisateur = u.user_id WHERE date_commande LIKE '%" . $ondate . "%' ";
      if (intval($fournisseur) != 0) {
        $query .= "AND fournisseur_id = '" . $fournisseur . "' ";
      }
      if ($etape_commande != '0') {
        $query .= "AND etape_commande = '" . $etape_commande . "' ";
      }
      if (isset($_POST["search"]["value"])) {
        $query .= ' AND (date_commande LIKE "%' . $_POST["search"]["value"] . '%" '
          . 'OR nom_fournisseur LIKE "%' . $_POST["search"]["value"] . '%" ) ';
      }
    } else if ($type_filtre == 'periode') {
      $query = "SELECT * FROM commande c LEFT OUTER JOIN fournisseur f ON c.id_fournisseur = f.fournisseur_id LEFT OUTER JOIN users u ON c.id_utilisateur = u.user_id  WHERE (date_commande >= '" . $datedebut . " 00:00:00' AND date_commande <= '" . $datefin . " 23:59:59' ) ";
      if (intval($fournisseur) != 0) {
        $query .= "AND fournisseur_id = '" . $fournisseur . "' ";
      }
      if ($etape_commande != '0') {
        $query .= "AND etape_commande = '" . $etape_commande . "' ";
      }
      if (isset($_POST["search"]["value"])) {
        $query .= ' AND (date_commande LIKE "%' . $_POST["search"]["value"] . '%" '
          . 'OR nom_fournisseur LIKE "%' . $_POST["search"]["value"] . '%" ) ';
      }
    }

    if (isset($_POST["order"])) {
      $query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
    } else {
      $query .= 'ORDER BY commande_id DESC ';
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

      $hidden = 'hidden';
      $hidden_print = 'hidden';
      if ($row["etape_commande"] != 'validee' && $row["etape_commande"] != 'annulee' && $row["etape_commande"] != 'satisfaite') {
        $hidden = '';
      }
      $hidden_print = ($row["etape_commande"] == 'validee') ? '' : 'hidden';

      $sub_array = array();
      $sub_array[] = $row["date_commande"];
      $sub_array[] = $row["numero_commande"];
      $sub_array[] = $row["nom_fournisseur"];
      $sub_array[] = $row["etape_commande"];
      $sub_array[] = "
                <div class='btn-group-vertical' " . $hidden . ">
                    <div class='btn-group'>
                        <button type='button' class='btn btn-default dropdown-toggle btn-sm' data-toggle='dropdown'>
                            Action
                        </button>
                        <ul class='dropdown-menu'>
                            <li><a class='dropdown-item bg-primary btn-sm btn_valider_commande' href='#' id='" . $row["commande_id"] . "'>Valider</a></li>
                            <li><a class='dropdown-item bg-danger btn-sm btn_annuler_commande' href='#' id='" . $row["commande_id"] . "'>Annuler</a></li>
                        </ul>
                    </div>
                </div>
                <button type='button' class='btn btn-primary btn-sm btn_voir_commande' id='" . $row["commande_id"] . "' title='Voir la commande'><i class='fa fa-eye'></i></button>
                <button type='button' class='btn btn-warning btn-sm btn_print_commande' id='" . $row["commande_id"] . "' title='Voir la commande' " . $hidden_print . "><i class='fa fa-print'></i></button>
            ";

      $data[] = $sub_array;
    }
    $results = array(
      "draw" => intval($_POST["draw"]),
      "recordsTotal" => $filtered_rows,
      "recordsFiltered" => $this->get_total_all_records("SELECT * FROM commande c LEFT OUTER JOIN fournisseur f ON c.id_fournisseur = f.fournisseur_id LEFT OUTER JOIN users u ON c.id_utilisateur = u.user_id"),
      "data" => $data
    );
    echo json_encode($results);
  }

  // Ajouter une commande dans la db
  function insert_commande($date_commande, $fournisseur, $user_id)
  {
    $query = "INSERT INTO commande (date_commande,etape_commande,numero_commande,id_fournisseur,id_utilisateur) VALUES (:date_commande,:etape_commande,:numero_commande,:id_fournisseur,:id_utilisateur)";
    $statement = $this->db->prepare($query);

    $statement->execute(array(
      ':date_commande' => $date_commande,
      ':etape_commande' => 'en_cours',
      ':numero_commande' => date("Ymd") . '' . rand(100, 999),
      ':id_fournisseur' => $fournisseur,
      ':id_utilisateur' => $user_id
    ));
    $result = $this->db->lastInsertId();
    return $result;
  }
  // Ajouter produits de la commande
  function insert_commande_produit($produit_id, $quantite, $id_commande)
  {
    $query = "INSERT INTO commande_produit (quantite_commande_produit,id_produit,id_commande) VALUES (:quantite_commande_produit,:id_produit,:id_commande)";
    $statement = $this->db->prepare($query);

    $statement->execute(array(
      ':quantite_commande_produit' => $quantite,
      ':id_produit' => $produit_id,
      ':id_commande' => $id_commande
    ));
    $result = $this->db->lastInsertId();
    return $result;
  }

  // Valider commande
  function valider_commande($commande_id)
  {
    $query = "UPDATE commande SET etape_commande = :etape_commande WHERE commande_id = :commande_id ";
    $statement = $this->db->prepare($query);

    $result = $statement->execute(array(
      ':etape_commande' => 'validee',
      ':commande_id' => $commande_id
    ));
    return $result;
  }

  // Annuler commande
  function annuler_commande($commande_id)
  {
    $query = "UPDATE commande SET etape_commande = :etape_commande WHERE commande_id = :commande_id ";
    $statement = $this->db->prepare($query);

    $result = $statement->execute(array(
      ':etape_commande' => 'annulee',
      ':commande_id' => $commande_id
    ));
    return $result;
  }

  // Voir une commande
  function voir_commande($commande_id)
  {
    $query = "SELECT * FROM commande_produit cp LEFT OUTER JOIN commande c ON cp.id_commande = c.commande_id LEFT OUTER JOIN produit p ON cp.id_produit = p.produit_id LEFT OUTER JOIN fournisseur f ON c.id_fournisseur = f.fournisseur_id WHERE cp.id_commande = :commande_id ";
    $statement = $this->db->prepare($query);

    $statement->execute(array(
      ':commande_id' => $commande_id
    ));
    $result =  $statement->fetchAll();
    return $result;
  }
}
