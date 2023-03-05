
$(document).ready(function () {

    let path = "http://localhost/ricien_stock/";

    let Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000
    });

    //initialise_datatable_impression_cartes
    let dataTable_impression_cartes = $('#table_impression_cartes').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: path + "cartes/xhr_impression_cartes_DataTable",
            type: "POST"
        },
        drawCallback: function (settings) {
            $('#table_impression_cartes_total_imprimees').html(settings.json.total_imprimees);
            $('#table_impression_cartes_total_ratees').html(settings.json.total_ratees);
        }
    });


    //AJOUTER RAPPORT JOURNALIER (impression cartes)
    // Modal
    $(document).on('click', '#btn_modal_ajout_rapport_journalier', function (e) {
        $('#modal_ajout_rapport_journalier_impression_carte').modal('show');
    });
    // Valider ajouter rapport journalier (impression cartes)
    $(document).on('click', '#btn_valider_ajout_rapport_journalier_impression_carte', function (e) {
        e.preventDefault();
        var rapport_date = $('#ajout_rapport_journalier_date').val();
        var rapport_agent = $('#ajout_rapport_journalier_agent').val();
        var rapport_site = $('#ajout_rapport_journalier_site').val();
        var rapport_cartes_imprimees = $('#ajout_rapport_journalier_cartes_imprimees').val();
        var rapport_cartes_ratees = $('#ajout_rapport_journalier_cartes_ratees').val();

        $.ajax({
            url: path + "cartes/ajouter_rapport_journalier",
            type: 'POST',
            dataType: 'JSON',
            data: {
                rapport_date,
                rapport_agent,
                rapport_site,
                rapport_cartes_imprimees,
                rapport_cartes_ratees
            },
            success: function (data) {
                if (data.reponse == 'bien') {
                    $('#modal_ajout_rapport_journalier_impression_carte').modal('hide');
                    form_ajout_rapport_journalier_impression_carte.reset();
                    dataTable_impression_cartes.ajax.reload();
                    Toast.fire({
                        icon: 'success',
                        title: 'Information est ajoutée avec succès'
                    })
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: 'Echec d\'ajout. Contactez l\'administrateur du système'
                    })
                }
            },
            error: function (data) {
                console.log(data);
                alert('Error!!');
            }
        });
    });


    // FILTRE RAPPORT IMPRESSION
    // choix type date et periode
    $('#get_rapport_onedate').val(getDate());
    $('#get_rapport_debutdate').hide();
    $('#get_rapport_findate').hide();
    $(document).on('change', '#triType', function () {
        if ($('#triType').val() == 1) {
            $('#get_rapport_onedate').show();
            $('#get_rapport_debutdate').hide();
            $('#get_rapport_findate').hide();
        }
        if ($('#triType').val() == 2) {
            $('#get_rapport_onedate').hide();
            $('#get_rapport_debutdate').show();
            $('#get_rapport_findate').show();
        }
    });
    // Affiche resultat filtre rapport impression
    $(document).on('click', '#btn_afficher_rapport_impression_filtre', function () {
        let getType = $('#triType').val();
        let date = $('#get_rapport_onedate').val();
        let date_debut = $('#get_rapport_debutdate').val();
        let date_fin = $('#get_rapport_findate').val();

        let agent = $('#get_rapport_agent').val();
        let site = $('#get_rapport_site').val();
        let projet = $('#get_rapport_projet').val();

        reloadDataTableGetRapportImpression(getType, date, date_debut, date_fin, agent, site, projet);

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

    // fonction recharge la datables rapport impression (entree)
    function reloadDataTableGetRapportImpression(getType, date = null, date_debut = null, date_fin = null, agent = 0, site = 0, projet = 0) {
        if (getType == 1) {
            if (date == '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Veuillez choisir une date valide'
                })
            } else {
                dataTable_impression_cartes.ajax.url(path + "cartes/xhrDatatableGetRapportImpressionDate/" + date + "/?agent=" +agent + "&site=" + site + "&projet=" + projet).load();
            }
        } else if (getType == 2) {
            if (date_debut == '' || date_fin == '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Veuillez choisir une période valide'
                })
            } else {
                dataTable_impression_cartes.ajax.url(path + "cartes/xhrDatatableGetRapportImpressionPeriode/" + date_debut + "/" + date_fin + "/?agent=" +agent + "&site=" + site + "&projet=" + projet).load();
            }
        }
    }

});