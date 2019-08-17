
		<!-- TICKETS GENERADOS -->
			<div class="row">
				<div class="col-md-12 col-sm-6 col-xs-12">
					<div class="x_panel">
						
						<div class="x_title">
							<h2><?= $data['titulo'] ?></h2>
							<div class="clearfix"></div>
						</div>
						
						
						
						<div class="x_content">
							<div class="table-responsive col-md-12">
								
								<div class="table-responsive">
								<?php if( $data['tickets_generados'] ): ?>
								<table id="tickets-generados" class="table table-hover" cellspacing="0" width="100%">

									<thead>
										<tr>
											<th>#</th>
											<th>#ID</th>
											<th>Asunto</th>
											<th>Proyecto</th>
											<th>Fecha creación</th>
											<th>Departamento</th>
											<th>Prioridad</th>
											<th>Estado</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach( $data['tickets_generados'] as $i => $item ): ?>
										<tr class="table-pointer" data-href="<?= PATH . 'tickets/ficha/' . $item['id_ticket'];  ?>">
											<td><?= $i + 1 ?></td>
											<td>
												<?= $item['id_ticket']; ?>
											</td>
											<td><?= $item['asunto']; ?></td>
											<td><?= $item['cliente']; ?></td>
											<td><?= $item['fecha_creacion']; ?></td>
											<td><?= $item['departamento']; ?></td>							
											<td>
												<small class="prioridad <?= $item['prioridad']; ?>">
													<?= $item['prioridad']; ?>
												</small>
											</td>
											<td>
												<small class="estado estado-<?= $item['id_estado']; ?>">
													<?= $item['estado']; ?>
												</small>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>

								</table>
								</div>
								<script type="text/javascript">
								   	jq(document).ready(function() {
									    jq("#tickets-generados").DataTable();
								    } );
								</script>									
								<?php else: ?>
								
								<p>No hay tickets generados recientemente</p>
								
								<?php endif; ?>
							</div>							
						</div>
					</div>
				</div>
			</div>
	

		<!-- END TICKETS GENERADOS -->