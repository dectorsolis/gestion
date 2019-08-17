                <ul class="nav side-menu">
                  <li>
                    <a href="<?= PATH ?>"><i class="fa fa-home"></i> Home </span></a>
                  </li>
                  <!-- Biblioteca   -->
                  <li>
                    <a><i class="fa fa-headphones"></i> Biblioteca <span class="label label-success">¡Nuevo!</span><span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH .  'biblioteca/multimedia/' ?>">Cursos Multimedia</a></li>
                    </ul>
                  </li>
                  <!-- Fin biblioteca --> 
                  <li>
                    <a><i class="fa fa-book"></i> Empleados <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH .  'empleados/' ?>">Ver empleados</a></li>
                      <li><a href="<?= PATH .  'empleados/nuevo/' ?>">Nuevo empleado</a></li>
                    </ul>
                  </li>                      
                  <!--
                  <li>
                    <a><i class="fa fa-book"></i> Prospección <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH .  'prospectos/' ?>">Ver prospectos</a></li>
                      <li><a href="<?= PATH .  'prospectos/nuevo/' ?>">Agregar prospecto</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-ticket"></i> Tickets <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH . 'tickets/nuevo/' ?>">Nuevo</a></li>
                      <li><a href="<?= PATH . 'tickets/generados/' ?>">Generados</a></li>
                      <li><a href="<?= PATH . 'tickets/asociados' ?>">Asociados</a></li>
                    </ul>
                  </li>
                  -->
                  <?php require_once VIEWS . "sidebar/cuenta.php"; ?> 
                 
                </ul>