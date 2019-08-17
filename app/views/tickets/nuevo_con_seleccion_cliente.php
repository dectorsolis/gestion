<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Nuevo ticket: <?= $data['titulo'] ?></h2>
				<div class="clearfix"></div>	            
			</div>
			
			<div class="x_content">
				<?php $clientes = $data['clientes']; ?>
				<form class="busqueda-select-form form-horizontal form-label-left" method="POST">
					<div class="form-group">
						
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="cliente">
							Elige un cliente <span class="required">*</span>
						</label>
							
						<div class="col-md-6 col-sm-6 col-xs-12">
							<select data-live-search="true" class="selectpicker form-control">
							<?php foreach( $clientes as $item): ?>
								<option value="<?= $item['id_cliente'] ?>"> <?= $item['dominio']; ?> </option>
							<?php endforeach; ?>
							</select>					
						</div>
					</div>		

					<div class="form-group">
						<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
	                        <button type="submit" class="btn btn-success">Continuar</button>
	                    </div>	
					</div>

				</form>
			</div>
		</div>
	</div>
</div>