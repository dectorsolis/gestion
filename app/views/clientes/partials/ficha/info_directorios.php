<?php
	$directorios = [];

	if( $data['directorios'] )
		$directorios = $data['directorios'];
?>

	<div class="col-md-6">
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
				<div id="response-directorios"></div>
				<div class="ajax-request">
					<form 
						action = "<?=  $data['action_form'] ?>"
						method = "POST"
						class = "form-ajax form-horizontal form-label-left"
						data-response-method = "html"
						data-id-loader = "#response-directorios"
						data-id-response = "response-directorios"
						>
						<input type="hidden" name="type" value="update_directorios"/>
				        <div class="form-group">
	                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="contacto">
	                            Nombre de contacto
	                        </label>
	                        <div class="col-md-10 col-sm-10 col-xs-12">
	                            <input type="text" name="contacto" class="form-control" value="<?= $directorios ?  $directorios->contacto : '' ;?>">
	                        </div>
				        </div>	

				        <div class="form-group">
	                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="telefonos">
	                            Teléfonos
	                        </label>
	                        <div class="col-md-10 col-sm-10 col-xs-12">
	                            <input type="text" name="telefonos" class="form-control" value="<?= $directorios ?  $directorios->telefonos : '' ;?>">
	                        </div>
				        </div>

				        <div class="form-group">
	                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="direccion">
	                            Dirección
	                        </label>
	                        <div class="col-md-10 col-sm-10 col-xs-12">
	                            <input type="text" name="direccion" class="form-control" value="<?= $directorios ?  $directorios->direccion : '' ;?>">
	                        </div>
				        </div>

				        <div class="form-group">
	                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="descuento">
	                            Descuento
	                        </label>
	                        <div class="col-md-10 col-sm-10 col-xs-12">
	                            <input type="text" name="descuento" class="form-control" value="<?= $directorios ?  $directorios->descuento : '' ;?>">
	                        </div>
				        </div>

				        <div class="form-group">
	                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="descripcion_corta">
	                            Descripción corta ( Mínimo 150 palabras )
	                        </label>
	                        <div class="col-md-10 col-sm-10 col-xs-12">
	                            <textarea rows="4" name="descripcion_corta" class="form-control" ><?= $directorios ?  $directorios->descripcion_corta : '' ; ?> </textarea>    
	                        </div>
				        </div>


				        <div class="form-group">
	                        <label class="control-label col-md-2 col-sm-2 col-xs-12" for="descripcion_larga">
	                            Descripción larga ( Mínimo 250 palabras )
	                        </label>
	                        <div class="col-md-10 col-sm-10 col-xs-12">
	                            <textarea rows="4" name="descripcion_larga" class="form-control" ><?= $directorios ?  $directorios->descripcion_larga : '' ; ?></textarea>    
	                        </div>
				        </div>	
				      	<div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2">
			                <button type="submit" class="btn btn-submit btn-primary">Guardar</button>
			           </div>
					</form>
				</div>
			</div>
		</div>
	</div>