<?php $day = !empty( $data['fecha'] ) ? $data['fecha'] : date("Ymd") ?>			


			<div class="x_panel">
				<div class="x_title">
					<h2> <?= $data['titulo']?>  <?= get_fecha_esp($day) ?> </h2>
					<ul class="nav navbar-right panel_toolbox">
		                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						<li><a class="close-link"><i class="fa fa-close"></i></a></li>
		            </ul>	
					<div class="clearfix"></div>	            
				</div>
				
				<div class="x_content">	
						<div id="response-agenda"></div>

						<div id="todo-list">
							<?php $actividades_fin = 0; ?>
							<?php if( $data["mi_agenda"] != null ): ?>
								<?php if( property_exists( $data["mi_agenda"], $day ) ): ?>
									<?php foreach( $data["mi_agenda"]->$day as $i => $item): ?>
										<?php $actividades_fin = $item->estado ? $actividades_fin + 1 : $actividades_fin ?>
										<div class="row actividad">
											<div class="item-actividad col-md-11 <?= $item->estado ? 'actividad-terminada' : '' ; ?>">
												<input class="estado-actividad" type="checkbox" <?= $item->estado ? "checked" : ""; ?>>
												<?= $item->actividad; ?>
											</div>
											<a href="#" class="col-md-1 remove-item-agenda" title="Eliminar">
												<span class="fa fa-trash trash-agenda"></span>
											</a>		
										</div>
									<?php endforeach ?>								
								<?php endif; ?>
							<?php endif; ?>
							
						</div>
						
						<?php if( $actividades_fin > 0 ): ?>
							<?php $progreso = round( $actividades_fin * 100 / count($data["mi_agenda"]->$day), 2 ) ?>

							<div class="progress">
							  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?= $progreso ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $progreso ?>%"><span style="color:black;"><?= $progreso ?>% Completado</span></div>
							</div>								
							<!-- Fin mi agenda del dia -->	
						<?php endif; ?>
						
						<p>
							<textarea id="actividad"  rows="5" class="form-control" placeholder="Agrega una actividad o ingresa una lista separada por comas Ej. (Mi tarea1, Mi tarea 2)"></textarea>
						</p>
						<p>
							<button type="button" id="add-actividad" class="btn btn-primary">Agregar</button>							
							<button 
								style="display:none;" 
								type="submit" 
								id="save-todo-list" 
								data-action="<?= PATH . 'usuarios/mi-agenda/' . $day ?>" 
								data-redirect="<?= $_SERVER['REQUEST_URI'] ?>"
								data-id-loader="#response-agenda" class="btn btn-success">Guardar</button>						
						</p>

						<!-- Acciones todo list -->

						<div class="row">
							<div class="col-md-12">
								<input 
									type="text" 
									autocomplete="off"
									id="fecha-tarea" 
									class="form-control fecha" 
									placeholder="Seleccionar fecha del calendario">
							</div>
							<hr>
							<div class="col-md-12">
								<select id="historial-tarea" class="form-control">
								<?php foreach( $data['mi_agenda'] as $index => $value ): ?>
									<option value="<?= $index ?>"><?= get_fecha_esp($index) ?></option>
								<?php endforeach; ?>
								</select>								
							</div>	

							<div class="col-md-3">
								<br>
								<a
									href="#"
									data-href="<?= PATH . 'agendas' ?>"
									class="filtrar-tarea btn btn-warning" >Filtrar</a>
							</div>								
						</div>						
				</div>
			</div>