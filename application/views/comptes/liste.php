<div class="az-content-left az-content-left-components">
	<div class="component-item">
		<label>Menu</label>
		<nav class="nav flex-column">
			<a href="<?php echo site_url("Comptes/list")?>" class="nav-link"><i class="fas fa-list"></i> Liste des comptes</a>
		</nav>
	</div><!-- component-item -->
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column">

	<div class="az-content-breadcrumb">
		<?php
			echo str_replace("/", " > ", uri_string());
		?>
	</div>
	
	<h2 class="az-content-title">Liste des comptes</h2>

	<table id="my-datatable" class="table table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>N° compte</th>
				<th>Nom & Prénom du titulaire</th>
				<th>Date d'ouverture</th>
				<th>Solde</th>
				<th>Etat du compte</th>
				<th>Autres informations</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				foreach($comptes as $c) {
			?>
			<tr>
				<th scope="row"><?php echo $c["id"]; ?></th>
				<td><?php echo $c["numero"]; ?></td>
				<td><?php echo $c["nom"] ." ". $c["prenom"]; ?></td>
				<td><?php echo $c["dte_creation"]; ?></td>
				<td><?php echo $c["solde"]; ?></td>
				<td><?php echo $c["etat"]; ?></td>
				<td>
					<a href="<?php echo site_url("Comptes/view/") . $c["id"]; ?>" class="text-dark">Consulter</a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
		<tfoot>
			<tr>
				<th>ID</th>
				<th>N° compte</th>
				<th>Nom & Prénom du titulaire</th>
				<th>Date d'ouverture</th>
				<th>Solde</th>
				<th>Etat du compte</th>
				<th>Autres informations</th>
			</tr>
		</tfoot>
	</table>
</div>