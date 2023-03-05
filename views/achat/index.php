<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Gestion des achats</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Gestion des achats</li>
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
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    Entrée
                  </h3>
                </div>
                <div class="card-body">
                  <div class="col-12">
                    <form id="form_ajouter_produits_au_stock" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-3">
                          <div class="form-group">
                            <label for="produit_entree">Produit</label>
                            <select class="form-control select2" id="produit_entree" name="produit_entree">
                              <option value="NULL">Choisir un produit</option>
                              <?php
                              if (isset($this->produits)) {
                                foreach ($this->produits as $row) {
                                  ?>
                                  <option value="<?= $row['produit_id'] ?>"><?= $row['designation'] ?></option>
                                <?php
                                }
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label for="quantite_entree">Quantité</label>
                            <input class="form-control" placeholder="0" type="number" id="quantite_entree"
                              name="quantite_entree">
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label for="prix_entree">Prix d'achat</label>
                            <input class="form-control" placeholder="0" type="number" id="prix_entree"
                              name="prix_entree">
                          </div>
                        </div>
                        <div class="col-3">
                          <div class="form-group">
                            <label for="add_produit">.</label>
                            <button class="btn btn-primary form-control" id="submit_entree_produit">Valider
                              l'entrée</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    Les entrée
                  </h3>
                  <div class="card-tools">
                    <div class="input-group input-group-sm">
                      <select name="triType" id="triType" class="form-control mr-2 float-right">
                        <option value="1">Date précise</option>
                        <option value="2">Période</option>
                      </select>
                      <input type="date" id="get_commande_onedate" name="table_search"
                        class="form-control mr-2 float-right">
                      <input type="date" id="get_commande_debutdate" name="table_search"
                        class="form-control mr-2 float-right">
                      <input type="date" id="get_commande_findate" name="table_search"
                        class="form-control mr-2 float-right">
                      <select name="get_commande_fournisseur" id="get_commande_fournisseur"
                        class="form-control mr-2 float-right">
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
                        <option value="0">Choisir un Produit</option>
                        <option value="en_cours">CARBURANT DDD</option>
                        <option value="validee">FARINE ZZZ</option>
                      </select>
                      <button type="button" name="table_search" id="btn_afficher_commandes_filtre"
                        class="form-control mr-2 float-right btn-primary"> <i class="fa fa-search"></i>
                        Afficher</button>
                      <button type="button" class="btn btn-warning btn-sm float-right mr-2" id="btn_print_to_pdf"><i
                          class="fas fa-print"></i>Imprimer en PDF</button>
                      <button type="button" class="btn btn-success btn-sm float-right" id="btn_print_to_pdf"><i
                          class="fas fa-print"></i>Exporter en Excel</button>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <table class="table table-bordered" id="table_entrees_dataTables">
                    <thead>
                      <tr class="bg-primary">
                        <th>N°</th>
                        <th>Date</th>
                        <th>Barcode</th>
                        <th>Produit</th>
                        <th>Qt</th>
                        <th>Prix d'achat</th>
                        <th style="width: 40px">Actions</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </section>
  <!-- /.content -->

</div>
<!-- /.content-wrapper -->

<!-- Modal voir details d'achat -->
<div class="modal fade" id="modal_voir_detail_achat">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detais de l'achat</h4>
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
                <tr class="bg-primary">
                  <th>Numéro</th>
                  <th>Date de l'achat</th>
                  <th>Fournisseur</th>
                  <th>Utilisateur</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td id="voir_bon_livraison_details_numero">1</td>
                  <td id="voir_bon_livraison_details_date_livraison">2022-10-27 11:01:00</td>
                  <td id="voir_bon_livraison_details_fournisseur">UAC</td>
                  <td id="voir_bon_livraison_details_utilisateur">Mbula Adonai</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="callout callout-warning">
            <h5>Produits</h5>
            <table class="table table-bordered" id="table_produit_a_ajouter">
              <thead>
                <tr class="bg-primary">
                  <th>Produit</th>
                  <th>Prix Unitaire</th>
                  <th>Quantité</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody id="body_table_produit_entre">
                <tr>
                  <td>Voiture</td>
                  <td>5000$</td>
                  <td>4</td>
                  <td>20000$</td>
                </tr>
                <tr>
                  <td>Ordinateur</td>
                  <td>1500$</td>
                  <td>10</td>
                  <td>15000$</td>
                </tr>
                <tr>
                  <td>Clavier</td>
                  <td>80$</td>
                  <td>5</td>
                  <td>400$</td>
                </tr>
                <tr>
                  <td colspan="3"><b>Total</b></td>
                  <td colspan="2"><b>35 400$</b></td>
                </tr>
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

<!-- Modal voir  Catalogue fournisseur -->
<div class="modal fade" id="modal_voir_catalogue">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Fournisseur</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="col-12 col-sm-6 col-md-12 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
              <div class="card-header text-muted border-bottom-0">

              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col-7">
                    <h2 class="lead"><b>FOURNISSEUR</b></h2>
                    <p class="text-muted text-sm"> Lorem ipsum, dolor sit amet consectetur adipisicing elit. </p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Lorem
                        ipsum dolor sit amet.</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 243
                        819664909</li>
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email #:
                        Nel7luboya@gmail.com</li>
                    </ul>
                  </div>
                  <div class="col-5 text-center">
                    <img src="<?= URL ?>public/frameworks/dist/img/user1-128x128.jpg" alt="user-avatar"
                      class="img-circle img-fluid">
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <div class="text-right">
                  <a href="#" class="btn btn-sm bg-teal">
                    <i class="fas fa-comments"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <h4>Catalogue</h4>
          <div class="callout callout-warning">
            <h5>Produits</h5>
            <table class="table table-hover table-bordered">
              <thead>
                <tr class="bg-primary">
                  <th>Observation</th>
                  <th>Prix</th>
                </tr>
              </thead>
              <tbody id="">
                <tr>
                  <td>CARBURANT PPP</td>
                  <td>10$</td>
                </tr>
                <tr>
                  <td>FARINE GGG</td>
                  <td>1000$</td>
                </tr>
                <tr>
                  <td>CARBURANT NNN</td>
                  <td>1000$</td>
                </tr>
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
      <img src="<?php echo URL; ?>public/images/logo.png" alt="logo introuvable" width="180px"
        style="margin-left: 30px;">
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
            <span>Nom : </span> <br>
            <span>Adresse : </span> <br>
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