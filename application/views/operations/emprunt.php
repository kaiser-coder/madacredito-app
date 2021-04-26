<div class="az-content-left az-content-left-components">
   <div class="component-item">
      <label>Option</label>
      <nav class="nav flex-column">
         <a href="<?php echo site_url("Comptes/list"); ?>" class="nav-link"><i class="fas fa-list"></i> Liste des
            comptes</a>
      </nav>

      <label>Opérations</label>
      <nav class="nav flex-column">
         <a href="<?php echo site_url("Operations/emprunt"); ?>" class="nav-link"><i class="fas fa-tag"></i> Emprunt</a>
         <a href="" class="nav-link"><i class="fas fa-download"></i> Dépôt</a>
         <a href="" class="nav-link"><i class="fas fa-upload"></i> Retrait</a> <br>
      </nav>
   </div><!-- component-item -->
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column">

   <div class="az-content-breadcrumb">
      <?php
			echo str_replace("/", " > ", uri_string());
		?>
   </div>

   <h2 class="az-content-title">Effectuer un emprunt</h2>
   <div class="row mb-4">
      <form action="<?php echo site_url("Emprunts/store")?>" method="post" class="col-12">
         <div class="row form-group">
            <div class="col-6">
               <label>Numéro de compte</label>
               <input type="text" name="numero" placeholder="Le numéro du compte client"
                  class="form-control form-control-sm" value="<?php echo set_value('numero')?>">
               <?php echo form_error('numero','<small class="form-text  text-dark">','</small>')?>
            </div>
            <div class="col-6">
               <label>Mot de passe</label>
               <input type="text" name="mot_passe" placeholder="Le mot de passe du compte client"
                  class="form-control form-control-sm" value="<?php echo set_value('mot_passe')?>">
               <?php echo form_error('mot_passe','<small class="form-text  text-dark">','</small>')?>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-12">
               <label>Objet</label>
               <textarea name="objet" rows="10" placeholder="L'objet de l'emprunt" class="form-control form-control-sm"
                  value="<?php echo set_value('objet')?>"></textarea>
               <?php echo form_error('objet','<small class="form-text  text-dark">','</small>')?>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-12">
               <label for="text-input">Capital (Ariary)</label>
               <input type="text" name="capital" placeholder="Le capital emprunté" class="form-control form-control-sm"
                  value="<?php echo set_value('capital')?>">
               <?php echo form_error('capital','<small class="form-text  text-dark">','</small>')?>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-12">
               <label>Taux (%)</label>
               <input type="text" name="taux" placeholder="Le taux d'emprunt" class="form-control form-control-sm"
                  value="<?php echo set_value('taux')?>">
               <?php echo form_error('taux','<small class="form-text text-dark">','</small>')?>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-12">
               <label>Période</label>
               <div class="row">
                  <div class="col-6">
                     <input type="number" name="periode" placeholder="La période de l'emprunt"class="form-control form-control-sm" value="<?php echo set_value('periode')?>">
                  </div>
                  <div class="col-6">
                     <select name="duree" class="form-control">
                        <option value="mois">Mois</option>
                        <option value="années">Années</option>
                     </select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">  
                     <?php echo form_error('periode','<small class="form-text  text-dark">','</small>')?>
                  </div>
                  <div class="col-6">  
                     <?php echo form_error('duree','<small class="form-text  text-dark">','</small>')?>
                  </div>
               </div>
            </div>
         </div>
         <div class="row form-group">
            <div class="col-12">
               <label>Mode de remboursement</label>
               <select name="mode" id="select" class="form-control">
                  <option value="En plusieurs annuités constantes">En plusieurs
                     mensualités ou annuités constantes</option>
                  <option value="En plusieurs ammortissements constantes">En plusieurs
                     ammortissements constantes
                  </option>
                  <option value="A l'échéance">A l'échéance</option>
               </select>
            </div>
         </div>
         <div>
            <button type="submit" class="btn btn-md btn-info">
               Enregistrer
            </button>
            <button type="reset" class="btn btn-md btn-danger">
               Annuler
            </button>
         </div>
      </form>
   </div>
</div>