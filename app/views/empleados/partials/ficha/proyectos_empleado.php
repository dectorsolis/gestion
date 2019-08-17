
			<div class="x_panel">
				<div class="x_title">
					<h2> <?= $data['titulo']?> </h2>
					<ul class="nav navbar-right panel_toolbox">
		                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
		            </ul>	
					<div class="clearfix"></div>	            
				</div>
				
				<div class="x_content">						
					<div class="table-responsive">
						<?php if( $data['proyectos'] ): ?>
						
						<table id="tabla-proyectos" class="table">

							<thead>
								<tr>
									<th>#</th>
									<th>Proyecto</th>
									<th>Región</th>
									<th>Ficha técnica</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach( $data["proyectos"] as $i => $item ): ?>
								<tr>
									<td> <?= $i + 1; ?> </td>
									<td class="<?= $item['activo'] ? 'success': 'danger';?>" >
										<a href="<?= PATH . "clientes/ficha/" . $item['id_cliente']; ?>/">
											<?= $item['dominio'] ;?>
										</a>	
									</td>
									<td> <?= $item['region'] ;?> </td>
									<td>
										<a href="<?= PATH . "clientes/ficha/" . $item['id_cliente'] ?>">Ver ficha</a>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>

						</table>
						<!-- Fin Tabla de proyectos del empleado -->
						<?php else: ?>
							<p>No hay proyectos recientes</p>
						<?php endif; ?>	
					</div>				
				</div>
			</div>

			<script type="text/javascript">
				jq(document).ready(function() {
					jq("#tabla-proyectos").DataTable();
				} );
			</script>		


