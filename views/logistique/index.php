  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Stock</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Stock</li> 
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
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="operation-stock-tab" data-toggle="pill" href="#operation-stock" role="tab" aria-controls="operation-stock" aria-selected="true">Produits en stock</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="mouvement-stock-tab" data-toggle="pill" href="#mouvement-stock" role="tab" aria-controls="mouvement-stock" aria-selected="false">Produit en vente</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="bon-livraison-tab" data-toggle="pill" href="#bon-livraison" role="tab" aria-controls="bon-livraison" aria-selected="false">Produit vendu</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="operation-stock" role="tabpanel" aria-labelledby="operation-stock-tab">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                            <h3 class="card-title">
                              Stock
                            </h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-primary btn-sm" id="btn_print_rapport_sur_etat_stock">
                                <i class="fas fa-print"></i> Imprimer un rapport sur l'état du stock
                              </button>
                              <button type="button" class="btn btn-primary btn-sm" id="btn_modal_sortir_stock">
                                <i class="fas fa-plus"></i> Sortie de stock
                              </button>
                              <button type="button" class="btn btn-primary btn-sm" id="btn_modal_approvisionnement">
                                <i class="fas fa-plus"></i> Approvisionnement
                              </button>
                            </div>
                          </div>
                          <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline clientSideDataTable" id="table_produit_en_stock">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Barecode</th>
                                  <th>Produit</th>
                                  <th>Catégorie</th>
                                  <th>Quantité en stock</th>
                                  <th>Entrées</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php echo $this->produitStock; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="mouvement-stock" role="tabpanel" aria-labelledby="mouvement-stock-tab">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                            <h3 class="card-title">
                              En ventes
                            </h3>
                            <div class="card-tools">
                              <div class="input-group input-group-sm">
                                <select name="triType" id="triType" class="form-control mr-2 float-right">
                                  <option value="1">Date précise</option>
                                  <option value="2">Période</option>
                                </select>
                                <input type="date" id="get_entree_mouvement_onedate" name="table_search" class="form-control mr-2 float-right" placeholder="Search">
                                <input type="date" id="get_entree_mouvement_debutdate" name="table_search" class="form-control mr-2 float-right" placeholder="Search">
                                <input type="date" id="get_entree_mouvement_findate" name="table_search" class="form-control mr-2 float-right" placeholder="Search">
                                <select name="get_entree_mouvement_fournisseur" id="get_entree_mouvement_fournisseur" class="form-control mr-2 float-right">
                                  <option value="0">Choisir une Fournisseur</option>
                                  <?php
                                  foreach ($this->fournisseurs as $fournisseur) {
                                  ?>
                                    <option value="<?php echo $fournisseur['fournisseur_id']; ?>"><?php echo $fournisseur['nom_fournisseur']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                                <select name="get_entree_mouvement_produit" id="get_entree_mouvement_produit" class="form-control mr-2 float-right">
                                  <option value="0">Choisir un Produit</option>
                                  <?php
                                  foreach ($this->produits as $produit) {
                                  ?>
                                    <option value="<?php echo $produit['produit_id']; ?>"><?php echo $produit['designation']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                                <select name="get_entree_mouvement_categorie" id="get_entree_mouvement_categorie" class="form-control mr-2 float-right">
                                  <option value="0">Choisir un Catégorie</option>
                                  <?php
                                  foreach ($this->categories as $categorie) {
                                  ?>
                                    <option value="<?php echo $categorie['categorie_id']; ?>"><?php echo $categorie['designation_cat']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                                <button type="button" name="table_search" id="btn_afficher_mvt_entre_filtre" class="form-control mr-2 float-right btn-primary"> <i class="fa fa-search"></i> Afficher</button>

                                <!-- <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div> -->
                              </div>
                            </div>
                          </div>
                          <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline clientSideDataTable" id="table_mouvement_entree" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Barecode</th>
                                  <th>Produit</th>
                                  <th>Catégorie</th>
                                  <th>Quantité en stock</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  echo $this->produit_en_vente;
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="bon-livraison" role="tabpanel" aria-labelledby="bon-livraison-tab">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="card card-primary card-outline">
                          <div class="card-header">
                            <h3 class="card-title">
                             Produit vendu
                            </h3>
                          </div>
                          <div class="card-body">
                            <table class="table table-bordered table-striped dataTable dtr-inline clientSideDataTable" width="100%">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Barecode</th>
                                  <th>Produit</th>
                                  <th>Catégorie</th>
                                  <th>Quantité en stock</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php echo $this->produit_vendu; ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Modal Approvisionner -->
  <div class="modal fade" id="modal_approvisionnement_stock">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Approvisionnement le stock</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-12">
            <form id="form_ajouter_produits_au_stock" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-2">
                  <div class="form-group">
                    <label for="appro_date">Date</label>
                    <input class="form-control" type="datetime-local" id="appro_date" name="appro_date">
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label for="appro_fournisseur">Fournisseur</label>
                    <select class="form-control" name="appro_fournisseur" id="appro_fournisseur">
                      <option value="NULL">Choisir un fournisseur</option>
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
                <div class="col-2">
                  <div class="form-group">
                    <label for="appro_numero_bon">Numéro bon</label>
                    <input class="form-control" type="text" id="appro_numero_bon" name="appro_numero_bon">
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label for="appro_bon_livraison_image">Image du bon</label>
                    <input class="form-control" type="file" name="appro_bon_livraison_image" id="appro_bon_livraison_image">
                  </div>
                </div>
                <div class="col-3">
                  <div class="form-group">
                    <label for="appro_commande">Commande</label>
                    <select class="form-control" name="appro_commande" id="appro_commande">
                      <option value="NULL">Choisir une commande</option>
                      <?php
                      foreach ($this->commandes as $commande) {
                      ?>
                        <option value="<?php echo $commande['commande_id']; ?>"><?php echo $commande['numero_commande']; ?></option>
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
                    <label for="appro_produit">Produit</label>
                    <select class="form-control" id="appro_produit" name="appro_produit">
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
                    <label for="appro_quantite">Quantité</label>
                    <input class="form-control" type="number" id="appro_quantite" name="appro_quantite">
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label for="appro_quantite">.</label>
                    <button class="btn btn-primary form-control" id="ajouter_produit_panier">Ajouter</button>
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-12">
                  <h4>Les ajouts</h4>
                  <table class="table table-bordered" id="table_produit_a_ajouter">
                    <thead>
                      <tr>
                        <th>Produit</th>
                        <th>Catégorie</th>
                        <th>Quantité</th>
                        <th style="width: 40px">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="body_table_produit_entre">

                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" id="btn_valider_approvisionnement">Valider l'Approvisionnement</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal sortie Produits du stock -->
  <div class="modal fade" id="modal_sortie_produits_du_stock">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Sortir des produits du stock</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-12">
            <form id="form_sortie_produits_du_stock">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="sortie_produit">Produit <span style="color: red;">*</span></label>
                    <select class="form-control" id="sortie_produit" name="sortie_produit">
                      <option value="NULL">Choisir un produit</option>
                      <?php
                      foreach ($this->produits as $produit) {
                      ?>
                        <option value="<?php echo $produit['produit_id']; ?>"><?php echo $produit['designation'] . ' -  (Quantité en stock : ' . ($produit['som_entree'] - $produit['som_sortie']) . ' )'; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="sortie_quantite">Quantité <span style="color: red;">*</span></label>
                    <input class="form-control" type="number" id="sortie_quantite" name="sortie_quantite">
                  </div>
                </div>
                <div class="col-2">
                  <div class="form-group">
                    <label for="appro_quantite">.</label>
                    <button class="btn btn-primary form-control" id="ajouter_produit_sorti_panier">Ajouter</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="sortie_agent">Motif</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-12">
                  <h4>Les Sorties</h4>
                  <table class="table table-bordered" id="table_produit_a_sortir">
                    <thead>
                      <tr>
                        <th>Produit</th>
                        <th>Catégorie</th>
                        <th>Quantité</th>
                        <th style="width: 40px">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="body_table_produit_sortie">

                    </tbody>
                  </table>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" id="btn_valider_sortie_produits_du_stock">Valider</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!-- Modal voir details bon de livraison -->
  <div class="modal fade" id="modal_voir_bon_livraison">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Bon de livraison</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-12">

            <div class="callout callout-warning">
              <h5>Détails du bon</h5>
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Numéro</th>
                    <th>Date livraison</th>
                    <th>Fournisseur</th>
                    <th>Utilisateur</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td id="voir_bon_livraison_details_numero"></td>
                    <td id="voir_bon_livraison_details_date_livraison"></td>
                    <td id="voir_bon_livraison_details_fournisseur"></td>
                    <td id="voir_bon_livraison_details_utilisateur"></td>
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
                <tbody id="voir_bon_livraison_details_body_produit_rows">

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

  <!-- Modal voir image bon de livraison -->
  <div class="modal fade" id="modal_voir_image_bon_livraison">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Image du Bon de livraison</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-12">
            <img src="" alt="Image introuvable" class="img-fluid" id="voir_image_bon_img">
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

  <div id="div_rapport_etat_stock">
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
      <p style="font-size: 30px; margin-top: 40px; margin-bottom: 70px;">
        RAPPORT SUR L'ETAT DU STOCK <br>
        <span id="print_etat_stock_date"></span>
      </p>
    </div>

    <div>
      <table class="table" id="table_print_etat_stock" style="border: 2px solid black; font-size: 25px;">
        <thead>
          <tr>
            <th style="border: 2px solid black;">Produit</th>
            <th style="border: 2px solid black;">Catégorie</th>
            <th style="border: 2px solid black;">Quantité</th>
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