<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Logistique | Connexion</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/frameworks/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/frameworks/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo URL; ?>public/frameworks/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box" style="width: 500px;">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>- Rstock pro -</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Connectez-vous pour commencer</p>

      <form action="<?php echo URL; ?>login/connect" method="POST">

      <?php
              if (isset($this->notification)) {
                  if ($this->notification == 'not_active') {
                      $message = '
                                <div role="alert" class="alert alert-danger alert-dismissible">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    Vous ne pouvez pas vous connecter au système. Veuillez contacter l\'administrateur
                                </div>
                                    ';
                      echo $message;
                  }
                  if ($this->notification == 'c_pas_ton_compte') {
                      $message = '
                                <div role="alert" class="alert alert-danger alert-dismissible">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    Le login et le mot de passe saisis ne correspondent à aucun compte.
                                </div>
                                    ';
                      echo $message;
                  }
                  if ($this->notification == 'champs_vide') {
                      $message = '
                                <div role="alert" class="alert alert-danger alert-dismissible">
                                    <button type="button" data-dismiss="alert" class="close"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                    Veillez remplir tout les champs.
                                </div>
                                    ';
                      echo $message;
                  }
              }
        ?>

        <div class="input-group mb-3">
          <input style="height: 50px;" type="email" name="login" class="form-control" placeholder="Votre email" value="<?php if(isset($this->login)) echo $this->login; ?>" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input style="height: 50px;" type="password" name="password" class="form-control" placeholder="Votre mot de passe">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mt-3">
            <button style="height: 50px;"  type="submit" class="btn btn-primary btn-block"> <i class="fa fa-link mr-2"></i> Connexion</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo URL; ?>public/frameworks/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo URL; ?>public/frameworks/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo URL; ?>public/frameworks/dist/js/adminlte.min.js"></script>
</body>
</html>
