<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Nuevo ticket: <?= $data['titulo'] ?></h2>
				<div class="clearfix"></div>	            
			</div>
			
			<div class="x_content">
			
			<div class="col-md-12 col-sm-12 col-xs-12">
				<?php require_once INCLUDES . "alerts.php"; ?>		
				<form method="POST" action="<?=  isset( $data['action'] ) ?  $data['action'] : '' ;  ?>" enctype="multipart/form-data" class="op-form form-horizontal form-label-left">

					<div class="form-group">
						
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombre">
								Asunto de la solicitud <span class="required">*</span>
							</label>
							
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input 
								type="text" 
								name="asunto" 
								id="asunto"
								class="form-control col-md-7 col-xs-12"
								value="<?= $form ? $form['asunto'] : ""; ?>"
								maxlength="70" />
							</div>
					</div>
					
					
					<div class="form-group">
						
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="departamento">
								Destinatario <span class="required">*</span>
							</label>
							
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="destinatario" id="destinatario" class="form-control">
									<option></option>
									<?php if( $data['integrantes'] ): ?>
										<?php $integ = $data['integrantes']; ?>
										<?php foreach( $integ as $item): ?>
											<optgroup label="<?= $item['departamento'] ?>">
												<option value="<?= $item['id_empleado']; ?>"> 
													<?= $item['nombre']; ?> 
												</option>
											</optgroup>
										<?php endforeach; ?>

									<?php endif;?>								
								</select>
							</div>
					</div>
					

					<div class="form-group">
						
							<label  class="control-label col-md-3 col-sm-3 col-xs-12" for="prioridad">
								Importancia de la solicitud <span class="required">*</span>
							</label>
							
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select name="prioridad" id="prioridad" class="form-control">
									<option value="BAJA">BAJA</option>
									<option value="MEDIA">MEDIA</option>
									<option value="ALTA">ALTA</option>
								</select>
							</div>
					</div>		
					

					<div class="form-group">
						<script>
					    	jq(document).ready(function() {
					        	jq('#descripcion').summernote({
					        		height: 220
					        	});
					    	});
					  	</script>						
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="mensaje">
							Descripción de la solicitud <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<textarea name="descripcion" id="descripcion" class="form-control" rows="7"><?= $form ? $form['descripcion'] : ""; ?></textarea>
						</div>
					</div>			
					
					<div class="form-group">
						
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="evidencia">
							¿Deseas adjuntar una imagen de evidencia?
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="file" name="evidencia[]" id="evidencia">
						</div>
					</div>	
										
					<div class="form-group">
						<div class="col-md-10">
						<?php if(isset($_SESSION['op_user_session'])): ?>
							<input 
								type="hidden" 
								name="token" 
								value="<?= base64_encode( $_SESSION['op_user_session'][0]['id_empleado'] ); ?>">
						<?php endif;?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
							<input type="hidden" name="cliente" value="<?= $data['id_cliente'] ?>" />
	                        <button type="submit" class="btn btn-success btn-submit">Enviar ticket</button>
	                    </div>	
					</div>

				</form>
			</div>
			</div>
		</div>
	</div>
</div>



