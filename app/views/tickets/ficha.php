<div class="row">
    <div class="col-md-12 col-xs-12">
        <span class="estado ticket-title"> Ticket ID <?= $data['id_ticket']; ?></span>
        <span class="prioridad <?= $data['prioridad']; ?>"><?= $data['prioridad']; ?></span> 
        <span class="estado estado-<?= $data['id_estado']; ?>"><?= $data['estado']; ?></span>
        <a href="<?= PATH . 'clientes/ficha/' . $data['id_cliente']  ?>">Ver ficha</a>
    </div>
</div>
<br>
<!-- Para alertas -->
<div class="row">
    <div class="col-md-12 col-xs-12">
        <?php require_once INCLUDES . "alerts.php"; ?>
    </div>
</div>

<div class="row">
                
    <div class="col-md-4 col-xs-12">

        <!-- Cambiar estado del ticket -->
        
        <?php if( isset( $data['estado_ticket'] ) ): ?>
            <?php view_partial("tickets/partials/ficha/estado_ticket", $data["estado_ticket"] ); ?>
        <?php endif; ?>
        
        <!-- Info del ticket -->
        <?php view_partial("tickets/partials/ficha/info_ticket", $data["info_ticket"] ); ?>
        <!-- Fin info ticket -->

        <!-- Info empleado asignado -->
        <?php view_partial("tickets/partials/ficha/info_empleado_asignado", $data["empleado_asignado"] ); ?>
    </div>

    <div class="col-md-8 col-xs-12">
        
        <!-- Mensaje -->
        <?php view_partial("tickets/partials/ficha/mensaje_ticket", $data["mensaje_ticket"] ); ?>


        <!-- Evidencias -->
        <?php view_partial("tickets/partials/ficha/evidencia_ticket", $data["evidencia_ticket"] ); ?>

        <!-- Observaciones -->
        <?php view_partial("tickets/partials/ficha/observaciones_ticket", $data["observaciones"] ); ?>


        <?php view_partial("tickets/partials/ficha/observaciones_ticket", $data["observaciones"]); ?>

        <?php if( isset( $data["agregar_observacion"] ) ): ?>
            <?php view_partial("tickets/partials/ficha/agregar_observacion", $data["agregar_observacion"]); ?>
        <?php endif; ?>
		
        <!-- Delegar ticket a otro empleado -->
        <?php if( isset( $data["delegar_ticket"] ) ): ?>
            <?php view_partial("tickets/partials/ficha/delegar_ticket", $data["delegar_ticket"]); ?>
        <?php endif; ?>		
    </div>  
</div>

