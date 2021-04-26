<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- Meta -->
   <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
   <meta name="author" content="BootstrapDash">

   <title>Madacredito App</title>

   <!-- vendor css -->
   <link href="<?php echo base_url("assets/lib/fontawesome-free/css/all.min.css"); ?>" rel="stylesheet">
   <link href="<?php echo base_url("assets/lib/ionicons/css/ionicons.min.css"); ?>" rel="stylesheet">
   <link href="<?php echo base_url("assets/lib/typicons.font/typicons.css"); ?>" rel="stylesheet">

   <!-- azia CSS -->
   <link rel="stylesheet" href="<?php echo base_url("assets/css/azia.css"); ?>">

</head>

<body class="az-body">
   <?php if(isset($_SESSION["alert"])) {; ?>
      <div class="container mt-2">
         <div class="offset-2 col-8 alert alert-<?php echo $_SESSION["alert"]["badge"] ?> align-self-end" role="alert">
            <h4 class="alert-heading"> <?php echo $_SESSION["alert"]["title"] ?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </h4>

            <p>
               <?php echo $_SESSION["alert"]["message"] ?>
            <p>
         </div>
      </div>
   <?php }?>

   <div class="az-signin-wrapper">
      <div class="az-card-signin">
         <h1 class="az-logo">madacredito</h1>
         <div class="az-signin-header">
            <h2>Bienvenue!</h2>
            <h5>Connectez vous pour continuer</h5>

            <form action="<?php echo site_url("Admins/auth"); ?>" method="post" ng-app>
               <div class="form-group">
                  <label>Identifiant</label>
                  <input type="text" name="pseudo" class="form-control" placeholder="Entrer votre identifiant"
                     value="<?php echo set_value("pseudo"); ?>">
                  <?php echo form_error('pseudo', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
               </div><!-- form-group -->
               <div class="form-group" ng-init="active = false">
                  <label>Mot de passe</label>
                  <input type="{{active == true ? 'text' : 'password'}}" name="mot_passe" class="form-control" placeholder="Entrer votre mot de passe"
                     value="<?php echo set_value("mot_passe"); ?>">
                  <?php echo form_error('mot_passe', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
                  <label class="ckbox mt-1" style="font-size: 12px">
                     <input type="checkbox" ng-model="active"><span>Voir la confirmation du mot de passe</span>
                  </label>
               </div><!-- form-group -->
               <button class="btn btn-info btn-block" type="submit">Se connecter</button>
            </form>
         </div><!-- az-signin-header -->
      </div><!-- az-card-signin -->
   </div><!-- az-signin-wrapper -->

   <script src="<?php echo base_url("assets/lib/jquery/jquery.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/lib/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/lib/ionicons/ionicons.js"); ?>"></script>
   <script src="<?php echo base_url("assets/js/jquery.cookie.js"); ?>" type="text/javascript"></script>
   <script src="<?php echo base_url("assets/js/jquery.cookie.js"); ?>" type="text/javascript"></script>

   <script src="<?php echo base_url("assets/js/azia.js"); ?>"></script>
   <script>
   $(function() {
      'use strict'

   });
	</script>
	<script src="<?php echo base_url("assets/js/angular.min.js"); ?>"></script>
</body>

</html>