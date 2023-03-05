
$(document).ready(function () {

  let path = "http://localhost/ricien_stock/";

  //initialise_datatable_categorie
  var dataTable_categorie = $('#table_all_categorie').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      url: path + "configuration/categorie_datatable",
      type: "POST"
    },
    "columnDefs": [
      {
        "target": [0, 3, 4],
        "orderable": false
      }
    ]
  });
 
  //initialise_datatable_produit
  var dataTable_produit = $('#table_produit').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      url: path + "configuration/produit_datatable",
      type: "POST",

    },
    "columnDefs": [
      {
        "target": [0, 3, 4],
        "orderable": false
      }
    ]
  });

   //initialise_datatable_prix_produit
   var dataTable_categorie = $('#table_entrees_produit_mise_envente').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      url: path + "configuration/prix_produit_datatable",
      type: "POST"
    },
    "columnDefs": [
      {
        "target": [0, 3, 4],
        "orderable": false
      }
    ]
  });


  let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });

  // AJOUTER UNE CATEGORIE
  // ouvrir modal ajouter categorie
  $(document).on('click', '#btn_show_modal_add_categorie', function (e) {
    e.preventDefault();
    $('#modal_ajouter_categorie').modal('show');
  })
  // Valider ajout categorie
  $(document).on('click', '#btn_valider_ajout_categorie', function (e) {
    e.preventDefault();
    let designation = $('#designation').val();
    let description = $('#description').val();
    $.ajax({
      url: path + "configuration/ajouter_categorie",
      type: 'POST',
      dataType: 'JSON',
      data: {
        designation,
        description
      },
      success: function (data) {
        console.log(data);
        if (data.reponse == 'bien') {
          $('#modal_add_categorie').modal('hide');
          $('#designation').val("");
          $('#description').val("");
          Toast.fire({
            icon: 'success',
            title: 'La catégorie est ajoutée avec succès'
          });
          dataTable_categorie.ajax.reload();
        } else {
          Toast.fire({
            icon: 'error',
            title: 'Echec d\'ajout. Contactez l\'administrateur du système'
          });
        }
      },
      error: function (data) {
        console.log(data);
        alert('Error');
      }
    });
  });

  // AJOUTER UN PRODUIT
  // ouvrir modal ajouter produit
  $(document).on('click', '#btn_show_modal_add_produit', function (e) {
    e.preventDefault();
    $('#modal_ajouter_produit').modal('show');
  });

  $(document).on('click', '#btn_valider_ajout_produit', function (e) {
    e.preventDefault();
    let designation_prod = $('#designation_prod_add').val();
    let barcode = $('#barcode_pro_add').val();
    let caracteristique = $('#caracteristique_pro_add').val();
    let categorie_prod = $('#categorie_prod_add').val();

    $.ajax({
      url: path + "configuration/ajouter_produit",
      type: 'POST',
      dataType: 'JSON',
      data: {
        designation_prod,
        barcode,
        caracteristique,
        categorie_prod
      },
      success: function (data) {
        if (data.reponse == 'bien') {
          $('#modal_ajouter_produit').modal('hide');
          $('#designation_prod_add').val("");
          $('#barcode_pro_add').val("");
          $('#caracteristique_pro_add').val("");
          $('#categorie_prod_add').val("");
          Toast.fire({
            icon: 'success',
            title: 'Le produit est ajouté avec succès'
          });
          dataTable_produit.ajax.reload();
        } else {
          Toast.fire({
            icon: 'error',
            title: 'Echec d\'ajout. Contactez l\'administrateur du système'
          })
        }
      },
      error: function (data) {
        console.log(data);
        alert('Error');
      }
    });
  });

  $(document).on('change', '#produit_mise_envente', function (e) {
    e.preventDefault();
    let produit = $(this).val();
    $.ajax({
      url: path + "configuration/getEntreeByProduit",
      type: 'POST',
      data: {
        produit
      },
      success: function (data) {
        $("#entree_enstock").html(data);
      }
    });
  });

  $(document).on('change', "#entree_enstock", function (e) {
    e.preventDefault();

    let id_entree = $(this).val();
    if (id_entree !== "NULL") {
      $.ajax({
        url: `${path}configuration/getEntreeById`,
        type: "POST",
        data: {
          id_entree
        },
        success: function (data) {
          $("#prix_entendus").html(`<div class="form-group">
          <label for="prix_entendus">Pourcentage de benefice</label>
          <input type="number" class="form-control" data-prix="${data}" name="pourcentage_benefice" id="pourcentage_benefice" placeholder="0%">
        </div>`);
        }
      })
    }
  });

  $(document).on('keyup', "#pourcentage_benefice", function (e) {
    let pourcentage = $(this).val();
    let prix = $(this).data("prix");
    if (pourcentage) {
      let benefice = (parseInt(prix) / 100) * parseInt(pourcentage);
      let pv = benefice + prix;
      let tva = ((pv / 100) * 16);
      let pvtva = ((pv / 100) * 16) + pv;
      $("#prix_entendus_resultat").html(`<div class="alert alert-info text-left">
        <b>benefice: ${benefice}</b> </br>
        <b>Prix de vente: ${pv}</b> </br>
        <b>Prix de vente avec TVA: ${pvtva}</b> </br>
        <b>TVA: ${tva}</b>
        <input type="hidden" value="${pvtva}" id="final_prix">
      </div>`);
    }
  });

  $(document).on('click', "#btn_valider_mise_envente", function (e) {
    e.preventDefault();
    $.ajax({
      url: `${path}configuration/validet_mise_envente`,
      type: "POST",
      data: {
        id_entree: $("#entree_enstock").val(),
        prix: $("#final_prix").val(),
      },
      success: function (data) {
        console.log(data);
        if (data === "success") {
          $("#entree_enstock").val("NULL");
          $("#entree_enstock").html(`<option value="NULL">Choisir une entree</option>`);
          $("#produit_mise_envente").val("NULL");
          $("#produit_mise_envente").val(`<option value="NULL">Choisir un produit</option>`);
          $("#prix_entendus").html(``);
          $("#final_prix").val("");
          $("#prix_entendus_resultat").html(``);
          $("#modal_mise_envente").modal("hide")
          Toast.fire({
            icon: 'success',
            title: `L'entrée est mise en vente correctement!`
          });
        } else if (data === "failed_to_create") {
          Toast.fire({
            icon: 'error',
            title: 'Une erreur est survenue lors du traitement de la requete!'
          });
        } else if (data === "enter_is_existe") {
          Toast.fire({
            icon: 'error',
            title: 'Cette entree a déjà était mise en vente!'
          });
        } else if (data === "champt_vide") {
          Toast.fire({
            icon: 'error',
            title: 'Les champtes sont obligatoire!'
          });
        } else {
          Toast.fire({
            icon: 'error',
            title: 'Une erreur est survenue lors du traitement!'
          });
        }
      }
    });
  });

  $(document).on('click', '.btn_show_modal_update_produit', function (e) {
    e.preventDefault();
    $('#modal_update_produit').modal('show');
  });

});