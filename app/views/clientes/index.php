	<div class="row">

		<div class="col-md-12 col-sm-6 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><?= $data['titulo'] ?></h2>
			        <div class="clearfix"></div>							
				</div>

				<div class="x_content">
					<div class="row">
					    <div class="col-md-8">
					    	
						    <a href="<?= PATH . "clientes/nuevo/" ?>">
						    	 Agregar nuevo cliente 
						    </a>				    	
						    |	
						    <a href="<?= PATH . "clientes/status/activo/"; ?>">		Activos 	(<?= $data['activos'][0]['total']; ?>) </a> | 
					        <a href="<?= PATH . "clientes/status/inactivo/"; ?>">	Inactivos 	(<?= $data['inactivos'][0]['total']; ?>) </a>				    	
					    </div>

					    <div class="col-md-4">
					    	<?php if(isset($data['regiones'])): ?>
					    	<form style="float:right;" method="POST" action="<?= PATH . "clientes/"; ?>">
					    		<div class="input-group">
						    		<select name="filtro_regiones" class="form-input form-control">
						    			<option>Todas las regiones</option>
						    			<?php $regiones = $data['regiones']; ?>
						    			<?php for($i = 0; $i < count($regiones); $i++): ?>
						    			<option value="<?= $regiones[$i]['id']; ?>"> <?= $regiones[$i]['nombre']; ?> </option>
						    			<?php endfor; ?>

						    		</select>
						    		<span class="input-group-btn">
						    			<button type="submit" class="btn btn-primary">Filtrar</button>
						    		</span>
					    		</div>
					    	</form>
					    	<?php endif; ?>
					    </div>

					</div>					
			    	<div class="table-responsive">
				    	<?php require_once INCLUDES . "alerts.php"; ?>
				        <table id="tabla-clientes" class="table table-hover">
				            <thead>
				                <tr>
				                    <th></th>
				                    <th>ID</th>
				                    <th>Dominio</th>
				                    <th></th>
				                    <th></th>
				                    <?php if($_SERVER['REQUEST_URI'] === PATH . "clientes/status/inactivo/"):?>
				                    <th></th>
				                	<?php endif; ?>
				                    <th>Región</th>
				                    <th>Creación del dominio</th>
				                    <th>Fecha ingreso</th>
				                </tr>
				            </thead>
				            <tfoot>
				                <tr>
				                    <th></th>
				                    <th>ID</th>
				                    <th>Dominio</th>
				                    <th></th>
				                    <th></th>
				                    <?php if($_SERVER['REQUEST_URI'] === PATH . "clientes/status/inactivo/"):?>
				                    <th></th>
				                	<?php endif; ?>
				                    <th>Región</th>
				                    <th>Creación del dominio</th>
				                    <th>Fecha ingreso</th>
				                </tr>
				            </tfoot>			            
				            <tbody id="cuerpo-listado">
				            
				            <?php if(isset($data['cliente'])): ?>
								
								<?php $clientes = $data['cliente']; ?>			            		            	
				            				            	
				            	<?php for($i = 0; $i < count($clientes); $i++): ?>
				            	<tr>
				            		<td>
				            			<?= $i+1; ?>
				            		</td>
									<td><?= $clientes[$i]['id_cliente'] ?></td>
									<td>
				            			<a href=" <?= PATH . "clientes/ficha/" . $clientes[$i]['id_cliente']; ?> ">
										<?= $clientes[$i]['dominio']; ?>		
										</a>									
									</td>
									<!-- edit button -->
									<td>
								        <a href="<?= PATH . "clientes/editar/" . $clientes[$i]['id_cliente']; ?>" type="button" class="btn btn-success btn-sm">
								          <span class="glyphicon glyphicon-edit"></span>
								        </a>

									</td>
									<!-- end edit button -->

									<!-- turn off button -->
									<td>
										<form class="cambiar-status" method="POST" action="<?= PATH . "clientes/cambiar-status/"; ?>">
											<input type="hidden" name="cliente" value="<?= $clientes[$i]['id_cliente']; ?>"/>
											<button class="btn btn-warning btn-sm" type="submit">
												<span class="glyphicon glyphicon-off"></span> 		
											</button>
										</form>
									</td>
									<!-- end turn off button ->

									<!--ELIMINAR -->
									
									<?php if($_SERVER['REQUEST_URI'] === PATH . "clientes/status/inactivo/"):?>
									<td>
										<form class="eliminar-registro" method="POST" action="<?= PATH . "clientes/eliminar/"; ?>">
											<input type="hidden" name="cliente" value="<?= $clientes[$i]['id_cliente']; ?>"/>
											<button type="submit" class="btn btn-danger btn-sm	" >
												<span class="glyphicon glyphicon-trash"></span>
											</button>
										</form>									
	        						</td>
									<?php endif; ?>
									
									<!-- ELIMINAR -->
									<td><?= $clientes[$i]['region']; ?></td>
				            		<td> <?= $clientes[$i]['creacion_dominio']; ?> </td>
				            		<td> <?= $clientes[$i]['fecha_ingreso']; ?> </td>
				            	</tr>
				            	<?php endfor; ?>
				            <?php endif; ?>
				            </tbody>
				        
				        </table>  
			    	</div>					
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
	   	jq(document).ready(function() {
	       	jq("#tabla-clientes").DataTable();
	    });
	</script>	