<?php require_once INCLUDES . "header.php"; ?>
<div class="container">
	<div class="panel panel-default">
	
	<?php if( isset( $data['ticket']) ): ?>
		<?php $ticket = $data['ticket']; ?>

        <div class="panel-heading">
            <div class="panel-title">
        		<?php if( isset( $data['ticket']) ): ?>
                    <span class="btn btn-<?= $ticket[0]['prioridad']; ?>">Prioridad: <?= $ticket[0]['prioridad']; ?></span> 
                    <span class="btn btn-<?= $ticket[0]['id_estado']; ?>">Estado: <?= $ticket[0]['estado']; ?></span>
        		<?php endif; ?>    
            </div>
        </div> 


        <div class="row">
        	<div class="col-md-12">
                <!-- Trigger the modal with a button -->
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
                
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">
                            <?= $tickets_asociados[$i]['id_ticket']; ?>
                        </h4>
                      </div>
                      <div class="modal-body">
                        <p>Some text in the modal.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                
                  </div>
                </div>
        	</div>
        </div>       

    <?php endif; ?>
    </div>	
</div>
<?php require_once INCLUDES . "footer.php"; ?>
