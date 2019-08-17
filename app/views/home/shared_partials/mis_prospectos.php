		<!-- Mis prospectos -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><?= $data['titulo']; ?></h2>
						<ul class="nav navbar-right panel_toolbox">
			                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			            </ul>	
						<div class="clearfix"></div>	            
					</div>
					
					<div class="x_content">
						<div class="table-responsive">
							<?php if( $data['prospectos'] ): ?>
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Dominio</th>
											<th>Contacto</th>
											<th>Estatus</th>
											<th>Editar</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach( $data['prospectos'] as $item ): ?>
										<tr>
											<td> <?= $item['dominio']; ?> </td>
											<td> <?= $item['nombre_contacto']; ?> </td>
											<td> 
												<span class="estado estado-<?= $item['id_estatus']; ?>"> 
													<?= $item['descripcion']; ?> 
												</span> 
											</td>
											<td>
												<a href="<?= PATH . 'prospectos/editar/' . $item['id_prospecto'] ?>">
													<span class="glyphicon glyphicon-edit"></span>
												</a>
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
							<?php else: ?>
								<strong>No tienes prospectos recientes. </strong>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Fin mis prospectos -->		