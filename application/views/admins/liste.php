<div class="az-content-left az-content-left-components">
   <div class="component-item">
      <label>Menu</label>
      <nav class="nav flex-column">
         <a href="<?php echo site_url("Admins/add")?>" class="nav-link"><i class="fas fa-plus"></i> Ajouter un nouvel administrateur</a>
         <a href="<?php echo site_url("Admins/edit")?>" class="nav-link"><i class="fas fa-pen"></i> Modifier vos informations</a>
      </nav>
   </div><!-- component-item -->
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column">

   <div class="az-content-breadcrumb">
      <?php
			echo str_replace("/", " > ", uri_string());
		?>
   </div>

   <h2 class="az-content-title">Liste des utilisateurs</h2>
   <div class="row">
      <div class="col-12 table-responsive">
			<table class="table table-hover mg-b-0">
				<thead>
					<tr>
						<th>Nom & Prénom</th>
						<th>Identifiant</th>
                  <th>Date ajout</th>
                  <th>Contact</th>
                  <th>Connecté le</th>
                  <th>Déconnecté le</th>
						<th>Etat</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach($admins as $a) {
					?>
					<tr>
                  <th><?php echo $a["nom"] ." ". $a["prenom"]; ?></th>
                  <th><?php echo $a["pseudo"]; ?></th>
                  <th><?php echo $a["dte_ajout"]; ?></th>
                  <th><?php echo $a["contact"]; ?></th>
                  <th><?php echo $a["lst_connexion"]; ?></th>
                  <th><?php echo $a["lst_deconnexion"]; ?></th>
                  <th><?php echo $a["etat"]; ?></th>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
   </div>
</div>