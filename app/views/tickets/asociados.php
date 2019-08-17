		<!-- TICKETS ASOCIADOS A MI CUENTA -->
			<div class="row">
				
				<div class="col-md-12 col-sm-6 col-xs-12">
					<div class="x_panel">
						<div class="x_title">
							<h2><?= $data['titulo'] ?></h2>
				            <div class="clearfix"></div>							
						</div>

						<div class="x_content">
							<?php require_once INCLUDES . "alerts.php"; ?>
							<div class="table-responsive">
							<?php if( ( $data['tickets_asociados'] ) ): ?>
							<table id="tickets-solicitados" class="table table-hover"  cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>#ID</th>
										<th>Asunto</th>
										<th>Proyecto</th>
										<th>Emisor</th>
										<th>Fecha creación</th>
										<th>Prioridad</th>
										<th>Estado</th>
									</tr>
								</thead>
								<tbody>
									<?php $tickets_asociados = $data['tickets_asociados']; ?>
									<?php foreach( $tickets_asociados as $i => $item ): ?>
									<tr>
										<td><?= $i + 1 ?></td>
										<td><b><?= $item['id_ticket']; ?></b></td>
										<td>
											<a href="<?= PATH . 'tickets/ficha/' . $item['id_ticket'];  ?>" target="_blank" style="color:#5e9cde;">
												<?= $item['asunto']; ?>
											</a>
										</td>
										<td><?= $item['cliente']; ?></td>
										<td><label class="label label-default"><?= $item['emisor']; ?></label></td>
										<td><?= $item['fecha_creacion']; ?></td>
										<td>
											<small class="label <?= $item['prioridad']; ?>"><?= $item['prioridad']; ?></small>								
										</td>
										<td> <small class="label estado-<?= $item['id_estado']; ?>"><?= $item['estado']?></small></td>
									</tr>
									<?php endforeach; ?>
								</tbody>

							</table>
							</div>
							<script type="text/javascript">
							   	jq(document).ready(function() {
								    jq("#tickets-solicitados").DataTable();
							    } );
							</script>								
							<?php else: ?>
							<p>No hay tickets asociados recientes</p>

							<?php endif; ?>	
						</div>
					</div>
				</div>

			</div>
		<!-- END TICKETS ASOCIADOS A MI CUENTA -->