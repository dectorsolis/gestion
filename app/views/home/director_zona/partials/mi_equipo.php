	<div class="row">
		<div class="col-md-12 col-xs-12">
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
					<table class="table table-hover">
						<thead></thead>
						<tbody>

						<?php foreach( $data["empleados"] as $item ): ?>
							<tr>
								<td> 
									<img src = "<?= gravatar( $item["email_empresa"], 40 ) ?> " />
								</td>
								<td> 
									<?= $item["nombre"] ?> 
									<div> 
										<a href="<?= PATH . "empleados/ficha/" . $item["id_empleado"] ?>">Ficha empleado | </a>
										<a href="<?= PATH . "usuarios/perfil/" . $item["id_user"] ?>">Ver perfil</a>
									</div>
									<div>
										<strong>Última sesión:</strong> <?= $item["last_login"] ?>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>