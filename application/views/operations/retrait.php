<div class="az-content-left az-content-left-components">
   <div class="component-item">
      <label>Menu</label>
      <nav class="nav flex-column">
         <a href="<?php echo site_url("Operations/list")?>" class="nav-link"><i class="fas fa-clock"></i> Historique des
            diverses opérations</a>
      </nav>
   </div><!-- component-item -->
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column">

   <div class="az-content-breadcrumb">
      <?php
			echo str_replace("/", " > ", uri_string());
		?>
   </div>

   <h2 class="az-content-title">Effectuer un retrait</h2>
   <div class="row">
      <form action="<?php echo site_url("Retraits/register"); ?>" method="post" class="col-12" ng-app>
         <div class="row form-group">
            <div class="col-12">
               <label>Mode de retrait</label>
               <select name="mode" id="" class="form-control">
                  <option value="comptant">Au comptant</option>
                  <option value="cheque">Par chèque</option>
               </select>
               <?php echo form_error('mode', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-12">
               <label>Numéro de compte du client</label>
               <input type="text" name="numero" class="form-control form-control-sm"
                  placeholder="Entrer le numéro du compte client" value="<?php echo $value = isset($compte) ? $compte['numero'] : set_value('numero'); ?>">
               <?php echo form_error('numero', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-12">
               <label>Mot de passe du compte client</label>
               <input type="text" name="mot_passe" class="form-control form-control-sm"
                  placeholder="Entrer le mot de passe du compte client" value="<?php echo set_value('mot_passe'); ?>">
               <?php echo form_error('mot_passe', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-6">
               <label>Nom du titulaire</label>
               <input type="text" name="nom" class="form-control form-control-sm"
                  placeholder="Entrer le nom du titulaire du compte" value="<?php echo $value = isset($compte) ? $compte['nom'] : set_value('nom') ; ?>">
               <?php echo form_error('nom', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
            </div>
            <div class="col-6">
               <label>Prénom du titulaire</label>
               <input type="text" name="prenom" class="form-control form-control-sm"
                  placeholder="Entrer le prénom du titulaire du compte" value="<?php echo $value = isset($compte) ? $compte['prenom'] : set_value('prenom'); ?>">
               <?php echo form_error('prenom', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-12">
               <label class="ckbox mt-1" style="font-size: 12px">
                  <input type="checkbox" ng-model="active"><span>Le porteur et le titulaire sont des personnes
                     différentes</span>
               </label>
            </div>
         </div>
         <div ng-if="active == true">
            <div class="row form-group">
               <div class="col-12">
                  <hr>
               </div>
               <div class="col-6">
                  <label>Nom du porteur</label>
                  <input type="text" name="" class="form-control form-control-sm" placeholder="Entrer le nom du porteur" value="<?php echo set_value('nom_porteur'); ?>">
                  <?php echo form_error('nom_porteur', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
               </div>
               <div class="col-6">
                  <label>Prénom du porteur</label>
                  <input type="text" name="" class="form-control form-control-sm"
                     placeholder="Entrer le prénom du porteur" value="<?php echo set_value('prenom_porteur'); ?>">
                  <?php echo form_error('prenom_porteur', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
               </div>
            </div>
            <div class="row form-group">
               <div class="col-12">
                  <label>Adresse du porteur</label>
                  <input type="text" name="adresse_porteur" id="" class="form-control form-control-sm" placeholder="Entrer l'adresse du porteur" value="<?php echo set_value('adresse_porteur'); ?>">
                  <?php echo form_error('adresse_porteur', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
               </div>
            </div>
            <div class="row form-group">
               <div class="col-12">
                  <label>Cin du porteur</label>
                  <input type="text" name="cin_porteur" id="" class="form-control form-control-sm" placeholder="Entrer le cin du porteur" value="<?php echo set_value('cin_porteur'); ?>">
                  <?php echo form_error('cin_porteur', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
               </div>
            </div>
            <div class="row form-group">
               <div class="col-12">
                  <label>Numéro de téléphone du porteur</label>
                  <input type="text" name="contact_porteur" id="" class="form-control form-control-sm"  placeholder="Entrer le numero du porteur" value="<?php echo set_value('contact_porteur'); ?>">
                  <?php echo form_error('contact_porteur', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
               </div>
            </div>
         </div>

         <div class="row form-group">
            <div class="col-12">
               <label>Montant du retrait (en Ariary)</label>
               <input type="text" name="montant" id="" class="form-control form-control-sm" placeholder="Entrez le montant du retrait" value="<?php echo set_value('montant'); ?>">
               <?php echo form_error('montant', '<span class="text-dark" style="font-size: 12px;">', '</span>'); ?>
            </div>
         </div>

         <input type="submit" value="Retirer" class="btn btn-sm btn-info">
         <input type="reset" value="Annuler" class="btn btn-sm btn-danger">
      </form>
   </div>
</div>