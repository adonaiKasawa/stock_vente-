
$(document).ready(function() {

    let path = "http://localhost/hopitos/";

    //initialise_datatable_users
    $('#table_users').DataTable({});

    //AJOUT_D'UN_NOUVEAU_UTILISATEURS
    $(document).on('click', '#save_user_btn', function(e) {
        e.preventDefault();

        var prenom = $('#prenom').val();
        var nom = $('#nom').val();
        var login = $('#login').val();
        var password = $('#password').val();
        var user_titre = $('#user_titre').val();
        var user_poste = $('#user_poste').val();
        var user_sexe = $('#user_sexe').val();
        var confirme_password = $('#confirme_password').val();
        var etat = $('#etat').val();

        if (prenom == '' || nom == '' || login == '' || user_titre == '' || password == '' || confirme_password == '') {
            swal.fire({
                title: 'Veillez remplir tout les champs',
                text: '',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            if (password != confirme_password) {
                swal.fire({
                    title: 'Le mot de passe ne correspond pas a sa definition',
                    text: '',
                    type: 'error',
                    confirmButtonText: 'Ok'
                });
            } else {

                $.ajax({
                    url: path + "users/new_user",
                    type: 'POST',
                    data: {
                        prenom: prenom,
                        nom: nom,
                        login: login,
                        password: password,
                        user_titre: user_titre,
                        user_poste: user_poste,
                        user_sexe: user_sexe,
                        confirme_password: confirme_password,
                        privilege: user_poste,
                        etat: etat
                    },
                    success: function(data) {
                        if (data == 'inserted') {
                            swal.fire({
                                title: 'Utilisateur ajouté avec succès',
                                text: '',
                                type: 'success',
                                confirmButtonText: 'Ok'
                            });
                            formulaire_ajout_user.reset();
                        } else {
                            swal.fire({
                                title: 'Erreur!',
                                text: 'Echec d\'enregistrement',
                                type: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                });
            }
        }
    });


    //  MODIFIER LE PRIVILEGE D'UN UTILISATEUR
    //rendre actif
    $(document).on('click', '.make_user_active', function() {
        var user_id = $(this).attr('id');

        $.ajax({
            url: path + "users/active_user",
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function(data) {
                if (data == 'done') {
                    load_contenu('#users_first_onglet', path +  'users/index #first_onglet_content');
                }
            }
        });
    });
    //rendre inactif
    $(document).on('click', '.make_user_blocked', function() {
        var user_id = $(this).attr('id');

        $.ajax({
            url: path + "users/block_user",
            type: 'POST',
            data: {
                user_id: user_id
            },
            success: function(data) {
                if (data == 'done') {
                    load_contenu('#users_first_onglet', path +  'users/index #first_onglet_content');
                }
            }
        });
    });

    
    //VOIR_LES_DETAILS_D'UN_USER
    $(document).on('click', '.btn_show_user_modal', function(e) {
        e.preventDefault();
        var user_id = $(this).attr('id');

        $.ajax({
            url: path +  "users/show_one",
            type: 'POST',
            dataType: 'JSON',
            data: {
                user_id: user_id
            },
            success: function(user) {
                $('#users_show_modal_header').html(user.prenom + ' ' + user.nom);
                $('#users_show_modal_nom_complet').html(user.prenom + ' ' + user.nom);
                $('#users_show_modal_privilege').html(user.privilege);
                $('#users_show_modal_login').html(user.login);
                $('#users_show_modal_etat').html(user.etat);
                $('#users_show_modal').modal('show');
            },
            error: function(data) {
                alert('Error!!');
            }
        });
    });



    //UPDATE_USER
    //show_modal
    $(document).on('click', '.btn_edit_user_modal', function(e) {
        e.preventDefault();
        var user_id = $(this).attr('id');

        $.ajax({
            url: path +  "users/show_one",
            type: 'POST',
            dataType: 'JSON',
            data: {
                user_id: user_id
            },
            success: function(user) {
                $('#hidden_users_id').val(user.users_id);
                $('#users_edit_modal_prenom').val(user.prenom);
                $('#users_edit_modal_nom').val(user.nom);
                $('#users_edit_modal_login').val(user.login);

                $('#users_edit_modal').modal('show');
            },
            error: function(data) {
                alert('Error!!');
            }
        });
    });
    //valide_update
    $(document).on('click', '#modal_users_btn_update', function(e) {
        e.preventDefault();

        var hidden_users_id = $('#hidden_users_id').val();
        var prenom = $('#users_edit_modal_prenom').val();
        var nom = $('#users_edit_modal_nom').val();
        var login = $('#users_edit_modal_login').val();
        var privilege = $('#users_edit_modal_privilege').val();
        var etat = $('#users_edit_modal_etat').val();

        if (prenom == '' || nom == '' || login == '') {

            swal.fire({
                title: 'Champs vides',
                text: 'Veillez remplir tous les champs',
                type: 'error',
                confirmButtonText: 'Ok'
            });
        } else {

            $.ajax({
                url: path + "users/edit_user",
                type: 'POST',
                data: {
                    hidden_users_id: hidden_users_id,
                    prenom: prenom,
                    nom: nom,
                    login: login,
                    privilege: privilege,
                    etat: etat
                },
                success: function(data) {
                    if (data == 'bien') {
                        swal.fire({
                            title: 'Modifier avec succes',
                            text: '',
                            type: 'success',
                            confirmButtonText: 'Ok'
                        });
                        load_contenu('#users_first_onglet', path + 'users/index #first_onglet_content');
                    } else {
                        swal.fire({
                            title: 'Echec de modification',
                            text: '',
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            });
        }
    });




    //CHARGEMENT_SYSTEMATIQUE_DES_CONTENUS_DES_ONGULET
    $(document).on('click', '#users_utilisateurs', function() {
        load_contenu('#users_first_onglet', path + 'users/index #first_onglet_content');
        $('#table_users').DataTable().destroy();
        $('#table_users').DataTable({
            "processing" : false,
            "serverSide" : false
        });
    });
    $(document).on('click', '#users_ajouter_un_utilisateur', function() {
        load_contenu('#users_second_onglet', path + 'users/index #second_onglet_content');
    });
    $(document).on('click', '#users_mon_profil', function() {
        load_contenu('#users_third_onglet', path + 'users/index #third_onglet_content');
    });


    //La method qui charge le contenu pour chaque ongulet d'un module
    function load_contenu(id_element_content, url_content, donnees) {
        $(id_element_content).load(url_content, donnees);
    }


});