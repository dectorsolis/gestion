		<!-- Mis clientes -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><?= $data['titulo'] ?></h2>
						<ul class="nav navbar-right panel_toolbox">
			                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			            </ul>	
						<div class="clearfix"></div>	            
					</div>
					
					<div class="x_content">
						<div class="table-responsive">
							<?php if( $data['proyectos'] ): ?>
								<!-- Tabla de proyectos empleado -->
								<table id="tabla-proyectos" style="padding: 0px;" class="table table-hover" role="grid" aria-describedby="datatable_info">
									<thead>
										<tr>
											<th>#</th>
											<th>Proyecto</th>
											<th>Crear ticket</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($data['proyectos'] as $index => $item ): ?>
										<tr>
											<td> <?= $index + 1; ?> </td>
											<td>
												<a href="<?= PATH . "clientes/ficha/" . $item['id_cliente']; ?>/"> <?= $item['dominio'] ;?> </a>
											</td>
											<td> 
												<a href="<?= PATH . 'tickets/nuevo/' . $item['id_cliente']; ?>">
													<i class="ticket icon-size fa fa-ticket"></i>
												</a> 
											</td>
										</tr>
									<?php endforeach; ?>
									</tbody>
								</table>
								<!-- Fin Tabla de proyectos del empleado -->
							<?php else: ?>
								<p>No tienes proyectos recientes</p>
							<?php endif; ?>	
						</div>
					</div>
				</div>
			</div>
		</div>		
		<!-- Fin mis clientes -->