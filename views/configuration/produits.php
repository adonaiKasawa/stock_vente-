<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Produits</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Produits</li>
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
                <!-- <i class="fas fa-edit"></i> -->
                Produits
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-primary btn-sm" id="btn_show_modal_add_produit">
                  <i class="fas fa-plus"></i> Ajouter un Produit
                </button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="table_produit">
                <thead>
                  <tr class="bg-primary">
                    <th style="width: 10px">#</th>
                    <th>Désignation</th>
                    <th>Barcode</th>
                    <th>Caracteristique</th>
                    <th>Catégorie</th>
                    <th style="width: 30px">Actions</th>
                  </tr>
                </thead>
              </table>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">
                <!-- <i class="fas fa-edit"></i> -->
                Mise en vente des entrées
              </h3>
              <div class="card-tools">
                <button type="button" data-toggle="modal" data-target="#modal_mise_envente"
                  class="btn btn-primary btn-sm">
                  <i class="fas fa-plus"></i> Mettre en vente
                </button>
              </div>
            </div>
            <div class="card-body">
              <table class="table table-bordered" id="table_entrees_produit_mise_envente">
                <thead>
                  <tr class="bg-primary">
                    <th style="width: 10px">#</th>
                    <th>Date mise en vente</th>
                    <th>Barcode</th>
                    <th>Désignation</th>
                    <th>Qt</th>
                    <th>Prix d'achat</th>
                    <th>Prix de vente</th>
                    <th style="width: 30px">Actions</th>
                  </tr>
                </thead>
              </table>
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


<!-- LES MODALS -->

<!-- Modal ajouter categoreie -->
<div class="modal fade" id="modal_update_produit">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Modifier le produit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <form id="form_ajouter_produit">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="designation_prod">Désignation</label>
                    <input type="text" class="form-control" id="designation_prod" placeholder="Désignation">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="barcode">Barcode</label>
                    <input type="text" class="form-control" id="barcode" placeholder="Barcode">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="caracteristique">Caracteristique</label>
                    <input type="text" class="form-control" id="caracteristique" placeholder="Caracteristique">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="categorie_prod">Catégorie</label>
                    <select class="form-control" name="categorie_prod" id="categorie_prod">
                      <option value="NULL">Choisir une catégorie</option>
                      <?php
                      foreach ($this->categories as $categorie) {
                        ?>
                        <option value="<?php echo $categorie['categorie_id']; ?>"><?php echo $categorie['designation_cat']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="categorie_prod">Fournisseur</label>
                      <select class="form-control" name="categorie_prod" id="categorie_prod">
                        <option value="NULL">Choisir un fournisseur</option>
                        <option value="">USCT</option>
                        <option value="">UAC</option>
                        <option value="">SOKIN</option>
                      </select>
                    </div>
                  </div>
                </div> -->
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" id="btn_valider_ajout_categorie">Modifier</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal ajouter categoreie -->
<div class="modal fade" id="modal_mise_envente">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Mettre en vente le produit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <form id="form_ajouter_produit">
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label for="produit_mise_envente">Produits</label>
                    <select class="form-control select2" name="produit_mise_envente" id="produit_mise_envente">
                      <option value="NULL">Choisir un produit</option>
                      <?php
                      foreach ($this->produits as $produits) {
                        ?>
                        <option value="<?php echo $produits['produit_id']; ?>"><?php echo $produits['designation']; ?>
                        </option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="entree_enstock">Entree en stock</label>
                    <select class="form-control" name="entree_enstock" id="entree_enstock">
                      <option value="NULL">Choisir une entree</option>
                    </select>
                  </div>
                </div>
                <div class="col-6" id="prix_entendus"></div>
                <div class="col-6" id="prix_entendus_resultat"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" id="btn_valider_mise_envente">Valider</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal ajouter Produit -->
<div class="modal fade" id="modal_ajouter_produit">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ajouter un produit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <form id="form_ajouter_produit">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="designation_prod">Désignation</label>
                  <input type="text" class="form-control" id="designation_prod_add" placeholder="Désignation">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="barcode">Barcode</label>
                  <input type="text" class="form-control" id="barcode_pro_add" placeholder="Barcode">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="caracteristique">Caracteristique</label>
                  <input type="text" class="form-control" id="caracteristique_pro_add" placeholder="Caracteristique">
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="categorie_prod">Catégorie</label>
                  <select class="form-control" name="categorie_prod" id="categorie_prod_add">
                    <option value="NULL">Choisir une catégorie</option>
                    <?php
                    foreach ($this->categories as $categorie) {
                      ?>
                      <option value="<?php echo $categorie['categorie_id']; ?>"><?php echo $categorie['designation_cat']; ?></option>
                    <?php
                    }
                    ?>

                  </select>
                </div>
              </div>
            </div>
            <!-- <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="categorie_prod">Fournisseur</label>
                    <select class="form-control" name="categorie_prod" id="categorie_prod">
                      <option value="NULL">Choisir un fournisseur</option>
                      <option value="">USCT</option>
                      <option value="">UAC</option>
                      <option value="">SOKIN</option>
                    </select>
                  </div>
                </div>
              </div> -->
          </form>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" id="btn_valider_ajout_produit">Ajouter</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->