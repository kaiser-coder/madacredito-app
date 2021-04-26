<div class="az-content-left az-content-left-components">
	<div class="component-item">
		<label>Menu</label>
		<nav class="nav flex-column">
			<a href="<?php echo site_url("Admins/list")?>" class="nav-link"><i class="fas fa-list"></i> Liste des administrateurs</a>
			<a href="<?php echo site_url("Admins/add")?>" class="nav-link"><i class="fas fa-plus"></i> Ajouter un nouvel administrateur</a>
			<a href="<?php echo site_url("Admins/list")?>" class="nav-link"><i class="fas fa-clock"></i> Historique des activités</a>
		</nav>
	</div><!-- component-item -->
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column">

	<div class="az-content-breadcrumb">
		<?php
			echo str_replace("/", " > ", uri_string());
		?>
	</div>

	<h2 class="az-content-title">Editer le compte utilisateur</h2>
	<div class="row">
		<form action="<?php echo site_url("Comptes/update"); ?>" method="post" class="col-12" ng-app>
			<div class="row form-group">
				<div class="col-6">
					<label for="">Nom</label>
					<input type="text" name="nom" id="" class="form-control form-control-sm"
						placeholder="Le nom de l'administrateur" value="<?php echo $admin["nom"]; ?>">
				</div>
				<div class="col-6">
					<label for="">Prénom</label>
					<input type="text" name="prenom" id="" class="form-control form-control-sm"
						placeholder="Le prénom de l'administrateur" value="<?php echo $admin["prenom"]; ?>">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-6">
					<label for="">Identifiant</label>
					<input type="text" name="pseudo" id="" class="form-control form-control-sm"
						placeholder="L'identifiant de l'administrateur" value="<?php echo $admin["pseudo"]; ?>">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-6" ng-init="active1">
					<label>Mot de passe</label>
					<input type="{{active1 == true ? 'text' : 'password'}}" name="" id="" class="form-control form-control-sm" placeholder="Nouveau mot de passe">
					<label class="ckbox mt-1" style="font-size: 12px">
                  <input type="checkbox" ng-model="active1"><span>Voir le mot de passe</span>
               </label>
				</div>
				<div class="col-6" ng-init="active2">
					<label>Confirmation du nouveau mot de passe</label>
					<input type="{{active2 == true ? 'text' : 'password'}}" name="" id="" class="form-control form-control-sm"
						placeholder="Confirmation du mot de passe">
					<label class="ckbox mt-1" style="font-size: 12px">
                  <input type="checkbox" ng-model="active2"><span>Voir le mot de passe</span>
               </label>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-6">
					<input type="submit" value="Enregistrer" class="btn btn-info">
					<input type="reset" value="Annuler" class="btn btn-danger">
				</div>
			</div>
		</form>
	</div>
</div>