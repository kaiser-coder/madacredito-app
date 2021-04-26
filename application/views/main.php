<?php
   if(isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>

   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <title>Madacredito App</title>

   <!-- vendor css -->
   <link href="<?php echo base_url("assets/lib/fontawesome-free/css/all.min.css"); ?>" rel="stylesheet">
   <link href="<?php echo base_url("assets/lib/ionicons/css/ionicons.min.css"); ?>" rel="stylesheet">
   <link href="<?php echo base_url("assets/lib/typicons.font/typicons.css"); ?>" rel="stylesheet">
   <link href="<?php echo base_url("assets/lib/flag-icon-css/css/flag-icon.min.css"); ?>" rel="stylesheet">

   <!-- azia CSS -->
   <link rel="stylesheet" href="<?php echo base_url("assets/css/azia.css"); ?>">

   <!-- DataTable css -->
   <link href="<?php echo base_url("assets/components/css/dataTables.bootstrap4.css"); ?>" rel="stylesheet">
   <link href="<?php echo base_url("assets/components/css/responsive.bootstrap4.min.css"); ?>" rel="stylesheet">


</head>

<body>
   <div class="az-header">
      <div class="container">
         <div class="az-header-left">
            <a href="" class="az-logo"><span></span> Madacredito</a>
            <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
         </div><!-- az-header-left -->
         <div class="az-header-menu">
            <div class="az-header-menu-header">
               <a href="" class="az-logo"><span></span> Madacredito</a>
               <a href="" class="close">&times;</a>
            </div><!-- az-header-menu-header -->
            <ul class="nav">
               <li class="nav-item <?php echo $active = (strpos(uri_string(), "Admins/home") !== false) ? "active" : null ;
						?>">
                  <a href="<?php echo site_url("Admins/home"); ?>" class="nav-link"><i
                        class="typcn typcn-chart-area-outline"></i> Accueil</a>
               </li>
               <li
                  class="nav-item <?php echo $active = (strpos(uri_string(), "Clients") !== false) ? "active" : null ;?>">
                  <a href="<?php echo site_url("Clients/list"); ?>" class="nav-link"><i
                        class="typcn typcn-group-outline"></i> Espace clients</a>
               </li>
               <li
                  class="nav-item <?php echo $active = (strpos(uri_string(), "Comptes") !== false) ? "active" : null ;?>">
                  <a href="<?php echo site_url("Comptes/list"); ?>" class="nav-link"><i
                        class="typcn typcn-chart-bar-outline"></i> Comptes clients</a>
               </li>
               <li
                  class="nav-item <?php echo $active = (strpos(uri_string(), "Operations") !== false) ? "active" : null ;?>">
                  <a href="#" class="nav-link  with-sub"><i class="typcn typcn-book"></i> Opérations</a>
                  <div class="az-menu-sub">
                     <div class="container">
                        <div>
                           <nav class="nav">
                              <a href="<?php echo site_url("Operations/depot"); ?>" class="nav-link">Dépôt</a>
                              <a href="<?php echo site_url("Operations/retrait"); ?>" class="nav-link">Retrait</a>
                              <a href="<?php echo site_url("Operations/emprunt"); ?>" class="nav-link">Prêt</a>
                           </nav>
                        </div>
                     </div><!-- container -->
                  </div>
               </li>
            </ul>
         </div><!-- az-header-menu -->
         <div class="az-header-right">
            <div class="dropdown az-profile-menu">
               <a href="" class="az-img-user"><img src="<?php echo base_url('assets/img/user_50px.png'); ?>" alt=""></a>
               <div class="dropdown-menu">
                  <div class="az-dropdown-header d-sm-none">
                     <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                  </div>
                  <div class="az-header-profile">
                     <div class="az-img-user">
                        <img src="<?php echo base_url('assets/img/user_100px.png'); ?>" alt="Image utilisateur">
                     </div><!-- az-img-user -->
                     <h6><?php echo $_SESSION['admin']['nom'].' '.$_SESSION['admin']['prenom']; ?></h6>
                     <span><?php echo $_SESSION['admin']['pseudo']; ?></span>
                  </div><!-- az-header-profile -->

                  <a href="<?php echo site_url("Admins/add"); ?>" class="dropdown-item"><i class="fas fa-plus"
                        style="font-size: 15px"></i> Ajouter un nouveau profil</a>
                  <a href="<?php echo site_url("Admins/edit"); ?>" class="dropdown-item"><i class="fas fa-edit"
                        style="font-size: 15px"></i> Modifier le profil</a>
                  <a href="<?php echo site_url("Admins/list"); ?>" class="dropdown-item"><i class="fas fa-clock"
                        style="font-size: 15px"></i> Historique des activités</a>
                  <a href="<?php echo site_url("Admins/logout"); ?>" class="dropdown-item"><i class="fas fa-times"
                        style="font-size: 15px"></i> Déconnexion</a>
               </div><!-- dropdown-menu -->
            </div>
         </div><!-- az-header-right -->
      </div><!-- container -->
   </div><!-- az-header -->

   <div class="az-content az-content-dashboard">
      <div class="container">
         <div class="az-content-body">
            <div class="az-dashboard-one-title mb-0">
               <div>
                  <h2 class="az-dashboard-title">Bienvenue</h2>
                  <p class="az-dashboard-text">Connecté en tant que: <b><?php echo $_SESSION['admin']['pseudo']; ?></b></p>
               </div>
               <div class="az-content-header-right">
                  <div class="media">
                     <div class="media-body">
                        <label>Aujourd'hui</label>
                        <h6>
                           <?php 
                              $today = new DateTime(); 
                              echo $today->format('M d, Y');
                           ?>
                        </h6>
                     </div><!-- media-body -->
                  </div><!-- media -->
               </div>
            </div><!-- az-dashboard-one-title -->
         </div>
      </div>
   </div>

   <div class="az-content">
      <?php if(isset($_SESSION["alert"])) {; ?>
      <div class="container">
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

      <div class="container">
         <?php echo $content; ?>
      </div><!-- az-content -->
   </div>

   <div class="az-footer ht-40">
      <div class="container ht-100p pd-t-0-f">
         <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © madacredito
            <?php echo $today->format('Y'); ?></span>
         <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Developped by <span
               class="text-info">kaiser-coder</span></span>
      </div><!-- container -->
   </div><!-- az-footer -->


   <script src="<?php echo base_url("assets/components/js/jquery-1.12.4.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/lib/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
   <script src="<?php echo base_url("assets/js/azia.js"); ?>"></script>
   <script src="<?php echo base_url("assets/js/dashboard.sampledata.js"); ?>"></script>
   
   <!-- DataTable script-->
   <script src="<?php echo base_url("assets/components/js/datatables.min.js"); ?>" type="text/javascript"></script>
   <script src="<?php echo base_url("assets/components/js/datatables.bootstrap4.min.js"); ?>" type="text/javascript"></script>
   <script>
      $(document).ready( function () {
         $('#my-datatable').DataTable();
      } );
   </script>
   <script src="<?php echo base_url("assets/js/angular.min.js"); ?>" type="text/javascript"></script>
   
</body>

</html>
<?php
   } else {
      redirect('Admins/login');
   }
?>