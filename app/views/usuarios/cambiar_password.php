<div class="row">
	<div class="col-md-6">
		<form method="POST" action="<?= $data['action'] ?>" class="form-ajax">
			<h3><?= $data['titulo'] ?></h3>
			<input type="text" name="pass" placeholder="Nueva contraseña" class="form-control"><br>
			<input type="text" name="repeat-pass" placeholder="Repite la contraseña" class="form-control"><br>
			<button type="submit" class="btn btn-primary">Cambiar</button>
		</form>
	</div>
</div