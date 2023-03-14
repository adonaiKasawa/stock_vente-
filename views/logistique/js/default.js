$(document).ready(function () {

  let path = "http://localhost/ricien_stock/";

  let Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000
  });

  // Entree stock
  let tab_produit_to_add = [];
  let tab_keys_produit_to_add = [];
  // Sortie stock
  let tab_produit_a_sortir = [];
  let tab_keys_produit_a_sortir = [];

  // APPROVISIONNER LE STOCK
  // ouvrir modal ajouter categorie
  $(document).on('click', '#btn_modal_approvisionnement', function (e) {
    e.preventDefault();
    $('#modal_approvisionnement_stock').modal('show');
  });
  // Ajouter les elements au panier approvisionnement
  $(document).on('click', '#ajouter_produit_panier', function (e) {
    e.preventDefault();
    let produit_id = $('#appro_produit').val();
    let quantite_to_add = $('#appro_quantite').val();

    if (produit_id == 'NULL') {
      Toast.fire({
        icon: 'error',
        title: 'Veuillez choisir un produit'
      });
    } else if (parseInt(quantite_to_add) < 1 || isNaN(parseInt(quantite_to_add))) {
      Toast.fire({
        icon: 'error',
        title: 'Veuillez saisir une quantié valide'
      });
    } else if (tab_keys_produit_to_add.includes(produit_id)) {
      Toast.fire({
        icon: 'error',
        title: 'Le produit est déjà sur la liste'
      });
    } else {
      $.ajax({
        url: path + "logistique/get_produit_element_by_id",
        type: 'POST',
        dataType: 'JSON',
        data: {
          produit_id
        },
        success: function (stock_element) {
          let tab_produit_to_add_body = ``;
          let element = stock_element[0]; // get the array's only element (produit)
          tab_produit_to_add.push([element.produit_id, element.designation, quantite_to_add, element.designation_cat, element.produit_id]);
          tab_keys_produit_to_add.push(element.produit_id);

          tab_produit_to_add.forEach((prod, index) => {
            tab_produit_to_add_body += `
                        <tr class="row_tab_produit_to_add" id="row_tab_produit_to_add">
                                <td>${prod[1]}</td>
                                <td>${prod[2]}</td>
                                <td>${prod[3]}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="${index}"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        `;
          });
          $('#body_table_produit_entre').html(tab_produit_to_add_body);

          $('#appro_produit').val('NULL');
          $('#appro_quantite').val('');
        },
        error: function (data) {
          console.log(data);
          alert('Error');
        }
      });
    }
  });
  // remove produit de la liste des produits to add
  $(document).on('click', '.btn_remove_produit_de_la_liste_to_add', function (e) {
    e.preventDefault();
    let row_index = $(this).attr('id');
    let tab_produit_to_add_body = ``;
    tab_produit_to_add.splice(row_index, 1);
    tab_keys_produit_to_add.splice(row_index, 1);
    tab_produit_to_add.forEach((prod, index) => {
      tab_produit_to_add_body += `
            <tr>
                <td>${prod[1]}</td>
                <td>${prod[2]}</td>
                <td>${prod[3]}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="${index}"><i class="fa fa-times"></i></button>
                </td>
            </tr>
            `;
    });
    $('#body_table_produit_entre').html(tab_produit_to_add_body);
  });
  // Valider approvisionnement
  $(document).on('click', '#btn_valider_approvisionnement', function (e) {
    e.preventDefault();
    let form_approvisionnement = new FormData(document.querySelector('#form_ajouter_produits_au_stock'));
    form_approvisionnement.append('details_bon', JSON.stringify(tab_produit_to_add));
    $.ajax({
      url: path + "logistique/valider_approvisionnement",
      type: 'POST',
      dataType: 'JSON',
      data: form_approvisionnement,
      contentType: false,
      cache: false,
      processData: false,
      success: function (result) {
        if (result) {
          form_ajouter_produits_au_stock.reset();
          tab_produit_to_add = [];
          tab_keys_produit_to_add = [];
          $('#body_table_produit_entre').html('');
          $('#modal_approvisionnement_stock').modal('hide');
          dataTable_stock.ajax.reload();
          dataTable_journal_stock.ajax.reload();

          Toast.fire({
            icon: 'success',
            title: 'Stock approvisionné avec succès'
          })
        } else {
          Toast.fire({
            icon: 'error',
            title: 'Echec d\'approvisionnement. Veuillez contactez l\'administrateur'
          });
        }
      },
      error: function (data) {
        console.log(data);
        alert('Error!!');
      }
    });
  });


  // SORTIE DE STOCK
  // Modal sortie stock
  $(document).on('click', '#btn_modal_sortir_stock', function (e) {
    e.preventDefault();
    $('#modal_sortie_produits_du_stock').modal('show');
  });
  // Ajouter les elements au panier sortie stock
  $(document).on('click', '#ajouter_produit_sorti_panier', function (e) {
    e.preventDefault();
    let produit_id = $('#sortie_produit').val();
    let sortie_quantite = $('#sortie_quantite').val();
    let sortie_agent = $('#sortie_agent').val(); let selected_agent_nom = $("#sortie_agent option:selected").text();
    let sortie_projet = $('#sortie_projet').val(); let selected_projet_nom = $("#sortie_projet option:selected").text();
    let sortie_site = $('#sortie_site').val(); let selected_site_nom = $("#sortie_site option:selected").text();

    if (produit_id == 'NULL' || sortie_projet == 'NULL') {
      Toast.fire({
        icon: 'error',
        title: 'Veuillez remplir les champs obligatoires'
      });
    } else if (parseInt(sortie_quantite) < 1 || isNaN(parseInt(sortie_quantite))) {
      Toast.fire({
        icon: 'error',
        title: 'Veuillez saisir une quantié valide'
      });
    } else {
      $.ajax({
        url: path + "logistique/get_produit_element_by_id",
        type: 'POST',
        dataType: 'JSON',
        data: {
          produit_id
        },
        success: function (stock_element) {
          let tab_produit_a_sortir_body = ``;
          let element = stock_element[0]; // get the array's only element(produit)
          tab_produit_a_sortir.push([element.produit_id, element.designation, element.designation_cat, sortie_quantite, sortie_agent, selected_agent_nom, sortie_projet, selected_projet_nom, element.produit_id, sortie_site, selected_site_nom]);
          tab_keys_produit_a_sortir.push(element.produit_id);

          tab_produit_a_sortir.forEach((prod, index) => {
            tab_produit_a_sortir_body += `
                        <tr class="row_tab_produit_sortir" id="row_tab_produit_sortir">
                                <td>${prod[1]}</td>
                                <td>${prod[2]}</td>
                                <td>${prod[3]}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_sortir" id="${index}"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                        `;
          });
          $('#body_table_produit_sortie').html(tab_produit_a_sortir_body);

          $('#sortie_produit').val('NULL');
          $('#sortie_agent').val('NULL');
          $('#sortie_projet').val('NULL');
          $('#sortie_quantite').val('');
        },
        error: function (data) {
          console.log(data);
          alert('Error');
        }
      });
    }
  });
  // Supprimer element de la liste des produits à sortir
  $(document).on('click', '.btn_remove_produit_de_la_liste_sortir', function (e) {
    e.preventDefault();
    let row_index = $(this).attr('id');
    let body_table_produit_sortie = ``;
    tab_produit_a_sortir.splice(row_index, 1);
    tab_keys_produit_a_sortir.splice(row_index, 1);
    tab_produit_a_sortir.forEach((prod, index) => {
      body_table_produit_sortie += `
            <tr>
                <td>${prod[1]}</td>
                <td>${prod[2]}</td>
                <td>${prod[3]}</td>
                <td>${prod[5]}</td>
                <td>${prod[7]}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_sortir" id="${index}"><i class="fa fa-times"></i></button>
                </td>
            </tr>
            `;
    });
    $('#body_table_produit_sortie').html(body_table_produit_sortie);
  });
  // Valider sortie stock
  $(document).on('click', '#btn_valider_sortie_produits_du_stock', function (e) {
    e.preventDefault();
    let form_sortie_stock = new FormData(document.querySelector('#form_sortie_produits_du_stock'));
    form_sortie_stock.append('details_sortie', JSON.stringify(tab_produit_a_sortir));
    $.ajax({
      url: path + "logistique/valider_sortie_stock",
      type: 'POST',
      dataType: 'JSON',
      data: form_sortie_stock,
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if (data.reponse == 'bien') {
          form_sortie_produits_du_stock.reset();
          tab_produit_a_sortir = [];
          tab_keys_produit_a_sortir = [];
          $('#modal_sortie_produits_du_stock').modal('hide');
          $('#body_table_produit_sortie').html('');
          dataTable_stock.ajax.reload();
          dataTable_journal_stock.ajax.reload();

          Toast.fire({
            icon: 'success',
            title: 'Sortie de stock effectuée avec succès'
          })
        } else if (data.reponse == 'pas_bien') {
          Toast.fire({
            icon: 'error',
            title: 'Un problème est survenu lors de la sortie en stock. Prière de contrôler le stock d\'avant opération'
          })
        } else if (data.reponse == 'qte_trop_importante') {
          Toast.fire({
            icon: 'error',
            title: 'Quantité en stock insuffisante'
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


  // MOUVEMENT STOCK
  // ENTREE
  // choix type date et periode
  $('#get_entree_mouvement_onedate').val(getDate());
  $('#get_entree_mouvement_debutdate').hide();
  $('#get_entree_mouvement_findate').hide();
  $(document).on('change', '#triType', function () {
    if ($('#triType').val() == 1) {
      $('#get_entree_mouvement_onedate').show();
      $('#get_entree_mouvement_debutdate').hide();
      $('#get_entree_mouvement_findate').hide();
    }
    if ($('#triType').val() == 2) {
      $('#get_entree_mouvement_onedate').hide();
      $('#get_entree_mouvement_debutdate').show();
      $('#get_entree_mouvement_findate').show();
    }
  });
  //Affiche les mouvements (entree) avec le btn afficher.
  $(document).on('click', '#btn_afficher_mvt_entre_filtre', function () {
    let getType = $('#triType').val();
    let date = $('#get_entree_mouvement_onedate').val();
    let date_debut = $('#get_entree_mouvement_debutdate').val();
    let date_fin = $('#get_entree_mouvement_findate').val();

    let fournisseur = $('#get_entree_mouvement_fournisseur').val();
    let produit = $('#get_entree_mouvement_produit').val();
    let categorie = $('#get_entree_mouvement_categorie').val();

    reloadDataTableGetMouvementEntre(getType, date, date_debut, date_fin, fournisseur, produit, categorie);

  });
  // SORTIE
  $('#get_sortie_mouvement_onedate').val(getDate());
  $('#get_sortie_mouvement_debutdate').hide();
  $('#get_sortie_mouvement_findate').hide();
  $(document).on('change', '#sortie_triType', function () {
    if ($('#sortie_triType').val() == 1) {
      $('#get_sortie_mouvement_onedate').show();
      $('#get_sortie_mouvement_debutdate').hide();
      $('#get_sortie_mouvement_findate').hide();
    }
    if ($('#sortie_triType').val() == 2) {
      $('#get_sortie_mouvement_onedate').hide();
      $('#get_sortie_mouvement_debutdate').show();
      $('#get_sortie_mouvement_findate').show();
    }
  });
  //Affiche les mouvements (sortie) avec le btn afficher.
  $(document).on('click', '#btn_afficher_mvt_sortie_filtre', function () {
    let getType = $('#sortie_triType').val();
    let date = $('#get_sortie_mouvement_onedate').val();
    let date_debut = $('#get_sortie_mouvement_debutdate').val();
    let date_fin = $('#get_sortie_mouvement_findate').val();

    let fournisseur = $('#get_sortie_mouvement_fournisseur').val();
    let produit = $('#get_sortie_mouvement_produit').val();
    let categorie = $('#get_sortie_mouvement_categorie').val();

    let agent = $('#get_sortie_mouvement_agent').val();
    let projet = $('#get_sortie_mouvement_projet').val();

    reloadDataTableGetMouvementSortie(getType, date, date_debut, date_fin, fournisseur, produit, categorie, agent, projet);

  });


  // VOIR BON DE LIVRAISON
  $(document).on('click', '.btn_modal_voir_bon_livraison', function (e) {
    e.preventDefault();
    let bon_livraison_id = $(this).attr('id');
    $.ajax({
      url: path + "logistique/get_bon_et_details",
      type: 'POST',
      dataType: 'JSON',
      data: {
        bon_livraison_id: bon_livraison_id
      },
      success: function (bon_details) {
        let body_content = ``;
        let first_bon = bon_details[0];
        $('#voir_bon_livraison_details_numero').html(first_bon.numero_bon);
        $('#voir_bon_livraison_details_date_livraison').html(first_bon.date_livraison);
        $('#voir_bon_livraison_details_fournisseur').html(first_bon.nom_fournisseur);
        $('#voir_bon_livraison_details_utilisateur').html(first_bon.nom_user + ' ' + first_bon.postnom_user + ' ' + first_bon.prenom_user);
        bon_details.forEach(element => {
          body_content += `
                        <tr>
                            <td>${element.designation}</td>
                            <td>${element.quantite_detail_bon}</td>
                        </tr>
                    `;
        });
        $('#voir_bon_livraison_details_body_produit_rows').html(body_content);
        $('#modal_voir_bon_livraison').modal('show');
      },
      error: function (data) {
        console.log(data);
        alert('Error!!');
      }
    });
  });
  // VOIR l'image du bon
  $(document).on('click', '.btn_modal_voir_bon_livraison_image', function (e) {
    e.preventDefault();
    let img_src = $(this).attr('img_src');
    $("#voir_image_bon_img").attr("src", path + "public/images/bon/" + img_src);
    $('#modal_voir_image_bon_livraison').modal('show');
  });

  // Print rapport sur etat de stock
  $(document).on('click', '#btn_print_rapport_sur_etat_stock', function (e) {
    e.preventDefault();
    $.ajax({
      url: path + "logistique/get_stock_state",
      type: 'POST',
      dataType: 'JSON',
      data: {},
      success: function (stock) {
        let body_content = ``;

        stock.forEach(element => {
          body_content += `
                        <tr>
                            <td style="border: 2px solid black;">${element.designation}</td>
                            <td style="border: 2px solid black;">${element.designation_cat}</td>
                            <td style="border: 2px solid black;">${element.som_entree - element.som_sortie}</td>
                        </tr>
                    `;
        });
        $('#print_etat_table_body').html(body_content);
        $("#print_etat_stock_date").html(getDateFrForat());
        $("#div_rapport_etat_stock").printThis();
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
  // fonction recharge la datables mouvements  (entree)
  function reloadDataTableGetMouvementEntre(getType, date = null, date_debut = null, date_fin = null, fournisseur = 0, produit = 0, categorie = 0) {
    if (getType == 1) {
      if (date == '') {
        Toast.fire({
          icon: 'error',
          title: 'Veuillez choisir une date valide'
        })
      } else {
        dataTable_mouvement_entree_stock.ajax.url(path + "logistique/xhrDatatableGetMouvementEntreeDate/" + date + "/?fournisseur=" + fournisseur + "&produit=" + produit + "&categorie=" + categorie).load();
      }
    } else if (getType == 2) {
      if (date_debut == '' || date_fin == '') {
        Toast.fire({
          icon: 'error',
          title: 'Veuillez choisir une période valide'
        })
      } else {
        dataTable_mouvement_entree_stock.ajax.url(path + "logistique/xhrDatatableGetMouvementEntreePeriode/" + date_debut + "/" + date_fin + "/?fournisseur=" + fournisseur + "&produit=" + produit + "&categorie=" + categorie).load();
      }
    }
  }
  // fonction recharge la datables mouvements (sortie)
  function reloadDataTableGetMouvementSortie(getType, date = null, date_debut = null, date_fin = null, fournisseur = 0, produit = 0, categorie = 0, agent = 0, projet = 0) {
    if (getType == 1) {
      if (date == '') {
        Toast.fire({
          icon: 'error',
          title: 'Veuillez choisir une date valide'
        })
      } else {
        dataTable_mouvement_sortie_stock.ajax.url(path + "logistique/xhrDatatableGetMouvementSortieDate/" + date + "/?fournisseur=" + fournisseur + "&produit=" + produit + "&categorie=" + categorie + "&agent=" + agent + "&projet=" + projet).load();
      }
    } else if (getType == 2) {
      if (date_debut == '' || date_fin == '') {
        Toast.fire({
          icon: 'error',
          title: 'Veuillez choisir une période valide'
        })
      } else {
        dataTable_mouvement_sortie_stock.ajax.url(path + "logistique/xhrDatatableGetMouvementSortiePeriode/" + date_debut + "/" + date_fin + "/?fournisseur=" + fournisseur + "&produit=" + produit + "&categorie=" + categorie + "&agent=" + agent + "&projet=" + projet).load();
      }
    }
  }

});

