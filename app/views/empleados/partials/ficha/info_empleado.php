
	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> <?= $data['titulo']?> </h2>
					<ul class="nav navbar-right panel_toolbox">
		                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
		            </ul>	
					<div class="clearfix"></div>	            
				</div>
				
				<div class="x_content">	
			        <h2>
			        	<?php $empleado = $data['info']; ?>
						<?= 
							$empleado['nombre'] 	. " " . 
							$empleado['ap_paterno'] . " " .  
							$empleado['ap_materno']; 
						?>
						<a href="<?=  PATH . "empleados/editar/" . $empleado['id_empleado'] ; ?>"><span class="glyphicon glyphicon-edit"></span></a>
				    </h2>
				    <p><strong>Fecha de ingreso:</strong> <?= $empleado['fecha_ingreso']; ?></p>
				    <p><strong>Nacimiento:</strong> <?= $empleado['fecha_nac']; ?></p>
				    <p><strong>Teléfono:</strong> <?= $empleado['telefono']; ?></p>
				    <p><strong>Direcciones de correo:</strong> 
				   	<p><?= $empleado['email_empresa']; ?></p>
			    	<p><strong>Skype:</strong> <?= $empleado['usuario_skype']; ?></p>			    
			    	<p><strong>Departamento:</strong> <?= $empleado['depto']; ?></p>						
				</div>
			</div>
		</div>
	</div>

		    