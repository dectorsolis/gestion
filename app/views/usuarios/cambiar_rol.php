<form method="POST" action="<?= $data['action_form'] ?>" data-id-response="user-<?= $data['id_user'] ?>" class="form-ajax">
	<label>Modificar rol: </label>
	<input type="hidden" name="tipo" value="update_rol">
	<input type="hidden" name="id_user" value="<?= $data['id_user'] ?>">
	<select name="rol">
		<?php foreach( $data['roles'] as $item ): ?>
			<?php $selected = $data['id_rol'] == $item['id_rol'] ? 'selected' : '';  ?>
			<option value="<?= $item['id_rol']; ?>" <?= $selected ?> >
				<?= $item['descripcion']; ?>
			</option>
		<?php endforeach; ?>
	</select>
	<input type="submit" value="Enviar"></input>
</form>