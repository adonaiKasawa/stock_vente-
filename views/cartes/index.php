  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Impression des cartes</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Impression des cartes</li>
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
                <h3 class="card-title">Impression cartes </h3>
                <div class="card-tools ">
                  <button type="button" class="btn btn-primary btn-sm float-right" id="btn_modal_ajout_rapport_journalier">
                    <i class="fas fa-print"></i> Ajouter un rapport journalier sur l'impression des cartes
                  </button>
                </div>
              </div>

              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">
                          <!-- <i class="fas fa-edit"></i> -->
                          Registre
                        </h3>

                        <div class="card-tools">
                          <div class="input-group input-group-sm">
                            <select name="triType" id="triType" class="form-control mr-2 float-right">
                              <option value="1">Date précise</option>
                              <option value="2">Période</option>
                            </select>
                            <input type="date" id="get_rapport_onedate" name="table_search" class="form-control mr-2 float-right">
                            <input type="date" id="get_rapport_debutdate" name="table_search" class="form-control mr-2 float-right">
                            <input type="date" id="get_rapport_findate" name="table_search" class="form-control mr-2 float-right">
                            <select name="get_rapport_agent" id="get_rapport_agent" class="form-control mr-2 float-right">
                              <option value="0">Choisir un agent</option>
                              <?php
                              foreach ($this->agents as $agent) {
                              ?>
                                <option value="<?php echo $agent['agent_id']; ?>"><?php echo $agent['nom_agent'].' '.$agent['postnom_agent'].' '.$agent['prenom_agent']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <select name="get_rapport_site" id="get_rapport_site" class="form-control mr-2 float-right">
                              <option value="0">Choisir un site</option>
                              <?php
                              foreach ($this->sites as $site) {
                              ?>
                                <option value="<?php echo $site['site_id']; ?>"><?php echo $site['libelle_site']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <select name="get_rapport_projet" id="get_rapport_projet" class="form-control mr-2 float-right">
                              <option value="0">Choisir un projet</option>
                              <?php
                              foreach ($this->projets as $projet) {
                              ?>
                                <option value="<?php echo $projet['projet_id']; ?>"><?php echo $projet['libelle_projet']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                            <button type="button" name="table_search" id="btn_afficher_rapport_impression_filtre" class="form-control mr-2 float-right btn-primary"> <i class="fa fa-search"></i> Afficher</button>

                          </div>
                        </div>

                      </div>
                      <div class="card-body">
                        <table class="table table-bordered" id="table_impression_cartes">
                          <thead>
                            <tr>
                              <th>Date</th>
                              <th>Agent</th>
                              <th>Site</th>
                              <th>Projet</th>
                              <th>Cartes imprimées</th>
                              <th>Cartes ratées</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                          <tfoot>
                            <tr>
                              <th colspan="4">Total</th>
                              <th id="table_impression_cartes_total_imprimees"></th>
                              <th id="table_impression_cartes_total_ratees"></th>
                            </tr>
                          </tfoot>
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
  <div class="modal fade" id="modal_ajout_rapport_journalier_impression_carte">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Impression cartes</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-12">
            <form id="form_ajout_rapport_journalier_impression_carte">
              <div class="row">
                <div class="col-4">
                  <div class="form-group">
                    <label for="ajout_rapport_journalier_date">Date Rapport</label>
                    <input type="date" class="form-control" id="ajout_rapport_journalier_date" name="ajout_rapport_journalier_date">
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="ajout_rapport_journalier_agent">Agent</label>
                    <select class="form-control" id="ajout_rapport_journalier_agent" name="ajout_rapport_journalier_agent">
                      <option value="NULL">Choisir un agent</option>
                      <?php
                      foreach ($this->agents as $agent) {
                      ?>
                        <option value="<?php echo $agent['agent_id']; ?>"><?php echo $agent['nom_agent'] . ' ' . $agent['postnom_agent'] . ' ' . $agent['prenom_agent']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-4">
                  <div class="form-group">
                    <label for="ajout_rapport_journalier_site">Site</label>
                    <select class="form-control" id="ajout_rapport_journalier_site" name="ajout_rapport_journalier_site">
                      <option value="NULL">Choisir un site</option>
                      <?php
                      foreach ($this->sites as $site) {
                      ?>
                        <option value="<?php echo $site['site_id']; ?>"><?php echo $site['libelle_site']; ?></option>
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
                    <label for="ajout_rapport_journalier_cartes_imprimees">Cartes imprimées</label>
                    <input type="text" class="form-control" id="ajout_rapport_journalier_cartes_imprimees" placeholder="Cartes imprimées">
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="ajout_rapport_journalier_cartes_ratees">Cartes ratées</label>
                    <input type="text" class="form-control" id="ajout_rapport_journalier_cartes_ratees" placeholder="Cartes imprimées">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
          <button type="button" class="btn btn-primary" id="btn_valider_ajout_rapport_journalier_impression_carte">Valider</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->