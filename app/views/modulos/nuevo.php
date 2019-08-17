
<div class = "container">
		<div class="row">
			<div class="col-md-6">
				<?php require_once INCLUDES . "alerts.php"; ?>
		    	<form method="POST" action="<?= $data['action']; ?>">
		    		<p>
		    			<label for="modulo">Ingresa el nombre del nuevo módulo</label>
		    			<input type="text" id="modulo" name="modulo" class="form-control"/>
		    		</p>

		    		<p>
			    		<label for="seccion">Elige la sección</label>
			    		<select id="seccion" name="seccion" class="form-control">
			    			<option></option>
			    			<?php if( isset( $data['secciones'] ) ): ?>
			    				<?php $secciones = $data['secciones']; ?>
			    				<?php for( $i = 0; $i < count($secciones); $i++): ?>
			    					<option value="<?= $secciones[$i]['id_seccion']; ?>">
			    						<?= $secciones[$i]['descripcion']; ?>
			    					</option>
			    				<?php endfor; ?>
			    			<?php endif; ?>
			    		</select>
		    		</p>

		    		
		    		<p>
		    			<button type="submit" class="btn btn-primary">Crear</button>
		    		</p>
		    	</form>
			</div>
		</div>

</div>
