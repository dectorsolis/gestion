	
		<div class="container">
		

			  	<div class="row">
			  		<div class="col-md-12">
			  			<p>
			  				<?php require_once INCLUDES . "alerts.php"; ?>
			  			</p>
			  		</div>
			 	</div>

			 	<div>
			 		<form method="POST" action="<?= $data['action_form']; ?>">
			 			<ul class="lista-permisos">
			 			<?= $data['permisos']; ?>
			 			</ul>
			 			<p><button type="submit">Aplicar</button></p>
			 		</form>
			 	</div>

		</div>

