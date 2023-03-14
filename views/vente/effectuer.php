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
      <div class="row">
        <div class="container-fluid">
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Vendre
                </h3>
              </div>
              <div class="card-body">
                <div class="col-12">
                  <div>
                    <div class="row">
                      <!-- <div class="col-3">
                        <div class="form-group">
                          <label for="appro_client">Client</label>
                          <select class="form-control select2" style="width: 100%;" id="appro_client" name="appro_client">
                            <option value="NULL">Choisir un client</option>
                            <option value="NULL">Client 1</option>
                            <option value="NULL">Client 2</option>
                          </select>
                        </div>
                      </div> -->
                      <div class="col-4">
                        <div class="form-group">
                          <label for="appro_produit">Produit</label>
                          <select class="form-control select2" style="width: 100%;" id="on_sale_produit" name="appro_produit">
                            <option value="NULL">Choisir un produit</option>
                            <?php
                              if (isset($this->produitOnSale)) {
                                if (!empty($this->produitOnSale)) {
                                  foreach ($this->produitOnSale as $key) {
                              ?>
                                <option value="<?= $key['produit_id'] ?>"><?= $key['designation'] ?></option>
                              <?php
                                  }
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="on_sale_quantite">Quantité</label>
                          <input class="form-control" placeholder="0" type="number" id="on_sale_quantite" name="on_sale_quantite">
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="form-group">
                          <label for="appro_quantite">.</label>
                          <button type="button" class="btn btn-primary form-control disabled" id="ajouter_produit_panier">Ajouter</button>
                        </div>
                      </div>
                    </div>
                    <div class="row col-6">
                        <div id="view_posibilite_to_sale"></div>
                    </div>

                    <hr>

                    <div class="row">
                      <div class="col-12">
                        <h4>Aperçu</h4>
                        <table class="table table-bordered" id="table_produit_a_ajouter">
                          <thead>
                            <tr class="bg-primary">
                              <th>#</th>
                              <th>Produit</th>
                              <th>Quantité</th>
                              <th>Prix Unitaire</th>
                              <th>Total</th>
                              <th style="width: 40px">Actions</th>
                            </tr>
                          </thead>
                          <tbody id="body_table_produit_commande">
                            <!-- <tr>
                              <td>FARINE ZZZ</td>
                              <td>4</td>
                              <td>5000$</td>
                              <td>20000$</td>
                              <td><button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button></td>
                            </tr>
                            <tr>
                              <td>CARBURANT DDD</td>
                              <td>10</td>
                              <td>1500$</td>
                              <td>15000$</td>
                              <td><button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button></td>
                            </tr>
                            <tr>
                              <td>FARINE PPPP</td>
                              <td>5</td>
                              <td>80$</td>
                              <td>400$</td>
                              <td><button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button></td>
                            </tr>
                            <tr>
                              <td colspan="3"><b>Total</b></td>
                              <td colspan="2"><b>35 400$</b></td>
                            </tr> -->
                          </tbody>
                        </table>
                        <button type="button" class="btn btn-primary float-right" id="btn_valider_vente">Valider la vente</button>
                      </div>
                    </div>
                    
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

  <div id="div_print_facture">
    <div class="row">
      <div class="col-6">
        <img src="<?php echo URL; ?>public/images/logo.png" alt="logo introuvable" width="180px" style="margin-left: 30px;">
      </div>
      <div class="col-6" style="padding-top: 20px; padding-left: 40px; ">
        <p style="font-size: 30px; margin-bottom: 5px;">Rstock pro</p> <br>
        <span style="font-size: 20px;">Avenue kimbao, 63b</span> <br>
        <span style="font-size: 20px;">Kinshasa Ngiri-ngiri</span> <br>
        <span style="font-size: 20px;">République Démocratique du Congo</span>
      </div>

      <div style="width: 100%; border-bottom: 5px solid black; margin-top: 50px;">
      </div>
    </div>

    <div align="center">
      <p style="font-size: 30px; margin-top: 40px; margin-bottom: 70px;">
        Facture <br>
        <span id="print_facture_date"></span>
      </p>
    </div>

    <div>
      <table class="table" id="table_print_etat_stock" style="border: 2px solid black; font-size: 25px;">
        <thead>
          <tr>
            <th style="border: 2px solid black;">#</th>
            <th style="border: 2px solid black;">Produit</th>
            <th style="border: 2px solid black;">Quantité</th>
            <th style="border: 2px solid black;">Prix Unitaire</th>
            <th style="border: 2px solid black;">Total</th>
          </tr>
        </thead>
        <tbody id="print_facture_table_body">
        
        </tbody>
      </table>
    </div>

    <div class="row" style="margin-top: 500px; font-size: 25px;">
      <!-- <div class="col-6" style="text-align: center;">
        <p>Henry Emile BRAUN <br>Président Directeur général</p>
      </div> -->
      <div class="col-6" style="text-align: center;">
        <?php echo Session::get('nom') . ' ' . Session::get('postnom') . ' ' . Session::get('prenom'); ?><br>
        <span>Charger de la caisse</span>
      </div>
    </div>

  </div>