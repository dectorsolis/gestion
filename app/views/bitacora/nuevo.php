<?php require_once INCLUDES . "header.php"; ?>
<?php require_once INCLUDES . "response.php"; ?>

		<div class="container">
			<div class="panel panel-default">
			
				<div class="panel-heading">
			    	<h3 class="panel-title">Nuevo reporte</h3>
			  	</div>	
			  	
			  	<div class="row">
			  		<div class="col-md-12">
			  			<p><?php require_once INCLUDES . "alerts.php"; ?></p>
			  		</div>
			  	</div>

                <div class="row">
                    <div class="col-md-12">
                        <form name="nuevo-cambio" method="post" action="<?= $data['action']; ?>">
                            <table id="tabla-sitios" class="tablesorter table table-bordered table-hover table-striped tablesorter-bootstrap">
                                <thead>
                                    <tr role="row">
                                        <th width="150"><label class="control-label">Comentario de</label></th>
                                        <th width="150"><label class="control-label">Sitio</label></th>
                                        <th width="100"><label class="control-label">Fecha</label></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td width="150">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="idempleado" placeholder="Ingresar id de empleado"/>
                                            </div>
                                        </td>
                                        <td width="150">
                                            <div class="form-group">
												<input type="text" class="form-control" name="sitio" placeholder="nombre del sitio" readonly/>
                                            </div>
                                        </td>
                                        <td width="150">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input name="fecha" type="text" id="fecha_contacto" class="fecha form-control"/>
                                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="form-group">
                                                <label>Comentarios:</label>
                                                <textarea name="comentario" class="form-control" rows="5"></textarea>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" name="agregar" class="btn btn-default">Agregar</button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

                <pre><?php print_r($data);?></pre>		

			</div>
		</div>
<?php require_once INCLUDES . "footer.php"; ?>