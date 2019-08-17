		
		<?php $prospecto = $data['datos']; ?>

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
				<table class="info">
					<tr>
						<td>Fecha contacto</td>
						<td><?= $prospecto['fecha_contacto']; ?></td>
					</tr>
					<tr>
						<td>Persona de contacto</td>
						<td><?= $prospecto['nombre_contacto']; ?></td>
					</tr>
					<tr>
						<td>Fuente</td>
						<td><?= $prospecto['fuente']; ?></td>
					</tr>
				</table>				
			</div>
		</div>