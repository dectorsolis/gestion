
		<div class="container">
		
		<div class="row">
	
			<div class="col-md-6">

				<div class="row">

					<!-- ESTADOS -->
				    <div class="col-md-6">
					    <div class="panel panel-default">
							<div class="panel-heading">
							   	<h3 class="panel-title">Vista general</h3>
							</div>	

							<div class="table-responsive">
						    	<table class="lista table table-striped table-bordered">
						    		<tbody>
						    			<?php if( isset($data['total_clientes']) ): ?>
	    								<tr>
	    									<td>
	    										<span class="glyphicon glyphicon-folder-open"></span> 
	    										<a href=" <?= PATH . "clientes/status/activo/"; ?> "> Proyectos activos</a>
	    									</td>
	    									<td>
	    										<?php print_r($data['total_clientes'][0]['total']); ?>
	    									</td>
	    								</tr>
	    								<?php endif; ?>

						    			<?php if( isset($data['total_empleados']) ): ?>
	    								<tr>
	    									<td>
	    										<span class="glyphicon glyphicon-user"></span> 
	    										<a href=" <?= PATH . "empleados/status/activo/"; ?> ">Empleados activos</a>
	    									</td>
	    									<td>
	    										<?php print_r($data['total_empleados'][0]['total']); ?>
	    									</td>
	    								</tr>
	    								<?php endif; ?>    

						    			<?php if( isset($data['total_oficinas']) ): ?>
	    								<tr>
	    									<td>
	    										<span class="glyphicon glyphicon-map-marker"></span>
	    										<a href=" <?= PATH . "regiones/"; ?> ">Regiones</a>
	    									</td>
	    									<td>
	    										<?php print_r($data['total_oficinas'][0]['total']); ?>
	    									</td>
	    								</tr>
	    								<?php endif; ?>  

						    			<?php if( isset($data['total_deptos']) ): ?>
	    								<tr>
	    									<td>
	    										<span class="glyphicon glyphicon-book"></span>
	    										<a href=" <?= PATH . "departamentos/"; ?> ">Departamentos</a>
	    									</td>
	    									<td>
	    										<?php print_r($data['total_deptos'][0]['total']); ?>
	    									</td>
	    								</tr>
	    								<?php endif; ?>  	    								
    								
						    		</tbody>
						    	</table>
						    </div>

						</div>		    	
				    </div>
				    <!-- END ESTADOS -->


					<!-- ALERT CLIENTES RECIENTES -->
				    <div class="col-md-12">
					    <div class="panel panel-default">
							<div class="panel-heading">
							   	<h3 class="panel-title">Clientes recientes</h3>
							</div>	

							<div class="table-responsive">
						    	<table class="lista table table-striped table-bordered">
						    		<tbody>
							    	<?php if( isset($data['ultimos_clientes']) ): ?>
							    		<?php $recientes = $data['ultimos_clientes']; ?>
							    		<?php for($i = 0; $i<count($recientes); $i++): ?>
							    			<tr>
							    				<td><a href="<?= PATH . "clientes/" . $recientes[$i]['id_cliente']; ?>"> <?= $recientes[$i]['dominio']; ?> </a></td>
							    				<td><?= $recientes[$i]['fecha_ingreso']; ?></td>
							    				<td>
							    					<a href="<?= PATH . "accesos/" . $recientes[$i]['id_cliente']; ?>"><span class="glyphicon glyphicon-new-window"></span></a>
							    				</td>
							    			</tr>
							    		<?php endfor; ?>
							    	<?php endif; ?>		    			
						    		</tbody>
						    	</table>
						    </div>

						</div>		    	
				    </div>
				    <!-- END CLIENTES RECIENTES -->



				</div>
			</div>

			<div class="col-md-6">
				<div class="row">
		    
		    		<!-- EMPLEADOS RECIENTES -->
				    <div class="col-md-12">
					    <div class="panel panel-default">
							<div class="panel-heading">
							   	<h3 class="panel-title">Ingresos recientes de empleados</h3>
							</div>	

							<div class="table-responsive">
						    	<table class="lista table table-striped table-bordered">
						    		<tbody>
							    	<?php if( isset($data['ultimos_empleados']) ): ?>
							    		<?php $recientes = $data['ultimos_empleados']; ?>
							    		<?php for($i = 0; $i<count($recientes); $i++): ?>
							    			<tr>
							    				<td><a href="<?= PATH . "empleados/" . $recientes[$i]['id_empleado']; ?>"> <?= $recientes[$i]['nombre']; ?> </a></td>
							    				<td><?= $recientes[$i]['fecha_ingreso']; ?></td>
							    				<td><?= $recientes[$i]['depto']; ?></td>
							    			</tr>
							    		<?php endfor; ?>
							    	<?php endif; ?>		    			
						    		</tbody>
						    	</table>
						    </div>

						</div>		    	
				    </div>
				    <!-- FIN EMPLEADOS RECIENTES -->
				</div>
			</div>

		</div>

		</div>	
		