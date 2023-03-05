  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Categorie</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestion des categorie</li>
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
              <div class="card-header">
                <h3 class="card-title">
                Categorie
                </h3>
                <div class="card-tools">
                  <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_add_categorie">Ajouter une categorie</button>
                </div>
              </div>
              <div class="card-body">
                <table id="table_all_categorie" class="table table-bordered" id="" width="100%">
                  <thead>
                    <tr class="bg-primary">
                      <th style="width: 10px">#</th>
                      <th>Nom</th>
                      <th>Description</th>
                      <th width="10px">Actions</th>
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


  <!-- Modal ajout rapport journalier impression cartes -->
  <div class="modal fade" id="modal_add_categorie">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nouvelle categorie</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-12">
            <form id="form_ajout_categorie">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="ajout_commande_date">Nom <span style="color: red;">*</span></label>
                    <input type="text" placeholder="Nom" class="form-control" id="designation" name="ajout_commande_date">
                  </div>
                </div>
                <div class="col-12">
                   <div class="form-group">
                    <label for="ajout_commande_date">Description <span style="color: red;">*</span></label>
                    <textarea name="description" id="description" class="form-control" cols="30" rows="10" placeholder="description"></textarea>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" id="btn_valider_ajout_categorie">Valider</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <div class="modal fade" id="modal_update_fournisseur">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modifier les information sur le catalogue</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-12">
            <form id="form_ajout_commande">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="ajout_commande_date">Nom <span style="color: red;">*</span></label>
                    <input type="text" placeholder="Nom"value="Boison" class="form-control" id="ajout_commande_date" name="ajout_commande_date">
                  </div>
                </div>
                <div class="col-12">
                   <div class="form-group">
                    <label for="ajout_commande_date">Description <span style="color: red;">*</span></label>
                    <textarea name="" id="" class="form-control" cols="30" rows="10" placeholder="description">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. In ab quas quis vitae earum illum, reiciendis veritatis molestias alias repellat. Est nihil architecto ex sequi, vero consectetur. Eum, quaerat voluptates.
                    </textarea>
                  </div>
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
                  <tr>
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
                  <tr>
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
          <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header text-muted border-bottom-0">
                  Digital Strategist
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Nicole Pearson</b></h2>
                      <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="<?= URL ?>public/frameworks/dist/img/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
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
                  <tr>
                    <th>Observation</th>
                    <th>Prix</th>
                  </tr>
                </thead>
                <tbody id="">
                 <tr>
                  <td>PVC</td>
                  <td>10$</td>
                 </tr>
                 <tr>
                  <td>Ordinateur</td>
                  <td>1000$</td>
                 </tr>
                 <tr>
                  <td>Télévision</td>
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
