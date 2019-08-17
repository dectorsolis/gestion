    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <?php require_once INCLUDES . "alerts.php"; ?>
                <?php if( isset($data['tickets']) ): ?>
                <form action="<?= PATH . 'tickets/eliminar-tickets/'; ?>" method="POST">
                
                <table id="tickets-generados" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Asunto</th>
                            <th>Fecha de emisión</th>
                            <th>Departamento</th>                          
                            <th>Prioridad</th>
                            <th>Estado del ticket</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $tickets = $data['tickets']; ?>
                        <?php foreach( $data['tickets'] as $i => $item ): ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="tickets" name="tickets[]" value="<?= $item['id_ticket']; ?>"/>
                            </td>                            
                            <td><?= $item['id_ticket']; ?></td>
                            <td>
                                <a href="<?= PATH . 'clientes/ficha/'. $item['id_cliente']; ?>">
                                    <?= $item['cliente']; ?>
                                </a>
                            </td>
                            <td>
                                <a href="<?= PATH . 'tickets/ficha/' . $item['id_ticket']; ?>"><?= $item['asunto']; ?></a>
                            </td>
                            <td><?= $item['fecha_creacion']; ?></td>
                            <td><?= $item['departamento']; ?></td>

                            <td>
                                <span class="prioridad <?= $item['prioridad']; ?>">
                                    <?= $item['prioridad']; ?>
                                </span>    
                            </td>

                            <td>
                                <span class="estado estado-<?= $item['id_estado']; ?>">
                                    <?= $item['estado']; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                    Acciones en lote
                    <select name="acciones" >
                        <option value="1">Eliminar</option>
                    </select>
                    <button type="submit">Aplicar</button>
                </form>
                <?php endif; ?>

                <script type="text/javascript">
                    jq(document).ready(function() {
                    jq("#tickets-generados").DataTable();
                } );
                </script>
            </div>
        </div>       


    </div>


    <script type="text/javascript">
        jq(document).ready(function() {
        jq("#example").DataTable();
    } );
    </script>