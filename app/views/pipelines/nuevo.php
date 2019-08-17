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
				<?php require_once INCLUDES . "alerts.php"; ?>	
				<form action="<?= $data["action"] ?>" method="POST">
					<p>
						<select name="seccion" id="seccion" class="form-control">
							<option>Elige la sección</option>
						<?php if($data['secciones']): ?>
							<?php foreach( $data['secciones'] as $item): ?>
								<option value="<?= $item['id_seccion'] ?>"><?= $item['descripcion'] ?></option>
							<?php endforeach; ?>
						<?php endif; ?>
						</select>
					</p>
					<p>
						<label>Nombre del pipeline</label>
						<input 
							type="text" 
							name="nombre" 
							class="form-control" 
							value="<?= isset($data["pipeline"]) ? $data['pipeline']->nombre : '' ; ?>">
					</p>
					<p>
						<label>Número de fases del pipeline</label>
						<input 
							type="number" 
							name="no_fases" 
							min="1" 
							max="10" 
							class="form-control"
							value="<?= isset($data["pipeline"]) ? $data['pipeline']->no_fases : '' ; ?>">
					</p>

					<p>
					<?php if( isset($data["pipeline"]) ): ?>
						
						<?php if( $data["pipeline"]->json_fases ): ?>
							
							<?php $json_fases = json_decode( str_replace("\\", "", $data["pipeline"]->json_fases) ); ?>
							
							<?php for( $i = 0; $i < count( $json_fases ); $i++ ): ?>
								<label>Fase #<?= $i + 1?></label>
								<input 
									type="text" 
									name="fases[]" 
									id="" 
									class="form-control" 
									placeholder="Introduce el nombre de la fase"
									value="<?= $json_fases[$i] ?>"><br>
							<?php endfor; ?>

						<?php else: ?>

							<?php for( $i = 0; $i < $data["pipeline"]->no_fases; $i++ ): ?>
								<label>Fase #<?= $i + 1 ?></label>
								<input 
									type="text" 
									name="fases[]" 
									id="" 
									class="form-control" 
									placeholder="Introduce el nombre de la fase"><br>
							<?php endfor; ?>						
						<?php endif; ?>

					<?php endif; ?>


					<p>
						<button type="submit" class="btn btn-success">
							<?= isset($data["pipeline"]) ? "Actualizar pipeline ": "Crear pipeline" ; ?>
						</button>
					</p>
				</form>
			</div>
		</div>
	</div>
</div>


<pre><?php print_r($data); ?></pre>