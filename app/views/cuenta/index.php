<h2><?= $data['titulo'] ?></h2><br>
<div class="row">
	<div class="col-md-12">
		<?php require_once INCLUDES . "alerts.php"; ?>
	</div>
</div>

<div class="row">
	
	<!--columna1 -->
	<div class="col-md-5 col-xs-12">
		
		<!-- cambio de password -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2> <?= $data['titulo1'] ?> </h2>
						<ul class="nav navbar-right panel_toolbox">
			                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			            </ul>	
						<div class="clearfix"></div>	            
					</div>
						
					<div class="x_content">
						<div class="row">
							<div class="col-md-12 col-xs-12">
								<form method="POST" action="<?= $data['action_form_update_pass'] ?>">
									<input type="text" name="pass" placeholder="Nueva contraseña" class="form-control"><br>
									<button type="submit" class="btn btn-primary">Cambiar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Editar sobre mi -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2> <?= $data['titulo3'] ?> </h2>
						<ul class="nav navbar-right panel_toolbox">
			                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			            </ul>	
						<div class="clearfix"></div>	            
					</div>
						
					<div class="x_content">
						<div id="response-sobremi"></div>
						<div class="ajax-request">
							<form 
								method="POST" 
								action="<?= $data['action_sobremi'] ?>" 
								class="form-ajax"
								data-id-loader="#response-sobremi"
								data-id-response="response-sobremi"
								data-response-method="html">
								<label>Escribe un texto breve sobre tu persona</label>								
								<textarea name="sobremi" rows="4" class="form-control"></textarea>
								<input type="hidden" name="type" value="update_sobremi">
								<input type="hidden" name="id_user" value="<?= $data["user"]["id_user"] ?>">								
								<br>
								<button type="submit" class="btn btn-primary">Guardar</button>
							</form>
						</div>
					</div>
				</div>			
			</div>
		</div>
		
		<!-- Editar info -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2> <?= $data['titulo2'] ?> </h2>
						<ul class="nav navbar-right panel_toolbox">
			                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			            </ul>	
						<div class="clearfix"></div>	            
					</div>
						
					<div class="x_content">
						
						<?php if( $data['info_personal'] ): ?>
							<?php $info = $data['info_personal'][0]; ?>
							<form method="POST" action="<?= $data['action_form_update_info']; ?>" class="form-horizontal form-label-left">
								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Nombre</label>
									<div class="col-md-9 col-xs-12">
										<input type="text" name="nombre" value="<?= $info['nombre']; ?>" class="form-control">
									</div>
								</div>

								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Ap. paterno</label>
									<div class="col-md-9 col-xs-12">
										<input type="text" name="ap_paterno" value="<?= $info['ap_paterno']; ?>" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Ap. materno</label>
									<div class="col-md-9 col-xs-12">								
										<input type="text" name="ap_materno" value="<?= $info['ap_materno']; ?>" class="form-control">
									</div>
								</div>

								<!-- genero -->		
								<?php
									$genero = array(
										'M' => 'Masculino',
										'F' => 'Femenino'
									);
								?>			
								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Género</label>
									<div class="col-md-9 col-xs-12">	
										<select name="genero" class="form-control">
											<?php foreach( $genero as $index => $value ): ?>
												<?php $selected = $info['genero'] == $index ? 'selected' : '' ; ?>
												<option value="<?= $index; ?>" <?= $selected; ?> > 
													<?= $value; ?> 
												</option>
											<?php endforeach;?>
										</select>												
									</div>
								</div>								
								<!-- fin genero -->
								
								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Fecha de nacimiento</label>
									<div class="col-md-9 col-xs-12">
										<input type="text" name="fecha_nac" value="<?= $info['fecha_nac']; ?>" id="fecha_nac" class="fecha form-control">								
									</div>
								</div>					

								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Email corporativo</label>
									<div class="col-md-9 col-xs-12">
										<input type="text" name="email_empresa" value="<?= $info['email_empresa']; ?>" class="form-control">
									</div>
								</div>													
								
								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Teléfono</label>
									<div class="col-md-9 col-xs-12">
										<input type="text" name="telefono" value="<?= $info['telefono']; ?>" class="form-control">								
									</div>
								</div>	

								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Fecha de ingreso</label>
									<div class="col-md-9 col-xs-12">									
										<input type="text" name="fecha_ingreso" value="<?= $info['fecha_ingreso']; ?>" id="fecha_ingreso" class="fecha form-control">								
									</div>
								</div>						
								
								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Usuario skype</label>
									<div class="col-md-9 col-xs-12">
										<input type="text" name="usuario_skype" value="<?= $info['usuario_skype']; ?>" class="form-control">
									</div>
								</div>								


								<!-- regiones -->
								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Región</label>
									<div class="col-md-9 col-xs-12">
										<select name="id_region" class="form-control">
										<?php foreach( $data['regiones'] as $item ): ?>
											<?= $selected = $info['id_region'] == $item['id'] ? 'selected' : ''; ?>
											<option value="<?= $item['id']; ?>" <?= $selected; ?> > 
												<?= $item['nombre']; ?> 
											</option>
										<?php endforeach;?>
										</select>																		
									</div>
								</div>
								
								<!-- deptos -->
								<div class="form-group">
									<label class="control-label col-md-3 col-xs-12">Departamento</label>
									<div class="col-md-9 col-xs-12">
										<select name="id_departamento" class="form-control">
										<?php foreach( $data['deptos'] as $item ): ?>
											<?= $selected = $info['id_departamento'] == $item['id'] ? 'selected' : ''; ?>
											<option value="<?= $item['id']; ?>" <?= $selected; ?> > 
												<?= $item['nombre']; ?> 
											</option>
										<?php endforeach;?>
										</select>										
									</div>
								</div>								
								<!-- fin deptos -->

								<div class="form-group">
									<div class="col-md-9 col-md-offset-3 col-xs-12">
										<input type="hidden" name="id_empleado" value="<?= $info['id_empleado']; ?>">
										<button type="submit" class="btn btn-primary">Actualizar</button>								
									</div>
								</div>
								<!-- fin regiones -->
							</form>
						<?php endif;?>						
					</div>
				</div>
			</div>
		</div>		
	</div>
	<!-- fin columna1 -->

	<!-- columna2 -->	
	<div class="col-md-7 col-sm-6 col-xs-12">
