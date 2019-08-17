                <ul class="nav side-menu">
                  <li>
                    <a href="<?= PATH ?>"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                  <li><a href="<?= PATH . 'agendas/' ?>"><i class="fa fa-book"></i> Mis tareas <span class="label label-success">¡Nuevo!</span></a></li>   
                  <!-- Biblioteca   -->
                  <li>
                    <a><i class="fa fa-headphones"></i> Videoteca <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH .  'biblioteca/multimedia/' ?>">Cursos Multimedia</a></li>
                      <li><a href="<?= PATH .  'biblioteca/descargas/' ?>">Documentos y Descargas</a></li>
                    </ul>
                  </li>
                  <!-- Fin biblioteca -->                                    
                  <li>
                    <a><i class="fa fa-search"></i> Prospección <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <!--<li><a href="<?= PATH . 'prospectos/analisis' ?>">Solicitar análisis</a></li>-->
                      <li><a href="<?= PATH .  'prospectos/' ?>">Lista de prospectos</a></li>
                      <li><a href="<?= PATH .  'prospectos/nuevo/' ?>">Agregar prospecto</a></li>
                      <li><a href="<?= PATH .  'prospectos/mis-prospectos/' ?>">Mis prospectos</a></li>
                    </ul>
                  </li>

                  <li>
                    <a><i class="fa fa-group"></i> Mis clientes <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH .  'clientes/nuevo/' ?>">Registrar nuevo cliente</a></li>
                      <li><a href="<?= PATH . 'clientes/lista/' ?>">Mi Lista de clientes</a></li>
                    </ul>                    
                  </li>


                  <li><a><i class="fa fa-ticket"></i> Mis tickets <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH . 'tickets/nuevo/' ?>">Crear nuevo</a></li>
                      <li><a href="<?= PATH . 'tickets/generados/' ?>">Generados</a></li>
                      <li><a href="<?= PATH . 'tickets/asociados/' ?>">Asociados</a></li>
                      <li><a href="<?= PATH . 'tickets/asociados/todo' ?>">Todos</a></li>
                    </ul>
                  </li>
                  <?php require_once VIEWS . "sidebar/cuenta.php"; ?> 
                 
                </ul>