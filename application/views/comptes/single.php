<div class="az-content-left az-content-left-components">
   <div class="component-item">
      <label>Menu</label>
      <nav class="nav flex-column">
         <a href="<?php echo site_url("Comptes/list"); ?>" class="nav-link"><i class="fas fa-list"></i> Liste des
            comptes</a>
      </nav>

      <label>Opérations</label>
      <nav class="nav flex-column">
         <a href="<?php echo site_url("Operations/depot/{$client['id']}"); ?>" class="nav-link"><i class="fas fa-download"></i>
            Dépôt</a>
         <a href="<?php echo site_url("Operations/retrait/{$client['id']}"); ?>" class="nav-link"><i class="fas fa-upload"></i>
            Retrait</a> <br>
      </nav>

      <label>Autres</label>
      <nav class="nav flex-column">
         <a href="<?php echo site_url("Clients/edit/{$client["id"]}"); ?>" class="nav-link"><i class="fas fa-pen"></i>
            Mettre à jour les informations de
            <?php echo $client["nom"]; ?>
         </a>
         <a href="" class="nav-link"><i class="fas fa-ban"></i> Suspendre ce compte?</a> <br>
      </nav>
   </div><!-- component-item -->
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column" ng-app="myApp">

   <div class="az-content-breadcrumb">
      <?php
			echo str_replace("/", " > ", uri_string());
		?>
   </div>

   <h2 class="az-content-title">Informations sur le compte</h2>
   <div class="row">
      <div class="col-12">
         <b>Solde du compte</b>
         <div class="table-responsive mt-3">
            <table class="table">
               <thead>
                  <tr>
                     <th>Ariary</th>
                     <th>Fmg</th>
                  </tr>
               </thead>
               <tbody>
                  <tr style="font-size: 25px">
                     <td>
                        <?php echo number_format ( $compte["solde"], 0, ".", "," ); ?>
                     </td>
                     <td>
                        <?php echo number_format ( $compte["solde"] * 5, 0, ".", "," ); ?>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>

   <div class="row mb-4">
      <div class="col-4">
         <div class="row mb-4">
            <div class="col-6">
               <b>N° du compte </b><br>
               <?php echo $compte["numero"]; ?>
            </div>
            <div class="col-6" ng-init="clicked = false; errors = '<?php echo form_error('mot_passe')?>'">
               <b>Mot de passe </b> <br>

               <?php echo $compte["mot_passe"]; ?>
               <button type="button" data-toggle="modal" data-target="#edit-modal" ng-click="clicked = true"
                  style="background: none; border: none;">
                  <i class="fas fa-pen"></i>
               </button>

               <div class="modal fade" ng-class="clicked == true || errors !== '' ? 'show' : null" id="edit-modal"
                  tabindex="-1" aria-labelledby="edit-modal" aria-hidden="true">
                  <div class="modal-dialog">
                     <form action="<?php echo site_url("Comptes/update/{$client["id"]}"); ?>" method="post">
                        <div class="modal-content p-4">
                           <div class="modal-body">
                              <div class="row">
                                 <div class="col-12 ">
                                    <label>Le nouveau mot de passe du compte</label>
                                    <input type="text" name="mot_passe" class="mt-1 form-control form-control-sm"
                                       placeholder="Entrer un nouveau mot de passe">
                                    <?php echo form_error('mot_passe', '<span class="text-dark" style="font-size: 12px">', '</span>')?>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-12 mt-4">
                                    <button type="submit"
                                       class="btn btn-info btn-rounded btn-block">Sauvegarder</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <div class="row mb-4">
            <div class="col-6">
               <b>Ouvert le </b><br>
               <?php echo $compte["dte_creation"]; ?>
            </div>
            <div class="col-6">
               <b>Confirmé par </b><br>
               <?php echo $compte["pseudo"]; ?>
            </div>
         </div>
         <div class="row">
            <div class="col-12 text-center">
               <b>Etat actuel </b><br>
               <?php echo $compte["etat"]; ?>
            </div>
         </div>
      </div>

      <div class="col-8">
         <div class="row">
            <div class="col-12">
               <div class="row mb-4">
                  <div class="col-6">
                     <b>Nom</b> <br>
                     <?php echo $client["nom"]; ?>
                  </div>
                  <div class="col-6">
                     <b>Prénom</b> <br>
                     <?php echo $client["prenom"]; ?>
                  </div>
               </div>

               <div class="row mb-4">
                  <div class="col-12">
                     <b>Genre</b> <br>
                     <?php echo $client["sexe"]; ?>
                  </div>
               </div>

               <div class="row mb-4">
                  <div class="col-12">
                     <b>Date de naissance</b> <br>
                     <?php echo $client["dte_naissance"]; ?>
                  </div>
               </div>

               <div class="row mb-4">
                  <div class="col-6">
                     <b>Adresse</b> <br>
                     <?php echo $client["adresse"]; ?>
                  </div>
                  <div class="col-6">
                     <b>CIN</b> <br>
                     <?php echo $client["cin"]; ?>
                  </div>
               </div>

               <div class="row mb-4">
                  <div class="col-6">
                     <b>Profession</b> <br>
                     <?php echo $client["profession"]; ?>
                  </div>
                  <div class="col-6">
                     <b>Lieu de travail</b> <br>
                     <?php echo $client["lieu_travail"]; ?>
                  </div>
               </div>

               <div class="row mb-4">
                  <div class="col-6">
                     <b>E-mail</b> <br>
                     <?php echo $client["email"]; ?>
                  </div>
                  <div class="col-6">
                     <b>Téléphone</b> <br>
                     <?php echo $client["contact"]; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="col-12">
         <h5 class="pb-4">Opérations effectuées</h5>

         <table id="my-datatable" class="table table-hover">
            <thead>
               <tr>
                  <th>N°</th>
                  <th>Ref</th>
                  <th>Libelle</th>
                  <th>Date Opération</th>
                  <th>Utilisateur</th>
                  <th>Autres informations</th>
               </tr>
            </thead>
            <tbody>
               <?php
               if(!is_null($operations)) {
                  $i = 1;
                  foreach($operations as $o) {
               ;?>
               <tr data-toggle="modal" data-target="#view-modal<?php echo $o["id"] ;?>">
                  <td><?php echo $i++ ;?></td>
                  <td><?php echo $o['ref'] ;?></td>
                  <td><?php echo $o['libelle'] ;?></td>
                  <td><?php echo $o['dte_operation'] ;?></td>
                  <td><?php echo $o['pseudo'] ;?></td>
                  <td>
                     <a data-toggle="modal" data-target="#view-modal<?php echo $o["id"] ;?>" style="cursor: pointer;">
                        Consulter
                     </a>
                  </td>

                  <div class="modal fade" id="view-modal<?php echo $o["id"] ;?>" tabindex="-1"
                     aria-labelledby="edit-modal" aria-hidden="true">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content p-4">
                           <div class="modal-body">
                              <div class="row">
                                 <div class="col-12 ">
                                    <?php 
                                       if(isset($paiements)) {
                                          var_dump($paiements);
                                       }
                                    ?>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </tr>
               <?php
                     }
                  } else {
               ?>
                  <tr>
                     <td colspan="6" class="text-muted">Aucune opérations</td>
                  </tr>
               <?php
                  }
               ?>
            </tbody>
            <tfoot>
               <tr>
                  <th>N°</th>
                  <th>Ref</th>
                  <th>Libelle</th>
                  <th>Date Opération</th>
                  <th>Utilisateur</th>
                  <th>Autres informations</th>
               </tr>
            </tfoot>
         </table>

      </div>
   </div>
</div>