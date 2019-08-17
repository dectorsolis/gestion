
<?php if($response): ?>
	<div class="row">
		<div class="col-md-12 col-xs-12 alert alert-<?= $response['type']; ?>">
			<?= $response['message']; ?>
		</div>
	</div>	
<?php endif; ?>