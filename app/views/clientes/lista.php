<div class="row">
	<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	  	<li role="presentation" class="active">
	      	<a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Clientes activos</a>
		</li>
		<li role="presentation" class="">
			<a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Clientes Inactivos</a>
		</li>			
	</ul>	
	
	<div id="myTabContent" class="tab-content">
	  	<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
	  		<div class="row">
				<div class="col-md-12">
					<!-- Clientes activos -->
					<?php view_partial("clientes/partials/lista/activos", $data["clientes_activos"]); ?>
					<!-- Fin clientes activos -->		
				</div>		  			
	   		</div>
	    </div>		  	
	    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="home-tab">
	  		<div class="row">
				<div class="col-md-12">
					<!-- Clientes inactivos -->
					<?php view_partial("clientes/partials/lista/inactivos", $data["clientes_inactivos"]); ?>
					<!-- Fin clientes inactivos -->		
				</div>	  			
	   		</div>
	    </div>	
</div>


