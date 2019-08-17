<div class="container">

		<div class="row">
			<p>
				<div class="col-md-12">
				    	
					<a href="<?= PATH . "empleados/nuevo/"; ?>">
						Agregar nuevo
					</a>	
				</div>
			</p>
		</div>
		<br>
		<div class="row">
		    <div class="col-md-6">
				  		<?php require_once INCLUDES . "alerts.php"; ?>
				    	<table id="example" class="ticket table table-striped table-bordered">
							<thead>
							    <tr>
							        <th>#</th>
							        <th>Nombre</th>							    
							        <th>Privilegios</th>							    
							        <th>Menú</th>							    
							    </tr>
							</thead>
							<tfoot>
							    <tr>
							        <th>#</th>
							        <th>Nombre</th>							    
							        <th>Privilegios</th>							    
							        <th>Menú</th>		
							    </tr>
							</tfoot>							
				  		    <tbody>
				  		   	<?php if( isset($data['roles']) ): ?>
				  		   		<?php $roles = $data['roles']; ?>
								<?php for($i = 0; $i < count($roles); $i++):?>	                
								<tr>
									<td><?= $i + 1; ?></td>
									<td><?= $roles[$i]['descripcion']; ?></td>
									<td>
										<a href="<?= PATH . 'roles/privilegios/' . $roles[$i]['id_rol']; ?>">Editar</a>
									</td>									
									<td>
										<a href="">Editar</a>
									</td>
								</tr>
								<?php endfor; ?>
							<?php endif; ?>
					        </tbody>


						</table>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                    jQuery("#example").DataTable();
                } );
                </script>
			</div>
		</div>	
	
      
</div>