<div class="row">
	<div class="col-md-12">
		<div class="x_panel">
			<div class="x_title">
				<label class="label label-danger">Firma para correo</label>	
				<ul class="nav navbar-right panel_toolbox">
	                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
	            </ul>	
				<div class="clearfix"></div>	            
			</div>
						
			<div class="x_content">	
			<?php if( $data['info_personal'] ): ?>
				<?php $info = $data['info_personal'][0]; ?>
					<table style="width: 400px;">
						<tr>
							<td style="border-right: 2px solid #91d128; padding-right:8px;"><img style="border-radius:50%;" src="<?= gravatar( $data['user']['username'] , 110); ?>" ></td>
							<td style="padding-left:8px;">
								<strong style="font-size: 16px;"><?= $info['nombre'] . ' ' . $info['ap_paterno'] . ' ' . $info['ap_materno'] ?></strong><br>
								<span style="font-size: 13px; font-weight: 700; color:#2c4a69;"><?= $info['depto'] ?></span><br>
								<a href="<?= 'mailto:' . $info['email_empresa'] ?>" style="font-size: 13	px;"><?= $info['email_empresa'] ?></a><br>
								<a href="https://www.optimizacion-online.com" style="font-size: 13	px;">https://www.optimizacion-online.com</a><br>
								<span style="line-height: 16px; font-size: 12px; font-weight: 700; color:#2c4a69;">Tel: <?= $info['telefono'] ?></span><br>
								<span style="line-height: 16px; font-size: 12px; font-weight: 700; color:#2c4a69;">Skype: <?= $info['usuario_skype'] ?></span>
							</td>
						</tr>					
						<tr>
							<td colspan="2" style="padding: 8px 0px; border-top: 1px solid #91d128;">
								<i style="color:gray;">"La firma con mayor crecimiento en SEO en el mercado de habla hispana"</i>
							</td>
						</tr>							
					</table>	
					<table style="width:480px;">							
						<tr>
							<td colspan="2">
								<img src="https://www.optimizacion-online.com/firmas/firma-2017.jpg" style="width:580px;" alt="Oficinas Optimización Online">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<br>
								<p style="text-align:justify; font-size: 12px;">
									<strong>Aviso de Privacidad</strong>: De acuerdo a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares, en los artículos 3, 
									Fracciones II y VII, y 33, así como la denominación del capítulo II, del Título Segundo, de la Ley Federal de Transparencia y Acceso a la 
									Información Pública Gubernamental, Diseño y Optimización Online S.A de C.V le informa que toda su información personal en nuestras bases de 
									datos no está a la venta ni disponible para su comercialización con terceros. Si desea dejar de recibir estos emails por favor mandar correo a: 
									<a href="mailto:soporte@optimizacion-online.com">soporte@optimizacion-online.com</a>
								</p>
								<p style="text-align:justify; font-size: 12px;">
									<strong>IMPORTANTE</strong>: Si ésta información no es para ud. por favor responda a este Email con la palabra REMOVE en el asunto para ser eliminado 
									de la newsletter y tenga a bien disculparnos por las molestias ocasionadas. Este mensaje cumple con el CAN-SPAM ACT y ofrece una forma 
									directa y válida de remoción.
								</p>			
							</td>
						</tr>		
					</table>					
			<?php endif; ?>					
			</div>
		</div>
	</div>
</div>			

	</div>
	<!-- fin columna2 -->	
</div>