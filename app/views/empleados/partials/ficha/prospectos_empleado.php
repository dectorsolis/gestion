
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
					<?php if( $data['prospectos'] ): ?>
						<div class="responsive">
							<table id="lista-prospectos" class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Dominio</th>
										<th>Fecha de contacto</th>
										<th>Estatus</th>
									</tr>
									</thead>
									<tbody>

										<?php foreach( $data["prospectos"] as $i => $item ): ?>
										<tr>
											<td> <?= $i + 1; ?> </td>
											<td>
												<?= $item['dominio']; ?>	
											</td>
											<td>
												<?= $item['fecha_contacto']; ?>
											</td>								
											<td> 
												<small class="estado estado-<?= $item['id_estatus']; ?>">
													<?= $item['descripcion']; ?>
												</small>
											</td>
										</tr>
										<?php endforeach; ?>
									</tbody>

							</table>
						</div>
					<?php else: ?>
						<p>No hay prospectos recientes</p>
					<?php endif; ?>					
				</div>
			</div>


			<script type="text/javascript">
				jq(document).ready(function() {
					jq("#lista-prospectos").DataTable();
				});   
			</script>