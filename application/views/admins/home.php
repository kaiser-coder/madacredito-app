<div class="az-content-left az-content-left-components">
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column">

	<div class="az-content-breadcrumb">
		<?php
			echo str_replace("/", " > ", uri_string());
		?>
	</div>

	<div class="jumbotron p-4">
		<p>
			<h2>Bienvenue</h2>
		</p>
	</div>

	<div class="row">
      <div class="col-12 table-responsive">
			<table id="my-datatable" class="table table-hover mg-b-0">
				<thead>
					<tr>
						<th>ID</th>
                  <th>Réf</th>
                  <th>Numéro de compte</th>
						<th>Date opération</th>
                  <th>Utilisateur</th>
                  <th>Autres informations</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach($operations as $o) {
					?>
					<tr>
                  <th><?php echo $o['id']; ?></th>
                  <th><?php echo $o['ref']; ?></th>
                  <th><?php echo $o['numero']; ?></th>
                  <th><?php echo $o['dte_operation']; ?></th>
                  <th><?php echo $o['pseudo']; ?></th>
                  <th>
							<a href="<?php echo site_url('Comptes/view/'. $o['id_client']); ?>" class="text-dark">Consulter</a>
						</th>
					</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th>ID</th>
                  <th>Réf</th>
                  <th>Numéro de compte</th>
						<th>Date opération</th>
                  <th>Utilisateur</th>
                  <th>Autres informations</th>
					</tr>
				</tfoot>
			</table>
		</div>
   </div>
</div>