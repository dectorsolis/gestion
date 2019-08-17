				
		<div class="row">
			<div class="col-md-12 col-sm-6 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><?= $data['titulo'] ?></h2>
			            <div class="clearfix"></div>							
					</div>

					<div class="x_content">
						<div class="row">
							<p>
								<div class="col-md-12">
								    	
									 	<a href="<?= PATH . "empleados/nuevo/"; ?>">
									  		Agregar nuevo
									  	</a>	
									  	|	    	
								    	<?php if(isset($data['activos'])):?>
								    		<a href="<?= PATH . "empleados/status/activo/" ?>"> 
								    			Activos (<?= $data['activos'][0]['total']; ?>)
								    		</a> 
								    	<?php endif; ?>
								    	| 
								    	<?php if(isset($data['inactivos'])):?>
								    		<a href="<?= PATH . "empleados/status/inactivo/" ?>"> 
								    			Inactivos (<?= $data['inactivos'][0]['total']; ?>)
								    		</a> 
								    	<?php endif; ?>
								    	
								</div>
							</p>
						</div>	
						<br>
						<div class="row">
							<div class="col-md-3">
					    		<form class="filtros" action="<?= $data['action_filtros'] ?>" method="POST">
								<?php if( isset($data['departamento']) ): ?>
									<div class="input-group">
									   	<select name="filtro_departamento" class="form-input form-control">
									   		<option >Filtrar departamentos </option>
									   		<?php $departamento = $data['departamento']; ?>
									   		<?php for($i = 0; $i < count($departamento); $i++ ):?>
									   		
									   		<option value="<?= $departamento[$i]['id']; ?>" > 
									   			<?= $departamento[$i]['nombre']; ?> 
									   		</option>
									   		
									   		<?php endfor;?>
									    		
									   	</select>
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit">Filtrar</button>
										</span>		

									</div>
							</div>
						
							<div class="col-md-3">
								   <?php endif; ?>

							    	<?php if( isset($data['regiones']) ): ?>
							    	
							    	<div class="input-group">
									    <select name="filtro_region" class="form-input form-control">
											
											<option >Filtrar oficinas </option>
										    <?php $regiones = $data['regiones']; ?>
										    <?php for($i = 0; $i < count($regiones); $i++ ):?>

										    <option value="<?= $regiones[$i]['id']; ?>" > 
										    	<?= $regiones[$i]['nombre']; ?> 
										    </option>

										    <?php endfor;?>
										    	
										</select>
										<span class="input-group-btn">
											<button class="btn btn-primary" type="submit">Filtrar</button>
										</span>
									</div>
							    	<?php endif; ?>
								</form>
							</div>
						</div>
				  		<?php require_once INCLUDES . "alerts.php"; ?>
				  		<?php if ( $data['valido']  ): ?>
				  		<div class="row acciones">
				  			<div class="col-md-6" >
				  				<button 
				  					id="baja-empleados" 
				  					class="btn btn-warning" 
				  					data-url-action="<?= PATH . 'empleados/cambiar_status/lotes/' ?>">
				  					Baja a empleados
				  				</button>
				  			</div>
				  		</div>
				  		<?php endif; ?>

				  		<br>
				    	<table id="example" class="table table-hover">
							<thead>
								<?php if ( $data['valido']  ): ?>
							    <tr>
							    	<th></th>
							        <th>#</th>
							        <th>Nombre</th>
							        <th>Editar</th>
							        <th>Baja</th>
							        <th>Usuario</th>
							        <th>Vincular</th>
							        <th>Oficina</th>
							        <th>Depto.</th>
							        <th>Ingreso</th>
							        <th>email</th>
							    </tr>
								<?php else: ?>
							    	<th></th>
							        <th>#</th>
							        <th>Nombre</th>
							        <th>Editar</th>
							        <th>Restaurar</th>
							        <th>Eliminar</th>
							        <th>Vincular</th>
							        <th>Oficina</th>
							        <th>Depto.</th>
							        <th>Ingreso</th>
							        <th>email</th>								
								<?php endif; ?>
							</thead>							
				  		    <tbody>
				  		   	<?php if( isset($data['empleado']) ): ?>
				  		   		<?php $empleado = $data['empleado']; ?>
								<?php for($i = 0; $i < count($empleado); $i++):?>	                
								<tr>
									<td>
										<input class="delete-empleados" type="checkbox" name="delete_empleados[]" value="<?= $empleado[$i]['id_empleado'] ?>">
									</td>
									<td><?= $i + 1; ?></td>
									<td>
										<a href="<?= PATH . "empleados/ficha/" . $empleado[$i]['id_empleado']; ?>/" >
											<img src="<?= gravatar($empleado[$i]['email_empresa'], 40) ?>">
											<?= $empleado[$i]['nombre'] . " " .$empleado[$i]['ap_paterno'] . " " . $empleado[$i]['ap_materno'];  ?>
										</a>
									</td>

									<!--EDITAR INFO EMPLEADO -->
									<td>
								        <a title="editar" href="<?= PATH . "empleados/editar/" . $empleado[$i]['id_empleado']; ?>" type="button" class="btn btn-success btn-sm">
								          <span class="glyphicon glyphicon-edit"></span>
								        </a>
									</td>
									<!--FIN EDITAR INFO EMPLEADO -->


									<!--CAMBIAR STATUS DE EMPLEADO -->
									<td>
								        <form 
								        	class="cambiar-status" 
								        	method="POST" 
								        	action="<?= PATH . "empleados/cambiar-status/"; ?>" 
								        	data-submit-msg="¿Estás seguro? Al dar de baja se eliminará todo el historial del empleado">
								        	
								        	<input type="hidden" name="id_empleado" value="<?= $empleado[$i]['id_empleado']; ?>">
									        <button title="cambiar estatus" class="btn btn-warning btn-sm">
									      	 	<span class="glyphicon glyphicon-off"></span> 
									        </button>
								        </form>
									</td>
									<!--FIN CAMBIAR STATUS DE EMPLEADO -->
								

									<?php if ( !$data['valido']  ): ?>
									<!--ELIMINAR EMPLEADO -->
									<td>
										<form 
											class="cambiar-status" 
											method="POST" 
											action="<?= PATH . "empleados/eliminar/"; ?>"
											data-submit-msg="¿Estás seguro de eliminar el registro? se eliminará para siempre cualquier historial">
											<input type="hidden" name="id_empleado" value="<?= $empleado[$i]['id_empleado'] ?>">
											<button title="Eliminar empleado" type="submit" class="btn btn-danger btn-sm">
												<span class="glyphicon glyphicon-trash"></span>
											</button>
										</form>
									</td>
									<?php endif; ?>
									<!-- FIN ELIMINAR EMPLEADO -->
									
									<?php if ( $data['valido']  ): ?>
										<?php if( !$empleado[$i]['usuario_activo'] ): ?>
										<!--INICIO CREACION DE USUARIOS -->
										<td>
											<form method="POST" action="<?= $data['action_create_user']; ?>" >
												<input type="hidden" id="token" name="token" value="<?= base64_encode($empleado[$i]['id_empleado']); ?>"/>
												<button title="Crear usuario" type="submit" class="btn btn-primary btn-sm">
													<span class="glyphicon glyphicon-user"></span>
													Crear
												</button>
											</form>
										</td>
										<?php else: ?>
										<td><span class="label label-success">Activo</span></td>
										<?php endif; ?>
									<?php endif; ?>
									<!-- FIN CREACION DE USUARIOS -->

									<!-- INICIO VINCULACION -->
									<td>
										<form 
											method="POST"
											action="<?= $data['action-vinculacion'] ?>" 
											data-submit-msg="<?= $data['msg-vinculacion'] ?>" 
											class="cambiar-status">
											<input type="hidden" name="id_empleado" value="<?= $empleado[$i]['id_empleado'] ?>">
											<button type="submit" class="btn-default btn-sm" title="Vincular con todos los proyectos"><span class="fa fa-link"></span></button>
										</form>
									</td>
									<!-- FIN VINCULACION -->
									<td><?= $empleado[$i]['nombre_region']; ?></td>
									<td><?= $empleado[$i]['departamento']; ?></td>
									<td><?= $empleado[$i]['fecha_ingreso']; ?></td>	
									<td><?= $empleado[$i]['email_empresa']; ?></td>								
																	
								</tr>
								<?php endfor; ?>
							<?php endif; ?>
					        </tbody>


						</table>
		                <script type="text/javascript">
		                    jq(document).ready(function() {
		                    jq("#example").DataTable();
		                } );
		                </script>
					</div>
				</div>
			</div>
		</div>	