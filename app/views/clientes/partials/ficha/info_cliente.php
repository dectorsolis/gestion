		
			<?php $cliente = $data['datos']; ?>
			<!-- Ficha de contacto del cliente -->
			<div class="col-md-4">
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
						<table class="info">
							<tr>
								<td>Nombre</td>
								<td><?= $cliente['nombre'] . ' ' . $cliente['ap_paterno'] . ' ' . $cliente['ap_materno']; ?></td>
							</tr>
							<tr>
								<td>Dominio</td>
								<td><?= $cliente['dominio'] ?></td>
							</tr>
							<tr>
								<td>Fecha dominio</td>
								<td><?= $cliente['creacion_dominio']; ?></td>
							</tr>
							<tr>
								<td>Empresa</td>
								<td><?= $cliente['nombre_empresa']; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?= $cliente['email_empresa']; ?></td>
							</tr>
							<tr>
								<td>Tel. fijo</td>
								<td><?= $cliente['telefono_casa']; ?></td>
							</tr>
							<tr>
								<td>Tel. móvil</td>
								<td><?= $cliente['telefono_movil']; ?></td>
							</tr>
							<tr>
								<td>Ingreso</td>
								<td><?= $cliente['fecha_ingreso']; ?></td>
							</tr>
							<tr>
								<td>Skype</td>
								<td><?= $cliente['usuario_skype']; ?></td>
							</tr>
							<tr>
								<td>Membresía</td>
								<td><strong><?= $cliente['membresia']; ?></strong></td>
							</tr>
							<tr>
								<td>Estatus</td>
								<td>
									<?php 
										$class= "inactivo"; 
										$estatus = "Inactivo";
										
										if( $cliente['activo'] ){
											$class = "activo";
											$estatus = "Activo";
										}

									?>
									<span class="estado <?= $class; ?>"><?= $estatus; ?></span>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<a href="<?= PATH . "clientes/editar/" . $cliente['id_cliente']; ?>">
										<span class="fa fa-edit"></span> Editar
									</a>										
								</td>
							</tr>
						</table>
					</div>
				</div>		
			</div>
		
		<!-- Fin ficha de contacto del cliente -->