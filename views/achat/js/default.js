
$(document).ready(function () {

  let path = "http://localhost/ricien_stock/";

  let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });

  // pour l'ajout commande
  let tab_commandes_to_add = [];
  let tab_keys_commandes_to_add = [];

  //initialise_datatable_commandes
  let dataTable_entrees = $('#table_entrees_dataTables').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      url: path + "achat/xhr_entrees_DataTable",
      type: "POST",
    },
    "columnDefs": [
      {
        "target": [0, 3, 4],
        "orderable": false
      }
    ]
  });

  //AJOUTER COMMANDE
  // Modal
  $(document).on('click', '#btn_modal_ajout_commande', function (e) {
    $('#modal_ajout_commande').modal('show');
  });
  // Ajouter les elements au panier ajout commande
  $(document).on('click', '#ajouter_produit_commande_panier', function (e) {
    e.preventDefault();
    let produit_id = $('#ajout_commande_produit').val(); let selected_produit_nom = $("#ajout_commande_produit option:selected").text();
    let ajout_commande_quantite = $('#ajout_commande_quantite').val();

    if (produit_id == 'NULL') {
      Toast.fire({
        icon: 'error',
        title: 'Veuillez remplir les champs obligatoires'
      });
    } else if (parseInt(ajout_commande_quantite) < 1 || isNaN(parseInt(ajout_commande_quantite))) {
      Toast.fire({
        icon: 'error',
        title: 'Veuillez saisir une quantié valide'
      });
    } else if (tab_keys_commandes_to_add.includes(produit_id)) {
      Toast.fire({
        icon: 'error',
        title: 'Le produit est déjà sur la liste'
      });
    } else {
      let tab_ajout_commande_body = ``;
      tab_commandes_to_add.push([produit_id, selected_produit_nom, ajout_commande_quantite]);
      tab_keys_commandes_to_add.push(produit_id);

      tab_commandes_to_add.forEach((prod, index) => {
        tab_ajout_commande_body += `
                    <tr class="row_tab_produit_sortir" id="row_tab_produit_sortir">
                            <td>${prod[1]}</td>
                            <td>${prod[2]}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_commande" id="${index}"><i class="fa fa-times"></i></button>
                            </td>
                        </tr>
                    `;
      });
      $('#body_table_produit_commande').html(tab_ajout_commande_body);

      $('#ajout_commande_produit').val('NULL');
      $('#ajout_commande_quantite').val('');
    }
  });
  // remove produit de la liste des produits de la commande
  $(document).on('click', '.btn_remove_produit_de_la_commande', function (e) {
    e.preventDefault();
    let row_index = $(this).attr('id');
    let tab_ajout_commande_body = ``;
    tab_commandes_to_add.splice(row_index, 1);
    tab_keys_commandes_to_add.splice(row_index, 1);
    tab_commandes_to_add.forEach((prod, index) => {
      tab_ajout_commande_body += `
                <tr class="row_tab_produit_sortir" id="row_tab_produit_sortir">
                    <td>${prod[1]}</td>
                    <td>${prod[2]}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_commande" id="${index}"><i class="fa fa-times"></i></button>
                    </td>
                </tr>
            `;
    });
    $('#body_table_produit_commande').html(tab_ajout_commande_body);
  });
  // Valider sortie stock
  $(document).on('click', '#btn_valider_ajouter_commande', function (e) {
    e.preventDefault();
    let form_ajout_commande_data = new FormData(document.querySelector('#form_ajout_commande'));
    form_ajout_commande_data.append('details_commande', JSON.stringify(tab_commandes_to_add));
    $.ajax({
      url: path + "achat/ajouter_une_commande",
      type: 'POST',
      dataType: 'JSON',
      data: form_ajout_commande_data,
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if (data.reponse == 'bien') {
          form_ajout_commande.reset();
          tab_commandes_to_add = [];
          tab_keys_commandes_to_add = [];
          $('#modal_ajout_commande').modal('hide');
          $('#body_table_produit_commande').html('');
          dataTable_commandes.ajax.reload();

          Toast.fire({
            icon: 'success',
            title: 'Commande générée avec succès'
          })
        } else if (data.reponse == 'pas_bien') {
          Toast.fire({
            icon: 'error',
            title: 'Un problème est survenu lors de la création de la commande. Prière de contacter l\'administrateur'
          })
        }
      },
      error: function (data) {
        console.log(data);
        Toast.fire({
          icon: 'error',
          title: 'Echec. Veuillez contactez l\'administrateur'
        });
      }
    });
  });


  // FILTRE RAPPORT IMPRESSION
  // choix type date et periode
  $('#get_commande_onedate').val(getDate());
  $('#get_commande_debutdate').hide();
  $('#get_commande_findate').hide();
  $(document).on('change', '#triType', function () {
    if ($('#triType').val() == 1) {
      $('#get_commande_onedate').show();
      $('#get_commande_debutdate').hide();
      $('#get_commande_findate').hide();
    }
    if ($('#triType').val() == 2) {
      $('#get_commande_onedate').hide();
      $('#get_commande_debutdate').show();
      $('#get_commande_findate').show();
    }
  });
  // Affiche resultat filtre rapport impression
  $(document).on('click', '#btn_afficher_commandes_filtre', function (e) {
    e.preventDefault();
    let getType = $('#triType').val();
    let date = $('#get_commande_onedate').val();
    let date_debut = $('#get_commande_debutdate').val();
    let date_fin = $('#get_commande_findate').val();

    let fournisseur = $('#get_commande_fournisseur').val();
    let etat = $('#get_commande_etat').val();

    reloadDataTableGetCommande(getType, date, date_debut, date_fin, fournisseur, etat);

  });

  // Action sur l'entree
  $(document).on('click', '#submit_entree_produit', function (e) {
    e.preventDefault();
    let produit_entree = $("#produit_entree").val();
    let quantite_entree = $("#quantite_entree").val();
    let prix_entree = $("#prix_entree").val();

    $.ajax({
      url: path + "achat/submit_entrees",
      type: 'POST',
      dataType: 'JSON',
      data: {
        produit_entree,
        quantite_entree,
        prix_entree,
      },
      success: function (data) {
        console.log(data);
        if (data.reponse == 'bien') {
          dataTable_entrees.ajax.reload();
          Toast.fire({
            icon: 'success',
            title: 'Entrée validée avec succès'
          })
        } else if (data.reponse == 'pas_bien') {
          Toast.fire({
            icon: 'error',
            title: 'Un problème est survenu pendant le processus. Prière de contacter l\'administrateur'
          })
        }
      },
      error: function (data) {
        console.log(data);
        Toast.fire({
          icon: 'error',
          title: 'Echec. Veuillez contactez l\'administrateur'
        });
      }
    });
  });
  // Annuler commande
  $(document).on('click', '.btn_annuler_commande', function (e) {
    e.preventDefault();
    let commande_id = $(this).attr('id');
    $.ajax({
      url: path + "achat/annuler_commande",
      type: 'POST',
      dataType: 'JSON',
      data: { commande_id },
      success: function (data) {
        console.log(data);
        if (data.reponse == 'bien') {
          dataTable_commandes.ajax.reload();
          Toast.fire({
            icon: 'success',
            title: 'Commande Annulée avec succès'
          })
        } else if (data.reponse == 'pas_bien') {
          Toast.fire({
            icon: 'error',
            title: 'Un problème est survenu pendant le processus. Prière de contacter l\'administrateur'
          })
        }
      },
      error: function (data) {
        console.log(data);
        Toast.fire({
          icon: 'error',
          title: 'Echec. Veuillez contactez l\'administrateur'
        });
      }
    });
  });

  // Voir une commande
  $(document).on('click', '.btn_voir_commande', function (e) {
    e.preventDefault();
    let commande_id = $(this).attr('id');
    $.ajax({
      url: path + "achat/voir_commande",
      type: 'POST',
      dataType: 'JSON',
      data: { commande_id },
      success: function (data) {
        let body_content = ``;
        let first_commande = data[0]
        $('#voir_commande_details_date').html(first_commande.date_commande);
        $('#voir_commande_details_statut').html(first_commande.etape_commande);
        $('#voir_commande_details_fournisseur').html(first_commande.nom_fournisseur);

        data.forEach(element => {
          body_content += `
                        <tr>
                            <td>${element.designation}</td>
                            <td>${element.quantite_commande_produit}</td>
                        </tr>
                    `;
        });
        $('#voir_commande_body_produit_rows').html(body_content);

        $('#modal_voir_commande').modal('show');
      },
      error: function (data) {
        console.log(data);
        Toast.fire({
          icon: 'error',
          title: 'Echec. Veuillez contactez l\'administrateur'
        });
      }
    });
  });

  // Print commande
  $(document).on('click', '.btn_print_commande', function (e) {
    e.preventDefault();
    let commande_id = $(this).attr('id');
    $.ajax({
      url: path + "achat/voir_commande",
      type: 'POST',
      dataType: 'JSON',
      data: { commande_id },
      success: function (data) {
        let body_content = ``;
        let first_commande = data[0]
        $('#voir_commande_details_date').html(first_commande.date_commande);
        $('#voir_commande_details_statut').html(first_commande.etape_commande);
        $('#voir_commande_details_fournisseur').html(first_commande.nom_fournisseur);

        data.forEach(element => {
          body_content += `
                        <tr>
                            <td>${element.designation}</td>
                            <td>${element.quantite_commande_produit}</td>
                        </tr>
                    `;
        });
        $('#voir_commande_body_produit_rows').html(body_content);
        $("#print_etat_stock_date").html(getDateFrForat());
        $("#div_print_commande").printThis();
      },
      error: function (data) {
        console.log(data);
        alert('Error!!');
      }
    });
  });

  // la fonction qui renvoie la date du jour
  function getDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd
    }
    if (mm < 10) {
      mm = '0' + mm
    }
    today = yyyy + '-' + mm + '-' + dd;
    return today;
  }

  function getDateFrForat() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
      dd = '0' + dd
    }
    if (mm < 10) {
      mm = '0' + mm
    }
    today = dd + '-' + mm + '-' + yyyy;
    return today;
  }

  // fonction recharge la datables rapport impression (entree)
  function reloadDataTableGetCommande(getType, date = null, date_debut = null, date_fin = null, fournisseur = 0, etat = 0) {
    if (getType == 1) {
      if (date == '') {
        Toast.fire({
          icon: 'error',
          title: 'Veuillez choisir une date valide'
        })
      } else {
        dataTable_commandes.ajax.url(path + "achat/xhrDatatableGetCommandeDate/" + date + "/?fournisseur=" + fournisseur + "&etat=" + etat).load();
      }
    } else if (getType == 2) {
      if (date_debut == '' || date_fin == '') {
        Toast.fire({
          icon: 'error',
          title: 'Veuillez choisir une période valide'
        })
      } else {
        dataTable_commandes.ajax.url(path + "achat/xhrDatatableGetCommandePeriode/" + date_debut + "/" + date_fin + "/?fournisseur=" + fournisseur + "&etat=" + etat).load();
      }
    }
  }

  //initialise_datatable_bon_livraison
  let dataTable_bon_livraison = $('#table_bon_livraison').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [],
    "ajax": {
      url: path + "logistique/xhr_bon_livraison_DataTable",
      type: "POST"
    }
  });

});