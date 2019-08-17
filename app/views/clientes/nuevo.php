<div class="row">
	<!-- Mis clientes -->
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2> <?= $data['titulo'] ?> </h2>
				<ul class="nav navbar-right panel_toolbox">
	                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
	            </ul>	
				<div class="clearfix"></div>	            
			</div>
			
			<div class="x_content">
				<?php require_once INCLUDES . "alerts.php"; ?>			
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<form action="<?= $data['action']; ?>" method="POST" class="form-horizontal form-label-left op-form">

							<!-- Input nombre -->
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">
									Nombre <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="nombre" id="nombre" value="<?= $form ? $form['nombre'] : ""; ?>" class="form-control"/>
								</div>
							</div>
							<!-- fin input nombre -->

							<!-- Ap paterno -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ap_paterno">
									Apellido paterno <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="ap_paterno" id="ap_paterno" value="<?= $form ? $form['ap_paterno'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
								</div>
							</div>
							<!-- End Ap paterno -->

							<!-- Ap materno -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ap_materno">
									Apellido materno<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="ap_materno" id="ap_materno" value="<?= $form ? $form['ap_materno'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
								</div>
							</div>						
							<!-- End ap materno -->

							<!-- Dominio -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="dominio">
									Dominio (URL) <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="dominio" id="dominio" value="<?= $form ? $form['dominio'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
								</div>
							</div>
							<!-- End dominio -->


							<!-- Nombre empresa -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empresa">
									Nombre empresa<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="nombre_empresa" id="nombre_empresa" value="<?= $form ? $form['nombre_empresa'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
								</div>
							</div>						
							<!-- End nombre empresa -->

							<!-- Fecha creacion -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="creacion_dominio">
									Fecha de creación del dominio<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="creacion_dominio" id="creacion_dominio" value="<?= $form ? $form['creacion_dominio'] : ""; ?>" class="fecha form-control col-md-7 col-xs-12"/>
								</div>
							</div>
							<!-- End fecha creacion -->


							<!-- Email corporativo -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email_empresa">
									Correo electrónico<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="email_empresa" id="email_empresa" value="<?= $form ? $form['email_empresa'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
								</div>
							</div>
							<!-- End email corporativo -->


							<!-- Tel fijo -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_casa">
									Teléfono oficina <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="telefono_casa" id="telefono_casa" value="<?= $form ? $form['telefono_casa'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
								</div>
							</div>
							<!-- End Tel fijo -->


							<!-- Tel móvil-->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono_movil">
									Teléfono móvil<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="telefono_movil" id="telefono_movil" value="<?= $form ? $form['telefono_movil'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
								</div>
							</div>
							<!-- End Tel móvil -->


							<!-- Fecha de ingreso -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_ingreso">
									Fecha de ingreso<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="fecha_ingreso" id="fecha_ingreso" value="<?= $form ? $form['fecha_ingreso'] : ""; ?>" class="fecha form-control col-md-7 col-xs-12"/>
								</div>
							</div>
							<!-- End fecha ingreso -->



							<!-- Usuario skype -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="usuario_skype">
									Usuario skype<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<input type="text" name="usuario_skype" id="usuario_skype" value="<?= $form ? $form['usuario_skype'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
								</div>
							</div>
							<!-- End Usuario skype -->


							<!-- Región cliente -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="region">
									Región <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<select name="region" id="region" class="form-control">
										<option value></option>
										<?php $regiones = $data['regiones']; ?>
										<?php foreach( $data['regiones'] as $item ): ?>
											<?php $selected = "" ?>
											<?php if( $form ): ?>
												<?php $selected = isset($form['id_region']) && $form['id_region'] == $item['id'] ? "selected": "" ; ?>
											<?php endif; ?>
											<option value="<?= $item['id'] ?>" <?= $selected ?> > 
												<?= $item['nombre'] ?>  
											</option>		
										<?php endforeach; ?>	

									</select>										
								</div>
							</div>
							<!-- End región cliente -->
							
							<!-- Membresía cliente -->
							<div class="form-group">	
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="membresia">
									Membresía <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-9 col-xs-12">
									<select name="membresia" id="membresia" class="form-control">
										<option value></option>
										<?php foreach( $data['membresias'] as $item ): ?>
											<?php $selected = "" ?>
											<?php if( $form ): ?>
												<?php $selected = isset($form['id_membresia']) && $form['id_membresia'] == $item['id_membresia'] ? "selected": "" ; ?>
											<?php elseif( $update ): ?>
												<?php $selected = isset($update['id_membresia']) && $update['id_membresia'] == $item['id_membresia'] ? "selected": "" ; ?>												
											<?php endif; ?>
											
											<option value="<?= $item['id_membresia'] ?>" <?= $selected ?> > 
												<?= $item['descripcion'] ?>  
											</option>											
										<?php endforeach; ?>	

									</select>										
								</div>
							</div>
							<!-- End membresía cliente -->							

							<!-- submit button -->
							<div class="form-group">
								<div class="col-md-6 col-sm-9 col-xs-12 col-md-offset-3">
									<?php if(isset($form['id_cliente'])): ?>
										<input type="hidden" id="id_cliente" name="id_cliente" value="<?= $form['id_cliente']; ?>"/>
									<?php endif; ?>								
			                        <button type="submit" class="btn btn-submit btn-primary">Guardar</button>
			                    </div>	
							</div>						
							<!-- end submit -->
						</div>

					</form>

			</div>
		</div>
	</div>
</div>

