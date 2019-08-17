<?php
	$responsable = [];

	if( $data['info_responsable'] )
		$responsable = $data['info_responsable'];
?>

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

			    <div id="response-responsable">
			        
			    </div>

				<div class="ajax-request">
					<form
						method = "POST"
						action = "<?= $data["action_form"] ?>"
						class="form-ajax form-horizontal form-label-left"
						data-id-loader = "#response-responsable"
						data-id-response = "response-responsable"
						data-response-method = "html">
						<input type="hidden" name="type" value="update_responsable_contenido">
			       
						<p>
							<label for="responsable">
								Nombre responsable
							</label>
							<input 
								type="text" 
								name="responsable" 
								class="form-control"
								value="<?= $responsable ? $responsable->responsable: ''; ?>">
						</p>
						
						<p>
							<label for="responsable">
								Persona de contacto
							</label>
							<input 
								type="text" 
								name="contacto" 
								class="form-control"
								value="<?= $responsable ? $responsable->contacto: ''; ?>">
						</p>
						
						<p>
							<label for="responsable">
								Email personal
							</label>
							<input 
								type="text" 
								name="email" 
								class="form-control"
								value="<?= $responsable ? $responsable->email: ''; ?>">
						</p>
						<p>
							<button type="submit" class="btn btn-submit btn-primary">Actualizar</button>
						</p>
					</form>
					
				</div>

			</div>
		</div>
	</div>
						