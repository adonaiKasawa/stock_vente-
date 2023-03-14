  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Gestion de vente</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestion de vente</li>
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
                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="all_ventes_tab" data-toggle="pill" href="#all_ventes" role="tab" aria-controls="all_ventes" aria-selected="true">Tout les ventes</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="all_ventes_byfacture_tab" data-toggle="pill" href="#all_ventes_byfacture" role="tab" aria-controls="all_ventes_byfacture" aria-selected="false">Vente par facture</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-two-tabContent">
                  <div class="tab-pane fade show active" id="all_ventes" role="tabpanel" aria-labelledby="all_ventes_tab">
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
                          <option value="0">Choisir un Produit</option>
                          <option value="en_cours">CARBURANT DDD</option>
                          <option value="validee">FARINE ZZZ</option>
                        </select>
                        <button type="button" name="table_search" id="btn_afficher_commandes_filtre" class="form-control mr-2 float-right btn-primary"> <i class="fa fa-search"></i> Afficher</button>
                        <button type="button" class="btn btn-warning btn-sm float-right mr-2" id="btn_print_to_pdf"><i class="fas fa-print"></i>Imprimer en PDF</button>
                        <button type="button" class="btn btn-success btn-sm float-right" id="btn_print_to_pdf"><i class="fas fa-print"></i>Exporter en Excel</button>
                      </div>
                    </div>                   
                    <table class="table table-bordered table-striped dataTable dtr-inline" id="table_produit_a_ajouter">
                      <thead>
                        <tr class="bg-primary">
                          <th>N°</th>
                          <th>Date</th>
                          <th>Produit</th>
                          <th>Quantité</th>
                          <th>Montant</th>
                          <th>Montant Total</th>
                          <th>Code de la facture</th>
                          <th>Vendeur</th>
                          <th style="width: 40px">Actions</th>
                        </tr>
                      </thead>
                      <tbody id="getAllVenteBodyTable">
                      </tbody>
                    </table>
                  </div>
                  <div class="tab-pane fade" id="all_ventes_byfacture" role="tabpanel" aria-labelledby="all_ventes_byfacture_tab">
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
                            <option value="0">Choisir un Produit</option>
                            <option value="en_cours">CARBURANT DDD</option>
                            <option value="validee">FARINE ZZZ</option>
                          </select>
                          <button type="button" name="table_search" id="btn_afficher_commandes_filtre" class="form-control mr-2 float-right btn-primary"> <i class="fa fa-search"></i> Afficher</button>
                          <button type="button" class="btn btn-warning btn-sm float-right mr-2" id="btn_print_to_pdf"><i class="fas fa-print"></i>Imprimer en PDF</button>
                          <button type="button" class="btn btn-success btn-sm float-right" id="btn_print_to_pdf"><i class="fas fa-print"></i>Exporter en Excel</button>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped dataTable dtr-inline">
                      <thead>
                        <tr class="bg-primary">
                          <th>N°</th>
                          <th>Date</th>
                          <th>Code de la facture</th>
                          <th>Nombre d'article</th>
                          <th>Montant Total</th>
                          <th>Vendeur</th>
                          <th style="width: 40px">Actions</th>
                        </tr>
                      </thead>
                      <tbody id="getAllVenteByFactureBodyTable">
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

              