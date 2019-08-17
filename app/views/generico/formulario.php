<div class="row">
	<div class="col-md-6">
		<div class="x_panel">
			<div class="x_title">
				<h2><?= $data['titulo_panel'] ?></h2>
				<div class="clearfix"></div>							
			</div>

			<div class="x_content">				
				<form method = "POST" action = " <?= $data['action_form']; ?> ">
					<p><input type="text" class="form-control" value="<?=  isset( $form['nombre'] ) ? $form['nombre'] : ""; ?>" name="item" placeholder=" <?= $data['placeholder']; ?> "/></p>

					<?php if( isset( $form['id'] ) ): ?>
					<p><input type="hidden" name="token" value="<?= $form ? $form['id'] :  "";  ?>" class="form-control"/></p>
					<?php endif; ?>
					<p><input type="submit" value="Guardar" class="btn btn-primary"/></p>
				</form>				
			</div>
		</div>
	</div>
</div>



