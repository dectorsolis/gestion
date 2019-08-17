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
				<form class="form-pipeline-status" action="<?= $data['action'] ?>" method="POST">
					<input type="hidden" id="type" name="id_pipeline" value="<?= $data["pipeline"]->id_pipeline ?>">
					<input type="hidden" id="type" name="type" value="update_status_pipeline">
					<input type="hidden" id="id_fase" name="ultima_fase" value="">
				</form>	
				<ul class="pipeline">
				<?php foreach( $data["pipeline_fases"] as $index => $value ): ?>
					<li 
						data-id-fase = "<?= $index+1 ?>";
						class="fase <?= $index+1 <= $data["pipeline"]->ultima_fase ? "activo" : ""  ?>" >
						<?= $value ?>
					</li>
				<?php endforeach; ?>

				</ul>
			</div>
		</div>
	</div>
</div>