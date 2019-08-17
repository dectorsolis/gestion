<div class="row">
	<div class="col-md-12">
		<?php view_partial("prospectos/partials/info_pipeline", $data['pipeline']) ?>
	</div>
</div>
<div class="row">
	<!-- COLUMNA 1 -->
	<div class="col-md-4 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-md-12 col-xs-12">		
				<?php view_partial("prospectos/partials/info_prospecto", $data['info_prospecto']) ?>
			</div>
		</div>
	</div>
	<!-- FIN COLUMNA 1 -->
	
	<!-- COLUMNA 2 -->
	<div class="col-md-8 col-sm-12 col-xs-12">	
		<div class="row">
			<div class="col-md-12">
				<?php view_partial("prospectos/partials/notas",$data['notas']) ?>
			</div>
		</div>
	</div>
	<!-- FIN COLUMNA 2 -->
</div>


<pre><?php print_r($data); ?></pre>
