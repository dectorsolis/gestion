	<div class="row">
		<div class="col-md-12">
			<?php if($data['empleados']):  ?>
			<?php $empleados = $data['empleados']; ?>
			
			<form method="POST" action="<?= $_SERVER['REQUEST_URI']; ?>">
				<p>
					<select name="id_empleado" class="form-control">
						<option>Elige un integrante</option>
						
						<?php for($i = 0; $i < count($empleados); $i++ ): ?>
							<option value="<?= $empleados[$i]["id_empleado"]; ?>"><?= $empleados[$i]["nombre"]; ?></option>
						<?php endfor;?>
						</select>
				</p>
				<p><button type="submit" class="btn btn-success">Agregar</button></p>
			</form>
			<?php endif; ?>

		</div>
	</div>