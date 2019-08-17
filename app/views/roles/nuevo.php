<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
		   	<h3 class="panel-title"><?= $data['titulo']; ?></h3>
		</div>	
		<br>
		<div class="row">
		    <div class="col-md-6">
				<?php require_once INCLUDES . "alerts.php"; ?>
				<form method="POST" action="">
					<p>
						<label for="nombre-rol">Nombre del rol</label>
						<input name="nombre-rol" class="form-control"/>
					</p>
					<p>
						<button type="submit" class="btn btn-primary">Crear</button>
					</p>
				</form>
			</div>
		</div>	
	</div>
      
</div>
