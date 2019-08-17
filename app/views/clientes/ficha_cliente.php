
<div class="row">
	<div class="col-md-12 col-xs-12"> <?php require_once INCLUDES . "alerts.php"; ?> </div>
</div>
<div class="row">
	<div class="col-md-12">
		<h2><?= $data['titulo'] ?>: <small><?= $data['dominio'] ?></small> </h2>
		<p><a href="<?= $data['href_ticket'] ?>">Crear ticket <span style="color:red;" class="fa fa-ticket"></span></a></p>
	</div>
</div>

<div class="row">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
		<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    	<li role="presentation" class="active">
	        	<a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Datos del proyecto</a>
			</li>
			<li role="presentation" class="">
				<a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Integrantes del proyecto</a>
			</li>			
			<li role="presentation" class="">
				<a href="#tab_content3" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Info. Directorios</a>
			</li>			
			<li role="presentation" class="">
				<a href="#tab_content4" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Accesos</a>
			</li>			
			<li role="presentation" class="">
				<a href="#tab_content5" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Keywords</a>
			</li>
	    </ul>
	    
	    <div id="myTabContent" class="tab-content">
	    	<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
	    		<div class="row">
	    			<?php view_partial('clientes/partials/ficha/info_cliente', 	$data['info_cliente']); ?>	
	    			<?php view_partial('clientes/partials/ficha/servicios_seo', $data['servicios_seo']); ?>	
	    			<?php view_partial('clientes/partials/ficha/responsable_contenido', $data['responsable_contenido'] ); ?>
	    		</div>
	    	</div>
			<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
				<div class="row">
					<?php view_partial('clientes/partials/ficha/integrantes_proyecto', $data['directorio_proyecto']); ?>
				</div>
	        </div>			
	        <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
				<div class="row">
					<?php view_partial('clientes/partials/ficha/info_directorios', $data['informacion_directorios'] ); ?>
					<?php view_partial('clientes/partials/ficha/datos_varios', $data['datos_varios'] ); ?>
				</div>
	        </div>	        
	        <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">
				<div class="row">
					<?php view_partial('clientes/partials/ficha/agregar_accesos', $data['ficha_accesos'] ); ?>
				</div>
	        </div>	        
	        <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
				<div class="row">
					<?php view_partial('clientes/partials/ficha/agregar_keywords', $data['info_keywords']); ?>
				</div>
	        </div>
		</div>
	</div>
</div>
