				<?php $update = []; ?>
				<?php if( isset( $data['update_data'] ) ): ?>
					<?php $update = $data['update_data'][0]; ?>
				<?php endif; ?>
			  	<div class="row">
				    <div class="col-md-12 col-xs-12">
						<form method="POST" action="<?= $data['action']; ?>" class="form-ajax" data-id-response="response-accesos" data-response-method="text" data-id-loader="#response-accesos">
						  	<div class="form-group">
						    	<label for="url">URL: </label>
						    	<input 
						    			type="text" 
						    			class="form-control" 
						    			name="url_acceso" 
						    			id="url_acceso" 
						    			value="<?= $update ? $update['url_acceso'] : '' ; ?>" 
						    			placeholder="Ingresar URL de acceso.">
						    </div>		
						    <div class="form-group">
								<label for="usuario">Usuario: </label>
						    	<input 
						    			type="text" 
						    			class="form-control" 
						    			name="usuario" 
						    			id="usuario"  
						    			value="<?= $update ? $update['usuario'] : '' ; ?>" 
						    			placeholder="Ingresar Usuario de acceso.">
						  	</div>
						 	<div class="form-group">
						    	<label for="pass">Contraseña: </label>
						    	<input 
						    			type="text" 
						    			class="form-control" 
						    			name="pass" 
						    			id="pass" 
						    			value="<?= $update ? base64_decode($update['pass']) : '' ; ?>" 
						    			placeholder="Ingresa la contraseña de acceso.">
						  	</div>	
						  	<div class="form-group">
						    	<label for="tipo-acceso">Tipo de acceso: </label>

						    	<select name="id_tipo" class="form-control" id="id_tipo">
						    		
						    		<?php foreach( $data['tipo_acceso'] as $item ): ?>

						    			<?php 
						    				$selected = "";

						    				if( $update ){
												$selected = $item['id_tipo'] == $update['id_tipo'] ? 'selected' : '';
						    				}
						    			?>

						    			<option value="<?= $item['id_tipo'] ?>" <?= $selected ?> > 
						    				<?= $item['nombre'] ?>
						    			</option>
						    		<?php endforeach; ?>
								</select>

						  	</div>

						  	<?php if( $update ): ?>
						  		<input type="hidden" name="id_acceso" value="<?= $update['id_acceso']; ?>"/>
						  	<?php else: ?>
						  		<input type="hidden" name="id_cliente" value="<?= $data['id_cliente']; ?>"/>
						  	<?php endif; ?>

							
						  	<button type="submit" class="btn btn-primary"><?= $data['texto_submit'] ?></button>
						</form>
				    </div>
				</div>			
