<?php

class Vente_model extends Model
{

  function __construct()
  {
    parent::__construct();
  }

  function submit_vente(array $data)
  {
    return $this->db->insert("ventes", $data);
  }
  function getProduitOnSale()
  {
    return $this->db->select("SELECT * FROM entrees, prix_produit, produit where entrees.entrees_id = prix_produit.id_entrees and entrees.id_produit = produit.produit_id and status_entrees =:st", array("st" => "onsale"));
  }

  function checkQtOnSaleByProduit(int $produit)
  {
    return $this->db->select("SELECT * FROM entrees where id_produit =:id and status_entrees =:st", array("id" => $produit, "st" => "onsale"));
  }

  function getPrixProduitByEnter(int $id_entree)
  {
    return $this->db->select("SELECT * FROM prix_produit where id_entrees =:id", array("id" => $id_entree));
  }
  
  function getAllSaleByEnterOnSale(int $produit, int $id_entree)
  {
    return $this->db->select("SELECT * FROM ventes, prix_produit, entrees 
    where ventes.id_produit_prix = prix_produit.prix_id and
    prix_produit.id_entrees =:id_entree and
    entrees.id_produit =:id_produit", 
    array("id_produit" => $produit, "id_entree" => $id_entree));
  }

  function xhr_vente_DataTable()
  {
    
  }

  function getAllPanier()
  {
    
  }

  function update_entree(array $data, int $id_entree)
  {
    return $this->db->update("entrees", $data, "entrees_id = $id_entree");   
  }
  
}