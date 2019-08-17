
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php if( $data['accesos'] ): ?>
					<h3 class="panel-title"><?= $data['accesos'][0]['dominio']; ?></h3>
					<?php endif; ?>
			  	</div>	
			  	<br>

			  	<div class="row">
			  		<div class="col-md-12">
						<a href=" <?= PATH . "accesos/nuevo/" . $data['id_cliente']; ?> " class="btn btn-primary btn-sm">
						   <span class="glyphicon glyphicon-plus"></span> Agregar acceso
						</a>
			  		</div>
			  	</div>
			  	<br>

				<div class="row">
				    <div class="table-responsive col-md-12">
				    	<?php require_once INCLUDES . "alerts.php"; ?>
						<table class="lista table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Tipo</th>
									<th></th>								
									<th></th>								
									<th>URL</th>
									<th>Usuario</th>
									<th>Contraseña</th>
								</tr>
							</thead>
							<tbody>
								<?php if( isset($data['accesos']) ): ?>
									<?php $accesos = $data['accesos']; ?>
									<?php for($i = 0; $i < count($accesos); $i++): ?>							
									<tr>
										<td>
											<?= $i +1; ?>
										</td>
										<td>
											<?= $accesos[$i]['nombre'];?>
										</td>
										<td>
											<a class="btn btn-success btn-sm" 
												href="<?= PATH . "accesos/editar/". $accesos[$i]['id_cliente'] . "/" . $accesos[$i]['id_acceso'] . "/"; ?>">
												<span class="glyphicon glyphicon-edit"></span>
											</a>
										</td>
										<td>
											<form method="POST" action="<?= PATH . "accesos/eliminar/" . $accesos[$i]['id_cliente'] . "/"; ?>" class="eliminar-registro">

												<input type="hidden" name="token" value="<?= $accesos[$i]['id_acceso']; ?>">
												<button class="btn btn-danger btn-sm" type="submit">
													<span class="glyphicon glyphicon-trash"></span>
												</button>
											</form>
										</td>									
										<td>
											<a href="<?= $data[$i]['url_acceso']; ?>"><?= $accesos[$i]['url_acceso']; ?></a>
										</td>
										<td>
											<?= $accesos[$i]['usuario']; ?>
										</td>
										<td>
											<?= $accesos[$i]['pass']; ?>
										</td>
									</tr>
									<?php endfor; ?>
								<?php endif; ?>
							</tbody>
						</table>
				    </div>
				</div>	

			</div>	

		</div>
