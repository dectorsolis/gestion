		
		<!-- Ultimos tickets generados -->
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
						<?php if( $data['tickets_generados'] ): ?>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>Envíado a</th>
										<th>Sitio</th>
										<th>Prioridad</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
								<?php foreach( $data['tickets_generados'] as $item): ?>
									<tr>
										<td class="gravatar_nombre"> 
											<a href="<?= PATH . 'usuarios/perfil/' . $item['id_user']; ?>">
												<img src="<?= gravatar( $item['email_empresa'],20 ); ?>">
												<?= $item['destinatario'] ?> 
											</a>
										</td>								
										<td><a href="<?= PATH . 'tickets/ficha/' . $item['id_ticket']; ?>"><?= $item['cliente']; ?> </a></td>
										<td>
											<span class="prioridad <?= $item['prioridad']?>">
												<?= $item['prioridad']?>
											</span>
										</td>
										<td> 
											<span class="estado estado-<?= $item['id_estado'] ?>">
												<?= $item['status']; ?> 
											</span>
										</td>
										</a>								
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						<?php else: ?>
							<strong>No hay tickets recientes. </strong>
						<?php endif; ?>
					</div>
				</div>
			</div>
			</div>	
		</div>
		<!-- Fin mis tickets generados -->