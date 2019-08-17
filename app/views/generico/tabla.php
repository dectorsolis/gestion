<div class="container">

    <div class="row">
    	<div class="col-md-6">
	    
		    <div class="panel panel-default">
				<div class="panel-heading">
			    	<h3 class="panel-title"><?= $data['titulo_panel']; ?></h3>
			  	</div>	
			  	<br>

			  	<!--ROW -->
			  	<div class="row">
				  	
				  	<div class="col-md-10 col-md-offset-1">
				  		<p>
				  			<a id="agregar-item" href=" <?= $data['nuevo']; ?> " class="btn btn-default">
				  				<span class="glyphicon glyphicon-plus"></span>
				  				<?= $data['texto_boton_agregar']; ?>
				  			</a>
				  			
				  		</p>

				  		<?php require_once INCLUDES . "alerts.php"; ?>

				  		<div class="table-responsive">
					  		<table id="tabla-generica" class="table table-striped">
					  			<thead>
					  				<tr>
					  					<th><?= $data['th']; ?></th>
					  					<th><?= $data['#']; ?></th>
					  					<th></th>
					  					<th></th>
					  				</tr>
					  			</thead>
					  			<tbody id="cuerpo-listado">

						  		<?php if( isset( $data['item'] ) ): ?>
						  		<?php $item = $data['item']; ?>	

						  		<?php for( $i = 0; $i  < count( $item ); $i++ ): ?>
						  			<tr class="table">
						  				<td> 
											<?= $item[$i]['nombre']; ?> 
						  				</td>

						  				<td>
						  					<?= $item[$i]['total']; ?> 
						  				</td>

										<!--EDITAR ITEM -->
						  				<td>
									        <a href="<?= $data['edit_url'] . $item[$i]['id']; ?>" class="btn btn-success btn-sm">
									          <span class="glyphicon glyphicon-edit"></span>
									        </a>				  					
						  				</td>
						  				<!-- FIN EDITAR ITEM -->

						  				<!-- ELIMINAR ITEM -->
						  				<td>
						  					<form 
						  						action=" <?= $data['delete_url']; ?> " 
						  						class="cambiar-status"
						  						method="POST" class="eliminar-registro"
						  						data-submit-msg="<?= $data['delete_message'] ?>">
						  						<input type="hidden" name="token" value="<?= $item[$i]['id']; ?>" />
						  						<button type="submit" class="btn btn-danger btn-sm">
						  							<span class="glyphicon glyphicon-trash"></span>
						  						</button>
						  					</form>
						  				</td>
						  				<!-- FIN ELIMINAR ITEM -->
						  			</tr>
						  			
						  		<?php endfor; ?>

						  		<?php endif; ?>			  		

					  			</tbody>
					  		</table>
				  		</div>

				  	</div>

			  	</div>
			  	<!-- END ROW -->


			</div>

    	</div>

    	<div class="col-md-6">
    		<p id="response">

    		</p>
    	</div>
    </div>    


</div>
<script type="text/javascript">
	jq(document).ready(function() {
		jq("#tabla-generica").DataTable();
	} );
</script>