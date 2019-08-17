<?php require_once INCLUDES . "header.php"; ?>
<?php require_once INCLUDES . "response.php"; ?>

		<div class="container">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php if( $data['cambios'] ): ?>
					<h3 class="panel-title"><?= $data['cambios'][0]['dominio']; ?></h3>
					<?php endif; ?>
			  	</div>	
			  	<br>

			  	<div class="row">
			  		<div class="col-md-12">
						<a href=" <?= PATH . "bitacoras/nuevo/" . $data['id_cliente']; ?> " class="btn btn-primary btn-sm">
						   <span class="glyphicon glyphicon-plus"></span> Agregar cambio
						</a>
			  		</div>
			  	</div>
			  	<br>

	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
	                    	<?php for($i = 0; $i < count($data['cambios']); $i++): ?>
						        <table id="tabla-sitios" class="lista table tablesorter table table-bordered table-hover table-striped tablesorter-bootstrap">
						            <thead>
						                <tr role="row">
						                    <th width="150"><label class="control-label">Emitido por</label></th>
						                    <th width="100"><label class="control-label">Fecha</label></th>
						                </tr>
						            </thead>
						            <tbody>
						                <tr>
						                    <td>
						                        <div><?= $data['cambios'][$i]['nombre']. " " . $data['cambios'][$i]['ap_paterno']; ?></div>
						                    </td>
						                    <td>
						                        <div><?= $data['cambios'][$i]['fecha']; ?></div>
						                    </td>
						                </tr>
						                <tr>
						                    <td colspan="5">
						                        <div class="form-group">
						                            <label>Mensaje:</label>
						                            <textarea class="form-control" rows="5" readonly="readonly"><?= $data['cambios'][$i]['mensaje']; ?></textarea>
						                        </div>
						                    </td>
						                </tr>
						            </tbody>
								</table>
							<?php endfor; ?>
	                    </div>
	                </div>
	            </div>
				
				<pre><?php print_r($data);?></pre>
				
			</div>	

		</div>
<?php require_once INCLUDES . "footer.php"; ?>