<div class="row">
	<div class="col-md-12">
		<?php view_partial("empleados/partials/ficha/estadisticas_empleado", $data["estadisticas"] ); ?>
	</div>
</div>
<div class="row">	
	<div class="col-md-4 col-xs-12">
		<?php view_partial("home/shared_partials/mi_agenda", $data["mi_agenda"]); ?>
	</div>	

	<div class="col-md-8 col-xs-12">
		<?php view_partial("home/shared_partials/mis_clientes_recientes", $data["clientes_recientes"]); ?>
		<?php view_partial("home/shared_partials/mis_prospectos", $data["prospectos"]); ?>
		<?php view_partial("home/shared_partials/mis_tickets_asignados", $data["tickets_asociados"]); ?>
		<?php view_partial("home/shared_partials/mis_tickets_generados", $data["tickets_generados"]); ?>
	</div>
			
</div>
