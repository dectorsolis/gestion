                <ul class="nav side-menu">
                  <li>
                    <a href="<?= PATH  ?>"><i class="fa fa-home"></i> Home </span></a>
                  </li>
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
                    <a><i class="fa fa-book"></i> Clientes  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH .  'clientes/' ?>">Ver clientes</a></li>
                      <li><a href="<?= PATH .  'clientes/nuevo/' ?>">Nuevo cliente</a></li>
                    </ul>
                  </li>       
                  <li>
                    <a><i class="fa fa-book"></i> Empleados <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH .  'empleados/' ?>">Ver empleados</a></li>
                      <li><a href="<?= PATH .  'empleados/nuevo/' ?>">Nuevo empleado</a></li>
                    </ul>
                  </li>                      
                  <li><a><i class="fa fa-user"></i> Cuenta <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?= PATH . 'cuenta/' ?>">Configuración</a></li>
                      <li><a href="<?= PATH . 'cuenta/actualizar/' ?>">Actualizar</a></li>
                      <li><a href="<?= PATH . 'login/logout/' ?>">Salir</a></li>
                    </ul>
                  </li>
                 
                </ul>