  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Gestion de commandes</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Gestion de commandes</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-12">
                      <div class="card card-primary card-outline">
                          <div class="card-header">
                              <h3 class="card-title">Commandes</h3>
                              <div class="card-tools ">
                                  <button type="button" class="btn btn-primary btn-sm float-right" id="btn_modal_ajout_commande">
                                      <i class="fas fa-print"></i> Générer une commande
                                  </button>
                              </div>
                          </div>

                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="card card-primary card-outline">
                                          <div class="card-header">
                                              <h3 class="card-title">
                                                  Commandes
                                              </h3>

                                              <div class="card-tools">
                                                  <div class="input-group input-group-sm">
                                                      <select name="triType" id="triType" class="form-control mr-2 float-right">
                                                          <option value="1">Date précise</option>
                                                          <option value="2">Période</option>
                                                      </select>
                                                      <input type="date" id="get_commande_onedate" name="table_search" class="form-control mr-2 float-right">
                                                      <input type="date" id="get_commande_debutdate" name="table_search" class="form-control mr-2 float-right">
                                                      <input type="date" id="get_commande_findate" name="table_search" class="form-control mr-2 float-right">
                                                      <select name="get_commande_fournisseur" id="get_commande_fournisseur" class="form-control mr-2 float-right">
                                                          <option value="0">Choisir un Fournisseur</option>
                                                          <?php
                                                            foreach ($this->fournisseurs as $fournisseur) {
                                                            ?>
                                                              <option value="<?php echo $fournisseur['fournisseur_id']; ?>"><?php echo $fournisseur['nom_fournisseur']; ?></option>
                                                          <?php
                                                            }
                                                            ?>
                                                      </select>
                                                      <select name="get_commande_etat" id="get_commande_etat" class="form-control mr-2 float-right">
                                                          <option value="0">Choisir un Etat</option>
                                                          <option value="en_cours">En cours</option>
                                                          <option value="validee">Validée</option>
                                                          <option value="satisfaite">Satisfaite</option>
                                                          <option value="annulee">Annulée</option>
                                                      </select>
                                                      <button type="button" name="table_search" id="btn_afficher_commandes_filtre" class="form-control mr-2 float-right btn-primary"> <i class="fa fa-search"></i> Afficher</button>
                                                  </div>
                                              </div>

                                          </div>
                                          <div class="card-body">
                                              <table class="table table-bordered" id="table_commandes">
                                                  <thead>
                                                      <tr>
                                                          <th>Date</th>
                                                          <th>Numéro de la commande</th>
                                                          <th>Fournisseur</th>
                                                          <th>Etape</th>
                                                          <th>Action</th>
                                                      </tr>
                                                  </thead>
                                              </table>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- /.card -->
                      </div>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal ajout rapport journalier impression cartes -->
  <div class="modal fade" id="modal_ajout_commande">
      <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Nouvelle commande</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="col-12">
                      <form id="form_ajout_commande">
                          <div class="row">
                              <div class="col-6">
                                  <div class="form-group">
                                      <label for="ajout_commande_date">Date de la commande</label>
                                      <input type="datetime-local" class="form-control" id="ajout_commande_date" name="ajout_commande_date">
                                  </div>
                              </div>
                              <div class="col-6">
                                  <div class="form-group">
                                      <label for="ajout_commande_fournisseur">Fournisseur</label>
                                      <select class="form-control" id="ajout_commande_fournisseur" name="ajout_commande_fournisseur">
                                          <option value="NULL">Choisir un Fournisseur</option>
                                          <?php
                                            foreach ($this->fournisseurs as $fournisseur) {
                                            ?>
                                              <option value="<?php echo $fournisseur['fournisseur_id']; ?>"><?php echo $fournisseur['nom_fournisseur']; ?></option>
                                          <?php
                                            }
                                            ?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-6">
                                  <div class="form-group">
                                      <label for="ajout_commande_produit">Produit <span style="color: red;">*</span></label>
                                      <select class="form-control" id="ajout_commande_produit" name="ajout_commande_produit">
                                          <option value="NULL">Choisir un produit</option>
                                          <?php
                                            foreach ($this->produits as $produit) {
                                            ?>
                                              <option value="<?php echo $produit['produit_id']; ?>"><?php echo $produit['designation']; ?></option>
                                          <?php
                                            }
                                            ?>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-4">
                                  <div class="form-group">
                                      <label for="ajout_commande_quantite">Quantité <span style="color: red;">*</span></label>
                                      <input class="form-control" type="number" id="ajout_commande_quantite" name="ajout_commande_quantite">
                                  </div>
                              </div>
                              <div class="col-2">
                                  <div class="form-group">
                                      <label for="appro_quantite">.</label>
                                      <button class="btn btn-primary form-control" id="ajouter_produit_commande_panier">Ajouter</button>
                                  </div>
                              </div>
                          </div>
                          <hr>
                          <div class="row">
                              <div class="col-12">
                                  <h4>Les produits</h4>
                                  <table class="table table-bordered" id="table_produit_commande">
                                      <thead>
                                          <tr>
                                              <th>Produit</th>
                                              <th>Quantité</th>
                                              <th style="width: 40px">Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody id="body_table_produit_commande">

                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                  <button type="button" class="btn btn-primary" id="btn_valider_ajouter_commande">Valider</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <!-- Modal voir commande -->
  <div class="modal fade" id="modal_voir_commande">
      <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Commande</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <div class="col-12">
                      <div class="callout callout-warning">
                          <h5>Détails de la commande</h5>
                          <table class="table table-hover table-bordered">
                              <thead>
                                  <tr>
                                      <th>Date de la commande</th>
                                      <th>Statut de la commande</th>
                                      <th>Fournisseur</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td id="voir_commande_details_date"></td>
                                      <td id="voir_commande_details_statut"></td>
                                      <td id="voir_commande_details_fournisseur"></td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                      <div class="callout callout-warning">
                          <h5>Produits</h5>
                          <table class="table table-hover table-bordered">
                              <thead>
                                  <tr>
                                      <th>Désignation</th>
                                      <th>Quantité</th>
                                  </tr>
                              </thead>
                              <tbody id="voir_commande_body_produit_rows">

                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->


  <div id="div_print_commande">
      <div class="row">
          <div class="col-6">
              <img src="<?php echo URL; ?>public/images/logo.png" alt="logo introuvable" width="180px" style="margin-left: 30px;">
          </div>
          <div class="col-6" style="padding-top: 20px; padding-left: 40px; ">
              <p style="font-size: 30px; margin-bottom: 5px;">LISUNGI S.A.</p> <br>
              <span style="font-size: 20px;">Immeuble BUO, Avenue Wagenia, 218-220,</span> <br>
              <span style="font-size: 20px;">Kinshasa Gombe</span> <br>
              <span style="font-size: 20px;">République Démocratique du Congo</span>
          </div>

          <div style="width: 100%; border-bottom: 5px solid black; margin-top: 50px;">
          </div>
      </div>

      <div align="center">
          <p style="font-size: 30px; margin-top: 40px; margin-bottom: 50px; font-weight: bold;">
              BON DE COMMANDE <br>
              <!-- <span id="print_etat_stock_date"></span> -->
          </p>
      </div>

      <div>
          <table class="table" style="border: 2px solid black; font-size: 25px;">
              <thead>
                  <tr>
                      <td style="border: 2px solid black;" width="50%">
                          <span style="font-weight: bold;">A l'intention de </span> <br>
                          <span>Nom : </span>  <br>
                          <span>Adresse : </span>  <br>
                          <span>Téléphone : </span> 
                      </td>
                      <td style="border: 2px solid black; padding-bottom: 88px;">
                          <span>Date de la commande : 10/51/2022</span> <br>
                          <span>Numéro de la commande : 321321542</span>
                      </td>
                  </tr>
              </thead>
          </table>
      </div>

      <div style="margin-top: 50px;">
          <table class="table" id="table_print_etat_stock" style="border: 2px solid black; font-size: 25px;">
              <thead>
                  <tr>
                      <th style="border: 2px solid black;">Quantité</th>
                      <th style="border: 2px solid black;">Désignation</th>
                      <th style="border: 2px solid black;">Prix Unitaire.</th>
                      <th style="border: 2px solid black;">Prix Total.</th>
                  </tr>
              </thead>
              <tbody id="print_etat_table_body">

              </tbody>
          </table>
      </div>

      <div class="row" style="margin-top: 500px; font-size: 25px;">
          <div class="col-6" style="text-align: center;">
              <p>Henry Emile BRAUN <br>Président Directeur général</p>
          </div>
          <div class="col-6" style="text-align: center;">
              <?php echo Session::get('nom') . ' ' . Session::get('postnom') . ' ' . Session::get('prenom'); ?><br>
              <span>Chargé logistique</span>
          </div>
      </div>

  </div>