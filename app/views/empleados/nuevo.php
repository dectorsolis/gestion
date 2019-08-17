<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
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
				<form action="<?= $data['action']; ?>" method="POST" class="op-form">

					<?php require_once INCLUDES . "alerts.php"; ?>

					<div class="row">
						<div class="col-md-12">
							<label for="nombre">Nombre</label>
							<input 
								type="text" 
								name="nombre" 
								id="nombre" 
								value="<?= $form ? $form['nombre'] : ""; ?>" 
								class="form-control"/>
						</div>
					</div>

					<div class="row">
						<div class="col-md-5">
							<label for="ap_paterno">Apellido paterno</label>
							<input type="text" name="ap_paterno" id="ap_paterno" value="<?= $form ? $form['ap_paterno'] : ""; ?>" class="form-control"/>
						</div>
						<div class="col-md-5">
							<label for="ap_materno">Apellido materno</label>
							<input type="text" name="ap_materno" id="ap_materno" value="<?= $form ? $form['ap_materno'] : ""; ?>" class="form-control"/>
						</div>
						<div class="col-md-2">Genero
							<select name="genero" id="genero" class="form-control">
								
								<?php $genero = isset($form['genero']) ? $form['genero'] : ""; ?>

								<option value="M" <?= $genero == 'M' ? "selected" : ""; ?> > M </option>
								<option value="F" <?= $genero == 'F' ? "selected" : ""; ?> > F </option>
							</select>
						</div>					
					</div>

					<div class="row">
						<div class="col-md-4">
							<label for="fecha_nac">Fecha de nacimiento</label>
							<input type="text" name="fecha_nac" id="fecha_nac" value="<?= $form ? $form['fecha_nac'] : ""; ?>" class="fecha form-control"/>
						</div>												
						<div class="col-md-4">
							<label for="email_empresa">Email corporativo</label>
							<input type="text" name="email_empresa" id="email_empresa" value="<?= $form ? $form['email_empresa'] : ""; ?>" class="form-control"/>
						</div>
						<div class="col-md-4">
							<label for="telefono">Telefono </label>
							<input type="text" name="telefono" id="telefono" value="<?= $form ? $form['telefono'] : ""; ?>" class="form-control"/>
						</div>							
					</div>	

					<div class="row">
						
												
						<div class="col-md-4">
							<label for="fecha_ingreso">Fecha de ingreso </label>
							<input type="text" name="fecha_ingreso" id="fecha_ingreso" value="<?= $form ? $form['fecha_ingreso'] : ""; ?>" class="fecha form-control"/>
						</div>	

						<div class="col-md-4">
							<label for="usuario_skype">Usuario skype</label>
							<input type="text" name="usuario_skype" id="usuario_skype" value="<?= $form ? $form['usuario_skype'] : ""; ?>" class="form-control"/>
						</div>
						<div class="col-md-4">
							<label for="departamento">Región</label>
							
							<select name="id_region" id="id_region" class="form-control">
								<option value></option>
								<?php $regiones = $data['regiones']; ?>
								<?php $selected =""; ?>
								
								<?php for($i = 0; $i < count($regiones); $i++): ?>

									<?php if( isset($form['id_region']) ): ?>
										<?php $selected = $form['id_region'] == $regiones[$i]['id'] ? "selected" : "" ; ?>
									<?php endif; ?>

									<option value="<?= $regiones[$i]['id']; ?>" <?= $selected; ?> >  <?= $regiones[$i]['nombre']; ?> </option>

								<?php endfor; ?>	

							</select>	
						</div>						
					</div>

					<div class="row">
						


						<div class="col-md-4">
							<label for="departamento">Departamento</label>
							
							<select name="id_departamento" id="id_departamento" class="form-control">
								<option value></option>
								<?php $deptos = $data['departamentos']; ?>
								<?php $selected =""; ?>
								
								<?php for($i = 0; $i < count($deptos); $i++): ?>

									<?php if( isset($form['id_departamento']) ): ?>
										<?php $selected = $form['id_departamento'] == $deptos[$i]['id'] ? "selected" : "" ; ?>
									<?php endif; ?>

									<option value="<?= $deptos[$i]['id']; ?>" <?= $selected; ?> >  <?= $deptos[$i]['nombre']; ?> </option>

								<?php endfor; ?>	

							</select>	
						</div>

					</div>
					<?php if( isset($form['id_empleado']) ): ?>
						<div class="row">
							<div class="col-md-3">
								<input type="hidden" name="id_empleado" id="id_empleado" value="<?= $form['id_empleado']; ?>" readonly class="form-control"/>
							</div>
						</div>
					<?php endif; ?>

					<!--
					<div class="row">
						<div class="col-md-4">
							<label for="activo">¿Status empleado?</label>
							<select name="status" id="activo" class="form-control">
								<option></option>
									
									<?php if( isset($form['activo']) ): ?>
										
										<option value="activo" <?= $form['activo'] == 1 ? "selected": "" ; ?>> Activo </option>
										<option value="inactivo" <?= $form['activo'] == 0 ? "selected": "" ; ?> > Inactivo </option>

									<?php else: ?>
									
										<option value="activo"> Activo </option>
										<option value="inactivo"> Inactivo </option>									

									<?php endif;?>

							</select>
						</div>								
					
					</div>

					-->

					<div class="row">
						<div class="col-md-2">
							<?php if(isset($form['id_cliente'])): ?>
								<input type="hidden" id="id_cliente" name="id_cliente" value="<?= $form['id_cliente']; ?>"/>
							<?php endif; ?>
							<br>
							<button class="btn-submit estado btn btn-primary">Guardar</button>
						</div>
					</div>		
				</form>				
			</div>
		</div>
	</div>
</div>
