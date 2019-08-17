		<!-- Añadir keywords -->
			<div class="col-md-5">
				<div class="x_panel">
					<div class="x_title">
						<h4 class="float-left">Agregar keywords</h4>
						<ul class="nav navbar-right panel_toolbox">
			                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
			            </ul>	
						<div class="clearfix"></div>	            
					</div>
					
					<div class="x_content">
						<!--form agregar keywords -->
						<div class="ajax-request">
							<form
								id = "agregar-keywords"
								method = "POST"
								action = "<?= $data['action_form_keywords'] ?>"
								class = "form-ajax"
								data-id-response = "response-keywords"
								data-id-loader = "#response-keywords"
								data-id = "#agregar-keywords" 
								data-response-method = "html">

								<input type="hidden" name="type" value="update_keywords">
								<div class="row">
									<p class="col-md-8 col-xs-12">
										<label for="keyword">Keyword</label>
										<input type="text" name="keyword" class="form-control col-md-8">
									</p>
									<p class="col-md-4 col-xs-12">
										<label for="keyword">Resultados</label>
										<input type="text" name="busquedas" class="form-control col-md-4">
									</p>
								</div>
								<div class="row">
									<p class="col-md-8">
										<button type="submit" class="btn btn-submit btn-success">Agregar</button>
									</p>
								</div>
							</form>	
						</div>
						<!-- end form agregar keywords -->					
					</div>
				</div>			
			</div>		
			<div class="col-md-7">
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
						<div id="response-keywords" class="ajax-request">
						<?php 
							
							view_partial( 
								"clientes/partials/ficha/lista_keywords", 
								array( 
									'keywords' => json_decode( str_replace("\\","", $data['keywords'] ) ), 
									'action' => $data['action_form_keywords'] )); 
						?>							
						</div>						
					</div>
				</div>			
			</div>			
		

		<!-- Fin añadir keywords -->