<h1><?= $data["title"] ?></h1>
<div class="row">
<?php foreach($data["equipo"] as $i => $item): ?>
<div class="col-md-3 col-xs-12 widget widget_tally_box">
	<div class="x_panel">
		<div class="x_content">
			<div class="flex">
				<ul class="list-inline widget_profile_box">
	
                    <li>
                        <a href="<?= PATH . 'usuarios/perfil/' . $item['id_user'] ?>">
                        	<img src="<?= gravatar( $item['email_empresa'] , 140); ?>" alt="..." class="img-circle profile_img">
                        </a>
					</li>
					
				</ul>
			</div>

			<h3 style="font-size:18px;" class="name"><?= $item['nombre'] ?></h3>
			<h4 class="name"> <?= $item["departamento"] ?> </h4>
			<div class="flex">
				<ul class="list-inline count2">
                 	<li>
                    	<h3> <?= $item["tickets_asignados"] ?> </h3>
                        <small>Tickets asignados</small>
                    </li>
                    <li>
                        <h3><?= $item["total_proyectos"] ?></h3>
                        <small>Proyectos asignados</small>
                    </li>
                    <li>
                      	<h3> <?= $item["tickets_resueltos"] ?> </h3>
                		<small>Tickets resueltos</small>
                    </li>
				</ul>
			</div>
			<p>
               <a href="<?= PATH . 'empleados/ficha/' . $item['id_empleado'] ?>">Ver ficha del empleado</a>
            </p>
		</div>
    </div>
</div>
<?php endforeach; ?>
</div>