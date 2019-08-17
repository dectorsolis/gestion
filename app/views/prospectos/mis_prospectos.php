
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> <?= $data['titulo'] ?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
            </div>

			<div class="x_content">
				<div class="row">
					<div class="col-md-6">
						<a href="<?= PATH . "prospectos/nuevo/" ?>">Agregar nuevo prospecto </a>			
					</div>
				</div>

		
				<?php require_once INCLUDES . "alerts.php"; ?>
				<div class="table-responsive">
					<table id="prospectos" class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Empresa</th>
								<th>Dominio</th>
								<th>Contacto</th>
								<?php if($data['type'] != 'edit'):?>
								<th>Consultor</th>
								<?php endif; ?>
								<th>Fuente</th>
								<th>Estatus</th>
								<?php if($data['type'] == 'edit'):?>
								<th></th>
								<th></th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
						<?php if( $data['prospectos'] ): ?>
										                    
							<?php foreach( $data['prospectos'] as $index => $item): ?>
								<tr>
									<td> <?= $index + 1; ?> </td>
									<td> <?= $item['nombre_empresa']; ?> </td>	                            
									<td> <?= $item['dominio']; ?> </td>
								
									<td> <?= $item['nombre_contacto']; ?> </td>
									<?php if($data['type'] != 'edit'):?>
									<td> 
										<a href="<?= PATH . "empleados/" . $item['id_empleado']; ?>">
											<?= $item['nombre']; ?> 
										</a>
									</td>
									<?php endif; ?>
									<td> <?= $item['fuente']; ?> </td>
									 <td> 
										<small class="estado estado-<?= $item['id_estatus']; ?>">
											<?= $item['descripcion']; ?>
										</small>
									</td>

									<?php if($data['type'] == 'edit'):?>
									<td>
										<a href="<?= PATH . "prospectos/editar/" . $item['id_prospecto']; ?>" type="button" class="">
											<span class="label label-success">Editar</span>
										</a>
									</td>	
									<td>
										<a href="<?= PATH . "prospectos/eliminar/" . $item['id_prospecto']; ?>" type="button" class="">
											<span class="label label-danger">Eliminar</span>
										</a>
									</td>				
									<?php endif; ?>	  


								</tr>
							<?php endforeach; ?>
										               		
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
	    jq("#prospectos").DataTable();
	} );
</script>	
