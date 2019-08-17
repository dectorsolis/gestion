<div class="row">
	<div class="col-md-12">
		<?php view_partial("empleados/partials/ficha/estadisticas_empleado", $data["estadisticas"] ); ?>
	</div>
</div>
<div class="row">
	<!-- columna 1 -->
	<div class="col-md-4 col-sm-12 col-xs-12">
		<?php view_partial("home/shared_partials/mi_agenda", $data["mi_agenda"]); ?>
		<?php view_partial("home/director_zona/partials/mi_equipo", $data["mi_equipo"] ); ?>
	</div>
	<!-- end columna 1 -->

	<!-- columna 2 -->
	<div class="col-md-8 col-sm-12 col-xs-12">
		<?php view_partial("home/shared_partials/mis_tickets_asignados", $data["tickets_asociados"]); ?>
		<?php view_partial("home/shared_partials/mis_tickets_generados", $data["tickets_generados"]); ?>		
		<?php view_partial("home/shared_partials/mis_clientes_recientes", $data["clientes_recientes"] ); ?>
		<?php view_partial("home/shared_partials/mis_prospectos", $data["prospectos"] ); ?>
	</div>
	<!-- end columna 2 -->
	
</div>