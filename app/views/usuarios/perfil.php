<?php $perfil = $data['info_usuario'][0]; ?>
<div class="row">
    <div class="col-md-3 col-xs-12">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $data['titulo_p1']?></h2>
                        <div class="clearfix"></div>                            
                    </div>

                    <div class="x_content">
                        <div class="info_perfil">
                            <div style="text-align:center;" id="crop-avatar">
                          <!-- Current avatar -->
                             <img class="img-responsive avatar-view" src="<?= gravatar($perfil['username'], 230); ?>" alt="Avatar">
                            </div>
                            <br>
                            <p>
                                <strong>Email</strong><br>
                                <?= $perfil['username']?>
                            </p>
                            <p></p>
                            <p>
                                <strong>Fecha de ingreso</strong><br>
                                <?= get_fecha_esp($perfil['fecha_ingreso']) ?>
                            </p>
                            <p>
                                <strong>Teléfono</strong><br>
                                <?= $perfil['telefono'] ?>
                            </p>

                            <p>
                                <strong>Usuario skype</strong><br>
                                <?= $perfil['usuario_skype'] ?>
                            </p>

                            <p>
                                <strong>Fecha de nacimiento</strong><br>
                                <?= get_fecha_esp($perfil['fecha_nac']) ?>
                            </p>

                            <p>
                                <strong>Pertenece al área de</strong><br>
                                <?= $perfil['depto'] ?>
                            </p>

                            <p>
                                <strong>Oficina</strong> <br>
                                <?= $perfil['region'] ?>
                            </p>                                                   
                            <p>
                                <strong>Última sesión</strong><br>
                                <?= get_fecha_esp( $perfil['last_login'] ) ?>
                            </p>
                        </div>

                    </div>
                </div>
            </div>            
        </div>
    </div>

    <div class="col-md-9 col-xs-12">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $data['titulo_p2']?></h2>
                        <div class="clearfix"></div>                            
                    </div>
                    <div class="x_content">
                        <?php if( $perfil['about'] ): ?>
                        <blockquote class="blockquote">
                            <p><?= str_replace(array('\n','\r'),"<br>", $perfil['about']) ?></p>
                        </blockquote>
                        <?php else: ?>
                        <p>Al parecer <?= $perfil['nombre'] ?> aún no ha escrito nada.</p>
                        <?php endif; ?>
                    </div>
                </div>            
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?= $data['titulo_p3']?></h2>
                        <div class="clearfix"></div>                            
                    </div>
                    <div class="x_content">
                        <div class="row tile_count">
                            <!--original count
                            <div class="col-md-2 col-xs-6 tile_stats_count">
                              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
                              <div class="count">2500</div>
                              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
                            </div>
                            -->
                            <div class="col-md-2 col-xs-6 tile_stats_count">
                              <span class="count_top"><i class="fa fa-user"></i> Proyectos</span>
                              <div class="count"> <?= $perfil['total_clientes']; ?> </div>
                            </div>                                                         
                            <div class="col-md-2 col-xs-6 tile_stats_count">
                              <span class="count_top"><i class="fa fa-search"></i> Prospectos</span>
                              <div class="count"> <?= $perfil['total_prospectos']; ?> </div>
                            </div>                              
                            <div class="col-md-2 col-xs-6 tile_stats_count">
                              <span class="count_top"><i class="fa fa-ticket"></i> Tickets resueltos</span>
                              <div class="count"> <?= $perfil['tickets_resueltos']; ?> </div>
                            </div>                              
                        </div>                        
                    </div>
                </div>
            </div>              
        </div>
    </div>
</div>
