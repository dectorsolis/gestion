        <?php
            $ticket = $data['info'];
        ?>
        <!-- Info del ticket -->
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $data['title']?></h2>
                        <div class="clearfix"></div>                            
                    </div>

                    <div class="x_content">
                        <table class="info">
                            <tr>
                                <tbody>
                                    <tr>
                                        <td>Sitio</td>
                                        <td><?= $ticket['cliente'];?></td>
                                    </tr>                    
                                    <tr>
                                        <td>Creado</td>
                                        <td><?= $ticket['fecha_creacion']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Inicio</td>
                                    <?php if( $inicio = $ticket['fecha_inicio'] ): ?>
                                        <td><?= $inicio; ?></td>
                                    <?php else: ?>
                                        <td> N/A </td>
                                    <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Finalización</td>
                                    <?php if( $final = $ticket['fecha_final'] ): ?>                            
                                        <td><?= $ticket['fecha_final']; ?></td>
                                    <?php else: ?>
                                        <td> N/A </td>
                                    <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td><img src="<?= gravatar( $ticket['email_empresa'], 80) ?>"></td>
                                        <td>
                                            <strong>Emisor</strong><br>
                                            <?= $ticket['nombre']; ?>
                                            <?php if( $ticket['id_emisor'] == $data["id_empleado"] ): ?>
                                                (Yo)
                                            <?php endif;?>
                                            <br>
                                            <?= $ticket['departamento']; ?><br>
                                            <?= $ticket['email_empresa']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
        </div>