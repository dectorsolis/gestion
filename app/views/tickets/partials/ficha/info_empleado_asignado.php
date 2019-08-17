
        <?php if( isset( $data['destinatario'] ) ): ?>
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
                                <?php $asignado = $data['destinatario']; ?>
                                <td><img src="<?= gravatar( $asignado[0]['email_empresa'] ,80 ) ?>" alt="gravatar"></td>
                                <td>
                                    <?= $asignado[0]['nombre']; ?>
                                    <?php if( $data['id_destinatario'] == $data['id_empleado']): ?>
                                        (Yo)
                                    <?php endif;?>
                                    <br>
                                    <?= $asignado[0]['depto']; ?><br>
                                    <?= $asignado[0]['email_empresa']; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>        
            </div>
        </div>
        <?php endif; ?>