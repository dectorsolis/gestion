<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2><?= $data['titulo'] ?></h2>
				<div class="clearfix"></div>	            
			</div>
			
			<div class="x_content">
				<?php require_once INCLUDES . "alerts.php"; ?>
				  	<table id="usuarios" class="table table-hover">
						<thead>
						    <tr>
						        <th>#</th>
						        <th>Usuario</th>
						        <th>Nombre</th>
						        <th>última sesión</th>
						        <th>Rol</th>
						        <th></th>
						    </tr>
						</thead>							
				  	    <tbody>
				  	   	<?php if( isset($data['usuarios']) ): ?>
							<?php foreach( $data['usuarios'] as $i => $item ):?>	                
							<tr>
								<td> <?= $i + 1; ?> </td>
								<td> 
									<a href="<?= PATH . 'usuarios/ficha/' . $item['id_user']; ?>">
										<?= $item['username'] ?> 
									</a>
								</td>
								<td> <?= $item['nombre'] ?> </td>
								<td> <?= $item['last_login'] ?> </td>
								<td> 
									<a 
										id="rol-<?= $item['id_user']; ?>"
										href="#"									
										class="rol" 
										data-href="<?= $data['href_cambiar_rol'] . '/' . $item['id_user'] ?>" 
										data-id-rol="<?= $item['id_rol'] ?>"
										data-id-user="<?= $item['id_user'] ?>"
										>
										<?= $item['rol'] ?>
									</a>
									<div id="user-<?= $item['id_user'] ?>" class="ajax-request"></div>
								</td>
								<td>
									<form method="POST" action="<?= PATH . 'usuarios/eliminar/'; ?>" class="op-form">
										<input type="hidden" name="id_user" value="<?= $item['id_user']; ?>">
										<input type="hidden" name="id_empleado" value="<?= $item['id_empleado']; ?>">
										<button type="submit" class="btn btn-danger btn-submit fa fa-trash">	
										</button>
									</form>
								</td>
							</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					    </tbody>
					</table>
		                <script type="text/javascript">
		                    jq(document).ready(function() {
		                    jq("#usuarios").DataTable();
		                } );
		                </script>					
			</div>
		</div>
	</div>
</div>


							

