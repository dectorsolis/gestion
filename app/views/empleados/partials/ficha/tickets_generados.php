
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
						
						<?php if( $data['tickets_generados'] ): ?>
						<div class="table-responsive">
						<table id="tickets-generados" class="table" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Ticket #</th>
									<th>Proyecto</th>
									<th>Fecha creación</th>
									<th>Asunto</th>
									<th>Involucrado</th>
									<th>Inicio</th>
									<th>Finalización</th>
									<th>Prioridad</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tfoot>
							
							</tfoot>
							<tbody>
								<?php foreach( $data['tickets_generados'] as $i => $item ): ?>
								<tr>
									<td>
										<a href="<?= PATH . 'tickets/ficha/' . $item['id_ticket']; ?>">
											<?= $item['id_ticket']; ?>
										</a>
									</td>
									<td><?= $item['cliente']; ?></td>
									<td><?= $item['fecha_creacion']; ?></td>
									<td><?= $item['asunto']; ?></td>
									<td><?= $item['involucrado']; ?></td>
									<td><?= $item['fecha_inicio']; ?></td>
									<td><?= $item['fecha_final']; ?></td>								
									<td>
										<span class="prioridad <?= $item['prioridad']; ?>">
											<?= $item['prioridad']; ?>
										</span>
									</td>
									<td>
										<span class="estado estado-<?= $item['id_estado']; ?>">
											<?= $item['estado']; ?>
										</span>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>

						</table>
						</div>
						<?php else: ?>
						
						<p>No hay proyectos recientes</p>
						
						<?php endif; ?>				
				</div>
			</div>


			<script type="text/javascript">
				jq(document).ready(function() {
					jq("#tickets-generados").DataTable();
				} );     
			</script>
