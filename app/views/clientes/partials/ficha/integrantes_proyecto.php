		<!-- INTEGRANTES DEL PROYECTO -->	
			<div class="col-md-12	">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="float-left"><?= $data['titulo']?> </h4>
						<ul class="nav navbar-right panel_toolbox">
			                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			            </ul>	
						<div class="clearfix"></div>	            
					</div>
					
					<div class="x_content">		
						<!--AGREGAR INTEGRANTE DEL PROYECTO -->
						<div class="ajax-request">
							<?php if( isset($data['deptos']) ): ?>
								<strong>Agregar nuevo integrante</strong>
								<form 
									class="form-ajax"
									method="POST" 
									action="<?= PATH . "clientes/filtro/" ?>" 
									data-id-response = "response-integrantes" 
									data-id-loader = "#response-integrantes"
									data-response-method="html">
									<div class="form-group">
										<div class="col-md-4">
											<input type="hidden" name="id_cliente" value="<?= $data['id_cliente']; ?>">
						 					<select name="id_departamento" class="form-control">
								  				<option value="">Elige un departamento</option>
								  				<?php foreach( $data['deptos'] as $item): ?>
								  					<option value="<?= $item['id']; ?>" >
								  						<?= $item['nombre']; ?>
								  					</option>
								  				<?php endforeach; ?>
											</select>												
										</div>
										<div class="col-md-2">
											<button type="submit" class="btn btn-primary">Filtrar</button>
										</div>
									</div>	
								</form>
									
								<p id="response-integrantes">
									
								</p>
							<?php endif; ?>
						</div>
						<!-- FIN AGREGAR INTEGRANTE -->																				
						<?php if(isset($data['integrantes'])): ?>
							<div class="table-responsive">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Departamento</th>
											<th>Nombre</th>
											<th>Teléfono</th>
											<th>Email</th>
											<th>Skype</th>
											<th>Remover</th>
										</tr>
										<tbody>
										<?php foreach( $data['integrantes'] as $item): ?>
							
											<tr>
												<td> <?= $item['departamento'] ?> </td>
												<td> <?= $item['nombre'] ?> </td>
												<td> <?= $item['telefono'] ?> </td>
												<td> <?= $item['email_empresa'] ?> </td>
												<td> <?= $item['usuario_skype'] ?> </td>
												<td>
													<form method="POST" action="<?= $data['action_form_remover_integrante'] ?>" class="eliminar-registro">
														<input type="hidden" name="id_empleado" value="<?= $item['id_empleado'];?>"/>
														<button type="submit" class="btn btn-sm btn-danger">
														<span class="fa fa-trash"></span>
													</button>
												</form>
												</td>
											</tr>
										<?php endforeach; ?>									
										</tbody>
									</thead>
								</table>
							</div>
						<?php else: ?>
						<h4>No hay ningún integrante</h4>
						<?php endif; ?>
				
					</div>
				</div>
			</div>				
		<!-- FIN INTEGRANTES DEL PROYECTO -->						