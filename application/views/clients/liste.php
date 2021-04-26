<div class="az-content-left az-content-left-components">
   <div class="component-item">
      <label>Menu</label>
      <nav class="nav flex-column">
         <a href="<?php echo site_url("Clients/list")?>" class="nav-link"><i class="fas fa-list"></i> Liste des
            clients</a>
         <a href="<?php echo site_url("Clients/add")?>" class="nav-link"><i class="fas fa-plus"></i> Ajouter un nouveau
            client</a>
      </nav>
   </div><!-- component-item -->
</div>

<div class="az-content-body pd-lg-l-40 d-flex flex-column">

   <div class="az-content-breadcrumb">
      <?php
			echo str_replace("/", " > ", uri_string());
		?>
   </div>

   <h2 class="az-content-title">Liste des clients</h2>
   
   <table id="my-datatable" class="table table-hover">
      <thead>
         <tr>
            <th>ID</th>
            <th>Nom & Prénom</th>
            <th>Genre</th>
            <th>Cin</th>
            <th>Contact</th>
            <th>Adresse</th>
            <th>Autres informations</th>
         </tr>
      </thead>
      <tbody>
         <?php 
            foreach($clients as $c) {
         ?>
         <tr>
            <th scope="row"><?php echo $c["id"]; ?></th>
            <td><?php echo $c["nom"] ." ". $c["prenom"]; ?></td>
            <td><?php echo $c["sexe"]; ?></td>
            <td><?php echo $c["cin"]; ?></td>
            <td><?php echo $c["contact"]; ?></td>
            <td><?php echo $c["adresse"]; ?></td>
            <td>
               <a href="<?php echo site_url("Comptes/view/{$c["id"]}"); ?>"
                  class="text-dark">Consulter</a>
            </td>
         </tr>
         <?php } ?>
      </tbody>
      <tfoot>
         <tr>
            <th>ID</th>
            <th>Nom & Prénom</th>
            <th>Genre</th>
            <th>Cin</th>
            <th>Contact</th>
            <th>Adresse</th>
            <th>Autres informations</th>
         </tr>
		</tfoot>
   </table>
</div>