<form method="POST" action="<?= $data['action']; ?>">
	<div class="form-group">
		<input type="hidden" name="cliente" value="<?= $data['id_cliente']; ?>" />
		<div class="col-md-4">
			<select  name="empleado" class="form-control">
			<?php foreach( $data['empleados'] as $item): ?>
				<option value="<?= $item['id_empleado']; ?>">
					<?= $item['nombre']; ?>
				</option>
			<?php endforeach; ?>
			</select>
		</div>
		<div class="col-md-2">
			<button type="submit" class="btn btn-submit btn-success">Agregar</button> 
		</div>		
	</div>
	
</form>