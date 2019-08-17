<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> <?= $data['titulo'] ?> </h2>
 	               <ul class="nav navbar-right panel_toolbox">
    	               <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
            </div>

	        <div class="x_content">

				<div class="row">
			
				<div class="col-md-12 col-sm-12 col-xs-12">
					
	                <form action="<?= $data['action']; ?>" method="POST" class="op-form form-horizontal form-label-left">
	                    
						<?php require_once INCLUDES . "alerts.php"; ?>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_empresa">
								Empresa <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="nombre_empresa" id="nombre_empresa" value="<?= $form ? $form['nombre_empresa'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="dominio">
								Dominio <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="dominio" id="dominio" value="<?= $form ? $form['dominio'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
							</div>
						</div>


						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="fecha_contacto">
								Fecha de contacto <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="fecha_contacto" id="fecha_contacto" value="<?= $form ? $form['fecha_contacto'] : ""; ?>" class="fecha form-control col-md-7 col-xs-12"/>
							</div>	
						</div>


						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre_contacto">
								Nombre contacto <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="nombre_contacto" id="nombre_contacto" value="<?= $form ? $form['nombre_contacto'] : ""; ?>" class="form-control col-md-7 col-xs-12"/>
							</div>	
						</div>

						<div class="form-group">
							<div class="col-md-6 col-xs-12">
								<?php if( isset( $data['update_data'] ) ):?>
									<?php $id_empleado = $data['update_data'][0]['id_empleado']; ?>
								<?php elseif( isset( $data['user']['id_empleado'] ) ): ?>
									<?php $id_empleado = $data['user']['id_empleado']; ?>
								<?php endif; ?>

								<input type="hidden" name="id_consultor" value="<?= $id_empleado; ?>">
							</div>	
						</div>

						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="fuente">
								Fuente <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="fuente" id="fuente" value="<?= $form ? $form['fuente'] : ""; ?>" class="form-control col-md-7 col-xs-12">
									<option></option>
									<?php if( $data['fuentes'] ): ?>
										<?php foreach( $data['fuentes'] as $fuente ): ?>
											<?php
												$selected = "";

												if( isset( $form['fuente'] ) ){
													if( $form['fuente'] == $fuente )
														$selected = "selected";
												}
											?>
											<option value="<?= $fuente; ?>" <?= $selected; ?> > <?= $fuente ?> </option>
											
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
								
							</div>							
						</div>	
							
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="estatus">
								Estatus <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="estatus" id="estatus" class="form-control">
									<option></option>
									<?php if( $data['estatus'] ): ?>
										<?php foreach( $data['estatus'] as $item): ?>
											<?php
												if( $item['id_estatus'] == 3 && !isset( $data['update_data'] ) )
													continue;
												
												$selected = "";

												if( isset( $form['descripcion'] ) ){
													if( $form['id_estatus'] == $item['id_estatus'] )
														$selected = "selected";
												}
											?>										
											<option value="<?= $item['id_estatus']; ?>" <?= $selected; ?> > 
												<?= $item['descripcion']; ?>
											</option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>	
							</div>	
						</div>
						
						<?php if( isset($form['id_prospecto']) ): ?>
							
							<div class="row">
								<div class="col-md-2">
									<input type="hidden" name="token" value="<?= $form['id_prospecto']; ?>" class="form-control" />		
								</div>
							</div>
							
						<?php endif; ?>						
						<div class="ln_solid"></div>
						
						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
		                          <button type="submit" class="btn btn-success btn-submit">Guardar</button>
		                    </div>	
						</div>
					</form>

			    </div>
				</div>
		

	        </div>
    	</div>
	</div>
</div>
