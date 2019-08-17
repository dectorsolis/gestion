<?php 
	$datos_varios = [];
	if( $data["productos_servicios"] )
		$datos_varios = $data["productos_servicios"];
?>

	<div class="col-md-6">
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
				
			    <div id="response-servicios">
			        
			    </div>
			    <div class="ajax-request">
			        <form 
			        method="POST" 
			        action="<?= $data["action_form_servicios"] ?>" 
			        class="form-ajax form-horizontal form-label-left"
			        data-id-loader="#response-servicios"
			        data-id-response="response-servicios"
			        data-response-method ="html">
			        	
			        <input type="hidden" name="type" value="update_datos_varios"/>
			        <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="servicios">
                            Productos y/o Servicios
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea rows="4" name="servicios" class="form-control" ><?=  $datos_varios ? $datos_varios->servicios : '' ;?></textarea>    
                        </div>
			        </div>
			        
			        <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="slogan">
                            Slogan
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea rows="2" name="slogan" class="form-control" ><?=  $datos_varios ? $datos_varios->slogan : '' ;?></textarea>    
                        </div>
			        </div>
			        
			        <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="mision">
                            Misión
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea rows="2" name="mision" class="form-control" ><?=  $datos_varios ? $datos_varios->mision : '' ;?></textarea>    
                        </div>
			        </div>
			        
			        <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="vision">
                            Visión
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea rows="2" name="vision" class="form-control" ><?=  $datos_varios ? $datos_varios->vision : '' ;?></textarea>    
                        </div>
			        </div>
			        
			        <div class="form-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="objetivos">
                            Objetivos
                        </label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <textarea rows="2" name="objetivos" class="form-control" ><?=  $datos_varios ? $datos_varios->objetivos : '' ;?></textarea>    
                        </div>
			        </div>	
					<div class="form-group">
						<div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
			                <button type="submit" class="btn btn-submit btn-primary">Guardar</button>
			           </div>	
					</div>			        
			    </form>
			    </div>
			</div>
		</div>
	</div>