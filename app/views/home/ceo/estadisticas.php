		<div class="x_panel">
			<div class="x_title">
				<h2> <?= $data['title'] ?></h2>
				<ul class="nav navbar-right panel_toolbox">
	                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
	            </ul>	
				<div class="clearfix"></div>	            
			</div>
			
			<div class="x_content">	
				<div class="row tile_count">
				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-user"></i>Empleados</span>
				        <div class="count green"><?= $data["empleados"]->total ?></div>
				        <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
				    </div>

				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-book"></i>Clientes</span>
				        <div class="count green"><?= $data["clientes"]->total ?></div>
				    </div>

				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-book"></i>Clientes activos</span>
				        <div class="count green"><?= $data["clientes"]->activos ?></div>
				        <?php $porcentaje = ( $data["clientes"]->activos * 100 ) / $data["clientes"]->total; ?>
				        <span class="count_bottom">
				        	<i class="<?= $porcentaje > 50 ? 'green' : 'red' ; ?>"> 
				        		<?= round($porcentaje) ?> % 
				        	</i> 
				        	de <?= $data["clientes"]->total ?> clientes
				        </span> 
				    </div>

				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-book"></i>Clientes Inactivos</span>
				        <div class="count red"><?= $data["clientes"]->inactivos ?></div>
				        <?php $porcentaje = ( $data["clientes"]->inactivos * 100 ) / $data["clientes"]->total; ?>
				        <span class="count_bottom">
				        	<i class="<?= $porcentaje < 25 ? 'green' : 'red' ; ?>"> 
				        		<?= round($porcentaje) ?> % 
				        	</i> 
				        	de <?= $data["clientes"]->total ?>
				        </span> 				        
				    </div>					    				    
				    
				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-search"></i> Prospectos</span>
				    	<div class="count green"><?= $data["prospectos"]->total ?></div>
				        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>-->
				    </div>
				    				        			    
				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-ticket"></i> Tickets</span>
				        <div class="count green"><?= $data["tickets"]->total ?></div>
				        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>-->
				    </div>	
				    
				</div>


				<div class="row tile_count">
				   

				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<?php $porcentaje = ( $data["tickets"]->resueltos * 100 ) / $data["tickets"]->total ?>
				    	<span class="count_top"><i class="fa fa-ticket"></i> Tickets resueltos</span>
				        <div class="count <?= $porcentaje >= 90 ? 'green' : 'red' ; ?>">
				        	<?= $data["tickets"]->resueltos ?>
				        </div>
				        <span class="count_bottom">
				        	<i class="<?= $porcentaje >= 90 ? 'green' : 'red' ; ?>"> 
				        		<?= round($porcentaje) ?> % 
				        	</i> 
				        	de <?= $data["tickets"]->total ?> Tickes
				        </span> <br>
				        <span class="count_bottom">
				        	<?php $target = round($data["tickets"]->total * 0.90) ?>
				        	Ideal: <?= $target ?> tickets 90%
				        </span>				        
				    </div>	

				    <?php $pendientes = $data["tickets"]->procesando + $data["tickets"]->pendientes ?>

				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

				    	<?php $porcentaje = ($data["tickets"]->procesando * 100 ) / $pendientes ?>
				    	<span class="count_top"><i class="fa fa-ticket"></i> Tickets resolviéndose</span>
				        <div class="count <?= $porcentaje > 90 ? 'green' : 'red' ?>"><?= $data["tickets"]->procesando ?></div>
				        <span class="count_bottom">
				        	<i class="<?= $porcentaje > 90 ? 'green' : 'red' ; ?>"> 
				        		<?= round($porcentaje) ?> % 
				        	</i> 
				        	de <?= $pendientes  ?> 
				        </span> <br>

				        <span class="count_bottom">
				        	<?php $target = floor( $pendientes * 0.90) ?>
				        	Ideal: <?= $target ?> tickets 90%
				        </span>					        
				    </div>

				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<?php $porcentaje = ( $data["tickets"]->pendientes * 100 ) / $pendientes ?>
				    	<span class="count_top"><i class="fa fa-ticket"></i>Tickets sin respuesta</span>
				        <div class="count red"><?= $data["tickets"]->pendientes ?></div>
				        <span class="count_bottom">
				        	<i class="<?= $porcentaje <= 10 ? 'green' : 'red' ; ?>"> 
				        		<?= round($porcentaje) ?> % 
				        	</i> 
				        	de <?= $pendientes ?>
				        </span> <br>
				        <span class="count_bottom">
				        	<?php $target = floor( $pendientes * 0.10 ) ?>
				        	Ideal: <?= $target ?> tickets 10%
				        </span>					        
				    </div>			    
				   
				    </div>
				</div>


			</div>
		</div>
