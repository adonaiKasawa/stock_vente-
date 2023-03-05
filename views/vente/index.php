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
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  Mes Achats
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
                      <option value="0">Choisir un Produit</option>
                      <option value="en_cours">CARBURANT DDD</option>
                      <option value="validee">FARINE ZZZ</option>
                    </select>
                    <button type="button" name="table_search" id="btn_afficher_commandes_filtre" class="form-control mr-2 float-right btn-primary"> <i class="fa fa-search"></i> Afficher</button>
                    <button type="button" class="btn btn-warning btn-sm float-right mr-2" id="btn_print_to_pdf"><i class="fas fa-print"></i>Imprimer en PDF</button>
                    <button type="button" class="btn btn-success btn-sm float-right" id="btn_print_to_pdf"><i class="fas fa-print"></i>Exporter en Excel</button>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered" id="table_produit_a_ajouter">
                  <thead>
                    <tr class="bg-primary">
                      <th>N°</th>
                      <th>Date</th>
                      <th>Produit</th>
                      <th>Quantité</th>
                      <th>Montant</th>
                      <th>Numero de la facture</th>
                      <th>Client</th>
                      <th style="width: 40px">Actions</th>
                    </tr>
                  </thead>
                  <tbody id="body_table_produit_entre">
                    <tr>
                      <td>1</td>
                      <td>2022-10-27 11:01:00</td>
                      <td>FARINE FFF</td>
                      <td>132</td>
                      <td>20000$</td>
                      <td>F-0031566</td>
                      <td>Elysee Luboya</td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_voir_detail_achat" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>2022-10-27 11:01:00</td>
                      <td>FARINE GGG</td>
                      <td>211</td>
                      <td>1500$</td>
                      <td>F-0031565</td>
                      <td>Adonai Mbula</td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_voir_detail_achat" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>2022-10-27 11:01:00 </td>
                      <td>CARBURANT TTT</td>
                      <td>325</td>
                      <td>3255$</td>
                      <td>F-0031575</td>
                      <td>Elsie Musinga</td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_voir_detail_achat" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>2022-10-27 11:01:00</td>
                      <td>FARINE FFF</td>
                      <td>132</td>
                      <td>20000$</td>
                      <td>F-0031566</td>
                      <td>Elysee Luboya</td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_voir_detail_achat" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>2022-10-27 11:01:00</td>
                      <td>FARINE GGG</td>
                      <td>211</td>
                      <td>1500$</td>
                      <td>F-0031565</td>
                      <td>Adonai Mbula</td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_voir_detail_achat" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>2022-10-27 11:01:00 </td>
                      <td>CARBURANT TTT</td>
                      <td>325</td>
                      <td>3255$</td>
                      <td>F-0031575</td>
                      <td>Elsie Musinga</td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_voir_detail_achat" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="4"><b>Total</b></td>
                      <td colspan="1" class="bg-primary"><b>35 400$</b></td>
                      <td colspan="3"><b></b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->