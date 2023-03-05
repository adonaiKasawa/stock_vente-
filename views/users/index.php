

<!-- page content -->
<div style="margin-left:220px; margin-right:1%; padding-top:0.5%;">

    <div class="ui segment blue" id="asad_content">

        <div class="ui secondary pointing menu">
            <a class="active item green tab_item" id="users_utilisateurs" data-tab="first">
                <i class="user icon"></i>
                Utilisateurs
            </a>
            <a class="item green tab_item" id="users_ajouter_un_utilisateur" data-tab="second">
                <i class="add user icon"></i>
                Ajouter un utilisateur
            </a>
            <a class="item green tab_item" id="users_mon_profil" data-tab="third">
                <i class="user icon"></i>
                Mon profil
            </a>
        </div>

        <div class="ui bottom attached active tab segment" id="users_first_onglet" data-tab="first">
            <div id="first_onglet_content">
                <table id="table_users" class="ui small green celled table">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Privilège</th>
                            <th>Etat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($this->users_list as $user) {

                            if ($user['etat'] == 'actif') {
                                $etat_class = 'make_user_blocked';
                                $icon_class = 'green';
                                $icon_action_class = 'red';
                                $title = 'Desactiver';
                            } else {
                                $etat_class = 'make_user_active';
                                $icon_class = 'red';
                                $icon_action_class = 'green';
                                $title = 'Activer';
                            }
                            ?>

                            <tr>
                                <td>
                                    <?php echo $user['prenom'] ?>
                                </td>
                                <td>
                                    <?php echo $user['nom'] ?>
                                </td>
                                <td width="15%">
                                    <?php echo $user['privilege'] ?>
                                </td>
                                <td width="10%">
                                    <i class="rss <?php echo $icon_class; ?> icon"></i>
                                    <?php echo $user['etat'] ?>
                                </td>
                                <td width="9%">
                                    <a href="#" class="btn_show_user_modal" id="<?php echo $user['users_id'] ?>">
                                        <i class="eye icon"></i>
                                    </a>
                                    <a href="#" class="btn_edit_user_modal" id="<?php echo $user['users_id'] ?>">
                                        <i class="edit icon"></i>
                                    </a>
                                    <a href="#" id="<?php echo $user['users_id'] ?>" class="<?php echo $etat_class ?>" title="<?php echo $title ?>">
                                        <i class="rss <?php echo $icon_action_class; ?> icon"></i>
                                    </a>
                                </td>
                            </tr>

                            <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>

        <div class="ui bottom attached tab segment" id="users_second_onglet" data-tab="second">
            <div id="second_onglet_content">
                <div class="ui two column green segment">
                    <form class="ui mini form" id="formulaire_ajout_user" >

                        <div id="ajout_user_message"></div>

                        <h4 class="ui dividing header">Nouveau Utilisateur</h4>
                        <div class="field">
                            <div class="three fields">
                                <div class="field">
                                    <label>Prénom</label>
                                    <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                                </div>
                                <div class="field">
                                    <label>Nom</label>
                                    <input type="text" id="nom" name="nom" placeholder="Nom" required>
                                </div>
                                <div class="field">
                                    <label>Titre</label>
                                    <input type="text" id="user_titre" name="user_titre" placeholder="Titre" required>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="three fields">
                                <div class="field">
                                    <label>Login</label>
                                    <input type="text" id="login" name="login" placeholder="Login" required>
                                </div>
                                <div class="field">
                                    <label>Mot de passe</label>
                                    <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                                </div>
                                <div class="field">
                                    <label>Confirmation mot de passe</label>
                                    <input type="password" id="confirme_password" name="confirme_password" placeholder="Confirmation mot de passe" required>
                                </div>
                            </div>
                        </div>
                        <div class="three fields">
                            <div class="field">
                                <label>Poste / Privilège</label>
                                <select class="dropdown" id="user_poste">
                                    <option value="2">Receptionniste</option>
                                    <option value="5">Caissier</option>
                                    <option value="3">Medecin Consultant</option>
                                    <option value="1">Laboratin</option>
                                    <option value="4">Administrateur</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Sexe</label>
                                <select class="dropdown" id="user_sexe">
                                    <option value="m">Masculin</option>
                                    <option value="f">Feminin</option>
                                </select>
                            </div>
                            <div class="field">
                                <label>Etat</label>
                                <select class="dropdown" id="etat">
                                    <option value="inactif">Inactif</option>
                                    <option value="actif">Actif</option>
                                </select>
                            </div>
                        </div>

                        <div class="ui green inverted button" id="save_user_btn">Ajouter L'utilisateur</div>
                    </form>
                </div>
            </div>
        </div>

        <div class="ui bottom attached tab segment" id="users_third_onglet" data-tab="third">
            <div id="third_onglet_content">
                <div class="ui	green card">
                    <div class="image">
                        <img src="<?php echo URL; ?>/public/images/nel2.jpg">
                    </div>
                    <div class="content">
                        <div class="header">
                            <?php echo Session::get('prenom') . ' ' . Session::get('nom'); ?>
                        </div>
                        <div class="meta">
                            <a>Editer</a>
                        </div>
                        <div class="description">
                            <?php echo Session::get('prenom') . ' ' . Session::get('nom') . ' '; ?>est
                            <?php echo Session::get('privilege') . ' '; ?>au sein de l'etablissement.
                        </div>
                    </div>
                    <div class="extra content">
                        <span class="right floated">
                            <i class="user icon"></i>
                            <?php echo Session::get('login'); ?>
                        </span>
                        <span>
                            <i class="rss icon"></i>
                            <?php echo Session::get('etat'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->


<!-- Modal_show_user -->
<div class="ui modal" id="users_show_modal">
    <i class="close icon"></i>
    <div class="header">
        Utilisateur
    </div>
    <div class="content">
        <div class="ui	green card">
            <div class="image">
                <img src="<?php echo URL; ?>/public/images/nel2.jpg">
            </div>
            <div class="content">
                <div class="header">
                    <span id="users_show_modal_header"></span>
                </div>
                <div class="description">
                    <span id="users_show_modal_nom_complet"></span> est de type 1
                    <span id="users_show_modal_privilege"></span> au sein de l'etablissement.
                </div>
            </div>
            <div class="extra content">
                <span class="right floated">
                    <i class="user icon"></i>
                    <span id="users_show_modal_login"></span>
                </span>
                <span>
                    <i class="rss icon"></i>
                    <span id="users_show_modal_etat"></span>
                </span>
            </div>
        </div>
    </div>
    <div class="actions">
        <button class="ui negative button">
            Fermer
        </button>
    </div>
</div>


<!-- Modal_edit_user -->
<div class="ui modal" id="users_edit_modal">
    <i class="close icon"></i>
    <div class="header">
        Modifier L'utilisateur
    </div>
    <div class="content">
        <form class="ui mini form">

            <div id="users_edit_modal_message"></div>
            
            <input type="hidden" id="hidden_users_id"/>

            <div class="field">
                <div class="two fields">
                    <div class="field">
                        <label>Prénom</label>
                        <input type="text" id="users_edit_modal_prenom" name="prenom" placeholder="Prénom" required>
                    </div>
                    <div class="field">
                        <label>Nom</label>
                        <input type="text" id="users_edit_modal_nom" name="nom" placeholder="Nom" required>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="three fields">
                    <div class="field">
                        <label>Login</label>
                        <input type="text" id="users_edit_modal_login" name="login" placeholder="Login" required>
                    </div>
                    <div class="field">
                    <label>Privilège</label>
                    <select class="dropdown" id="users_edit_modal_privilege">
                        <option value="receptionniste">Receptionniste</option>
                        <option value="caissier">Caissier</option>
                        <option value="chef_d_unite">Chef d'unite</option>
                        <option value="administrateur">Administrateur</option>
                    </select>
                </div>
                <div class="field">
                    <label>Etat</label>
                    <select class="dropdown" id="users_edit_modal_etat">
                        <option value="inactif">Inactif</option>
                        <option value="actif">Actif</option>
                    </select>
                </div>
                </div>
            </div>
        </form>
    </div>
    <div class="actions">
        <button class="ui negative button">
            Annuler
        </button>
        <button class="ui positive button" id="modal_users_btn_update">
            Valider
        </button>
    </div>
</div>