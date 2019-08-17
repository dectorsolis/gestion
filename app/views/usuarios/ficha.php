
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">
			   	<h3 class="panel-title">Ficha usuario</h3>
			</div>	

			<!-- INFO USUARIO -->
			<div class="row">
			    <div class="col-md-12">
			    	<?php $usuario = $data['usuario']; ?>
			        <h3><?= $usuario[0]['username']; ?></h3>
			        <p><strong>Nombre:</strong> <?= $usuario[0]['nombre']; ?></p>
				    <p><strong>Fecha de registro:</strong> <?= $usuario[0]['register_at']; ?></p>
				    <p><strong>Última actualización :</strong> <?= $usuario[0]['updated_at']; ?></p>
				    <p><strong>Última sesión:</strong> <?= $usuario[0]['last_login']; ?></p>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4">
					<?php require_once INCLUDES . "alerts.php"; ?>
				  	<form method="POST" action="">
				   		<p>
				   			
				   			<label for="rol" >Modificar rol</label>

				   		<?php if( $data['roles'] ): ?>
				   			<?php $roles = $data['roles']; ?>

				   			<select name="rol" class="form-control">
				   			<?php for( $i = 0; $i < count($roles); $i++ ): ?>
				   				
				   				<?php 

				   					$selected = ""; 
				   					if( $roles[$i]['id_rol'] == $usuario[0]['id_rol'])
				   						$selected = 'selected';
				   				?>

					   			<option value="<?= $roles[$i]['id_rol'] ?>" <?= $selected; ?> >
					   				<?= $roles[$i]['descripcion']; ?>
					   			</option>
					   		<?php endfor; ?>
					   		</select>
					   		<input 
					   			type="hidden" 
					   			name="id_usuario" 
					   			value="<?= $usuario[0]['id_user']; ?>">
				   		<?php endif; ?>

				   		</p>
				   		<p>
				   			<button type="submit" class="btn btn-primary">Actualizar</button>
				   		</p>
				   	</form>
			  	</div>	    
			</div>
		</div>
			<!-- END INFO USUARIO -->
	</div>
