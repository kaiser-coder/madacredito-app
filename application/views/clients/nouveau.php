<div class="az-content-left az-content-left-components">
	<div class="component-item">
		<label>Menu</label>
		<nav class="nav flex-column">
			<a href="<?php echo site_url("Clients/list")?>" class="nav-link"><i class="fas fa-list"></i> Liste des clients</a>
			<a href="<?php echo site_url("Clients/add")?>" class="nav-link"><i class="fas fa-plus"></i> Ajouter un nouveau client</a>
		</nav>
	</div><!-- component-item -->
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column">

	<div class="az-content-breadcrumb">
		<?php
			echo str_replace("/", " > ", uri_string());
		?>
	</div>

	<h2 class="az-content-title">Ajouter un nouveau client</h2>
	<div class="row">
		<form action="<?php echo site_url("Clients/store"); ?>" method="post" class="col-12">
			<div class="row form-group">
				<div class="col-6">
					<label for="">Nom</label>
					<input type="text" name="nom" id="" class="form-control form-control-sm" placeholder="Le nom du client" value="<?php echo set_value("nom"); ?>">
					<?php echo form_error('nom', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
				<div class="col-6">
					<label for="">Prénom</label>
					<input type="text" name="prenom" id="" class="form-control form-control-sm" placeholder="Le prénom du client" value="<?php echo set_value("prenom"); ?>">
					<?php echo form_error('prenom', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
			</div>
			<div class="row form-group">	
				<div class="col-6">
					<label>Genre</label>
					<select name="sexe" id="" class="form-control">
						<option value="M">Masculin</option>
						<option value="F">Féminin</option>
					</select>
					<?php echo form_error('sexe', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
			</div>
			<div class="row form-group">	
				<div class="col-6">
					<label for="">Date de naissance</label>
					<input type="date" name="dte_naissance" id="" class="form-control form-control-sm" value="<?php echo set_value("dye_naissance"); ?>">
					<?php echo form_error('dte_naissance', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
			</div>
			<div class="row form-group">	
				<div class="col-6">
					<label for="">Adresse</label>
					<input type="text" name="adresse" id="" class="form-control form-control-sm" placeholder="L'adresse du client" value="<?php echo set_value("adresse"); ?>">
					<?php echo form_error('adresse', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
				<div class="col-6">
					<label for="">Cin</label>
					<input type="text" name="cin" id="" class="form-control form-control-sm" placeholder="Le numéro du CIN du client" value="<?php echo set_value("cin"); ?>">
					<?php echo form_error('cin', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
			</div>
			<div class="row form-group">	
				<div class="col-6">
					<label for="">Profession</label>
					<input type="text" name="profession" id="" class="form-control form-control-sm has-danger" placeholder="La profession du client" value="<?php echo set_value("profession"); ?>">
					<?php echo form_error('profession', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
				<div class="col-6">
					<label for="">Lieu de travail</label>
					<input type="text" name="lieu_travail" id="" class="form-control form-control-sm" placeholder="La lieu de travail du client" value="<?php echo set_value('lieu_travail'); ?>">
					<?php echo form_error('lieu_travail', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
			</div>
			<div class="row form-group">	
				<div class="col-6">
					<label for="">Numéro de téléphone</label>
					<input type="text" name="contact" id="" class="form-control form-control-sm" placeholder="Le numéro du téléphone du client" value="<?php echo set_value("contact"); ?>">
					<?php echo form_error('contact', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
				<div class="col-6">
					<label for="">E-mail</label>
					<input type="text" name="email" id="" class="form-control form-control-sm" placeholder="L'email du client" value="<?php echo set_value('email'); ?>">
					<?php echo form_error('email', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-12">
					<label>Souhaitez-vous Ajouter un mot de passe au compte? (facultatif)</label>
					<input type="text" name="mot_passe" class="form-control form-control-sm" placeholder="Entrer un mot de passe pour le compte">
					<?php echo form_error('mot_passe', '<span class="text-dark" style="font-size: 12px">', '</span>'); ?>
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