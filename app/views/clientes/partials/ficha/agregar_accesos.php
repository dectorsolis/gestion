		<!-- AGREGAR ACCESOS -->
		
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="float-left"> <?= $data['titulo']?> </h4>
						<ul class="nav navbar-right panel_toolbox">
			                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			            </ul>	
						<div class="clearfix"></div>	            
					</div>
					
					<div class="x_content">	
						<button 
							class="btn btn-primary link-ajax" 
							data-href="<?= $data['href_nuevo_acceso'] ?>"
							data-id-loader = "#response-accesos"
							data-id-response="response-accesos" 
							data-response-method ="html">Agregar acceso</button>
						
						<div class="table-responsive">
							<table class="table">
								<tr>
									<th>Tipo</th>
									<th>Url acceso</th>
									<th>Usuario</th>
									<th>Password</th>
									<th>Editar</th>
									<th>Eliminar</th>
								</tr>
								<?php foreach( $data['accesos'] as $i => $item ): ?>	
								<tr id="acceso-<?= $item['id_acceso'] ?>">
									<td> <?= $item['nombre']?> </td>
									<td> <?= $item['url_acceso']?> </td>
									<td> <?= $item['usuario']?> </td>
									<td> <?= base64_decode($item['pass'])?> </td>
									<td>
										<a 
											href="#" class="link-ajax"
											data-href="<?= PATH . "accesos/editar/" . $item["id_cliente"] . "/" . $item["id_acceso"]  ?>"
											data-id-loader = "#response-accesos"
											data-id-response = "response-accesos"
											data-response-method = "html"
										>
											<span class="fa fa-edit"></span>	
										</a>
									</td>
									<td id="loader-accesos-<?= $i ?>">
										<a 
											href="#" class="link-ajax" 
											data-href="<?= PATH . 'accesos/eliminar/' . $item['id_acceso'] ?>" 
											data-id-loader = "#loader-accesos-<?= $i ?>"
											data-id-response = "response-accesos"
										>
											<span class="fa fa-remove"></span>
										</a>
									</td>
								</tr>
								<?php endforeach; ?>							
							</table>							
						</div>
						
						<div id="loader"></div>
						<div id="response-accesos" class="ajax-request">
							
						</div>
					</div>
				</div>
			</div>
		
		<!-- FIN AGREGAR ACCESOS -->						