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
		<div class="row">
			<script>
		    	jq(document).ready(function() {
		        	jq('#summernote').summernote();
		    	});
		  	</script>
			<form method="post" action="<?= $data["action"] ?>">
				<input type="hidden" name="type" value="create_note" />
			  	<textarea id="summernote" name="editordata"></textarea>
			  	<p><button type="submit" class="btn btn-default">Crear nota</button></p>
			</form>	 

			<div class="col-md-12">
<<<<<<< HEAD
			<?php if( $data["meta"] ): ?>
				<?php $meta = $data['meta']; ?>
				<?php for($i = 0; $i < count($meta); $i++): ?>
				<p>
					<strong><?= $meta[$i]['meta_key'] ?></strong>	
					<br>
					<?= $meta[$i]['meta_value'] ?>
					<hr class="separator">
				</p>
				<?php endfor; ?>
			<?php endif; ?>
			</div>
		</div>
		<script>
	    	jq(document).ready(function() {
	        	jq('#summernote').summernote();
	    	});
	  	</script>
		<form method="post" action="<?= $data["action"] ?>">
			<input type="hidden" name="type" value="create_note"/>
		  	<textarea id="summernote" name="editordata"></textarea>
		  	<p><button type="submit" class="btn btn-default">Crear nota</button></p>
		</form>	  
=======

			<?php if( $data['meta'] ): ?>
				<?php $meta =  $data['meta']; ?>
				<?php for( $i = 0; $i < count( $meta ); $i++ ): ?>
					<?php
						$fecha = date_parse( explode("pipeline_note_", $meta[$i]['meta_key'])[1] );
					?>
				<p>
					<strong><?= $fecha['day'] . "/" . $fecha['month'] . "/" . $fecha['year'] ?></strong> 
					a las <strong><?= $fecha['hour'] . ":" . $fecha['minute'] ?></strong>
					<?= $meta[$i]['meta_value'] ?>
				</p>
				<?php endfor;?>
			<?php endif; ?>
			</div>
		</div> 
>>>>>>> 4e87d0b0ac34f99f819c65fa84cf01996a5026a5
	</div>
</div>
