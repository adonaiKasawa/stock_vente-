  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Client</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Client</li>
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
                  Client
                </h3>
                <div class="card-tools">
                  <button type="button" data-toggle="modal" data-target="#modal_ajouter_produit" class="btn btn-primary btn-sm" id="btn_show_modal_add_produit">
                    <i class="fas fa-plus"></i> Ajouter un Client
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-bordered" id="" width="100%">
                  <thead>
                    <tr class="bg-primary">
                      <th>Nom</th>
                      <th>Postnom</th>
                      <th>Email</th>
                      <th>Tel</th>
                      <th>Adresse</th>
                      <th>Type de client</th>
                      <th width="10px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Musinga</td>
                      <td>Nthana</td>
                      <td>musingaelsie@gmail.com</td>
                      <td>+243 9900894538</td>
                      <td>kimboa 63b Ngiri-Ngiri</td>
                      <td><span class="badge badge-success">Prospect</span></td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_update_clients" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>Nyelongo</td>
                      <td>Okitosomba</td>
                      <td>nyelongoDeborah@gmail.com</td>
                      <td>+243 859495490</td>
                      <td>kimboa 63b Ngiri-Ngiri</td>
                      <td><span class="badge badge-warning">Potentiel</span></td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_update_clients" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>Mputu</td>
                      <td>Glody</td>
                      <td>mputuglogy@gmail.com</td>
                      <td>+243 859495490</td>
                      <td>kimboa 63b Ngiri-Ngiri</td>
                      <td><span class="badge badge-danger">Partenaire</span></td>
                      <td>
                        <button type="button" data-toggle="modal" data-target="#modal_update_clients" class="btn btn-primary btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-eye"></i></button>
                        <button type="button" class="btn btn-danger btn-xs btn_remove_produit_de_la_liste_to_add" id="0"><i class="fa fa-times"></i></button>
                      </td>
                    </tr>
                  </tbody>
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
  <div class="modal fade" id="modal_update_clients">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modifier le client</h4>
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
                      <label for="designation_prod">Nom</label>
                      <input type="text" class="form-control" id="designation_prod" placeholder="Nom" value="Musinga">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Postnom">Postnom</label>
                      <input type="text" class="form-control" id="postnom" placeholder="postnom" value="Nthana">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="Prénom">Prénom</label>
                      <input type="text" class="form-control" id="Prénom" placeholder="Prénom" value="">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="nbre_par_pq">Email</label>
                      <input type="text" class="form-control" id="nbre_par_pq" placeholder="Email" value="musingaelsie@gmail.com">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="nbre_par_pq">Tel</label>
                      <input type="text" class="form-control" id="nbre_par_pq" placeholder="Tel" value="+243 859495490">
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label for="categorie_prod">Privilege</label>
                      <select class="form-control" name="categorie_prod" id="categorie_prod" value="Prospect">
                        <option value="NULL">Choisir un Privilege</option>
                        <option value="Partenaire">Partenaire</option>
                        <option value="Prospect" selected>Prospect</option>
                        <option value="Potentiel">Potentiel</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row"></div>
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

  <!-- Modal ajouter Produit -->
  <div class="modal fade" id="modal_ajouter_produit">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ajouter un client</h4>
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
                    <label for="designation_prod">Nom</label>
                    <input type="text" class="form-control" id="designation_prod" placeholder="Nom">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="Postnom">Postnom</label>
                    <input type="text" class="form-control" id="postnom" placeholder="postnom">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="Prénom">Prénom</label>
                    <input type="text" class="form-control" id="Prénom" placeholder="Prénom">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="nbre_par_pq">Email</label>
                    <input type="text" class="form-control" id="nbre_par_pq" placeholder="Email">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="nbre_par_pq">Tel</label>
                    <input type="text" class="form-control" id="nbre_par_pq" placeholder="Tel">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="categorie_prod">Privilege</label>
                    <select class="form-control" name="categorie_prod" id="categorie_prod">
                      <option value="NULL">Choisir un Privilege</option>
                      <option value="">Partenaire</option>
                      <option value="">Prospect</option>
                      <option value="">Potentiel</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row"></div>
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