
<div class="row">
	<div class="col-md-12 col-xs-12">
		
		<!-- estadisticas del empleado -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<?php view_partial("empleados/partials/ficha/estadisticas_empleado", $data["estadisticas"] ); ?>
			</div>
		</div>
		<!-- fin estadisticas del empleado -->

		<!-- agendas del empleado -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<?php view_partial("agendas/agenda_history", $data["agenda_empleado"] ); ?>
			</div>
		</div>
		<!-- fin agendas del empleado -->
		
		<!-- proyectos del empleado -->
		<div class="row">
			<div class="col-md-12 col-xs-12">		
				<?php view_partial("empleados/partials/ficha/proyectos_empleado", $data["proyectos"]); ?>
			</div>
		</div>
		<!-- fin proyectos del empleado -->
		
		<!-- prospectos del empleado -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<?php view_partial("empleados/partials/ficha/prospectos_empleado", $data["prospectos"]); ?>
			</div>
		</div>
		<!-- fin prospectos del empleado -->
		
		<!-- tickets generados del empleado -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<?php view_partial("empleados/partials/ficha/tickets_generados", $data["tickets_generados"] ); ?>
			</div>
		</div>
		<!-- fin tickets generados del empleado -->
		
		<!-- tickets asociados del empleado -->
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<?php view_partial("empleados/partials/ficha/tickets_asociados", $data["tickets_asociados"] ); ?>
			</div>
		</div>
		<!-- fin tickets asociados del empleado -->
		
	</div>
</div>


