<?php

class Finance_model extends Model {

    function __construct() {
        parent:: __construct();
    }

    public function getEntree()
    {
        return $this->db->select("SELECT * FROM entrees");
    }

    public function getVente()
    {
        return $this->db->select("SELECT * FROM ventes, prix_produit, entrees where ventes.id_produit_prix = prix_produit.prix_id and prix_produit.id_entrees = entrees.entrees_id");
    }

    public function getPrixProduit()
    {
        return $this->db->select("SELECT * FROM prix_produit, entrees where prix_produit.id_entrees = entrees.entrees_id");
    }

}
