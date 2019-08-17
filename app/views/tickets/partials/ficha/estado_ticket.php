
        
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $data['title']?></h2>
                        <div class="clearfix"></div>                            
                    </div>

                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12 col-xs-12">
                                <form id="cambiar-estado-ticket" method="POST" action="<?= $data['action_estado_ticket_form'] ?>">
                                    <select name="id_estado" id="estado-ticket" class="form-control">
                                        <?php $estado_tickets = $data['estado_ticket']; ?>
                                        <?php foreach( $estado_tickets as $item ): ?>
                                            <option value="<?= $item['id_estado']; ?>" <?= $item['id_estado'] == $data['id_estado'] ? "selected" : "" ;?> > 
                                                <?= $item['descripcion'];    ?> 
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="token" value="<?= $data['id_ticket']; ?>">
                                    <input type="hidden" name="redirect" value="<?= PATH . 'tickets/ficha/' . $data['id_ticket'];  ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
        