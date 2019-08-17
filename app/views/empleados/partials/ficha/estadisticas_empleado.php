		<?php $estadisticas = $data["estadisticas"]; ?>
		
		<div class="x_panel">
			<div class="x_title">
				<h2> <?= $estadisticas->nombre ?> - <?= $data['titulo'] ?></h2>
				<ul class="nav navbar-right panel_toolbox">
	                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
	            </ul>	
				<div class="clearfix"></div>	            
			</div>
		
			<div class="x_content">	
				<div class="row tile_count">
				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-book"></i> Proyectos activos</span>
				        <div class="count green"><?= $estadisticas->proyectos_activos ?></div>
				        <!--<span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
				    </div>			    
				    
				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-search"></i> Total prospectos</span>
				    	<div class="count green"><?= $estadisticas->prospectos ?></div>
				        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>-->
				    </div>

				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-ticket"></i> Tickets asignados</span>
				        <div class="count green"><?= $estadisticas->tickets_asignados ?></div>
				        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>-->
				    </div>	

				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<span class="count_top"><i class="fa fa-ticket"></i> Tickets generados</span>
				        <div class="count green"><?= $estadisticas->tickets_generados ?></div>
				        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>-->
				    </div>					    
				<?php if( $estadisticas->tickets_asignados > 0 ): ?>
				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	<?php $ideal = floor($estadisticas->tickets_asignados * 0.10) ?>
				    	<?php $actual = round($estadisticas->tickets_pendientes * 100 / $estadisticas->tickets_asignados); ?>
					    <?php $status = $actual <= 10 ? "green" : "red"; ?>
					    <?php $arrow  = $actual <= 10 ? "fa fa-sort-desc" : "fa fa-sort-asc" ;  ?>				    	

				    	<span class="count_top"><i class="fa fa-ticket"></i> Tickets pendientes</span>
				        <div class="count <?= $status ?>"><?= $estadisticas->tickets_pendientes ?></div>
				        <!--<span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>-->
					    <span class="count_bottom">
					       	Máx: <?= $ideal; ?> Tickets <i>10%</i>
					    </span><br>
					    <span class="count_bottom">
							Actual: <?= $estadisticas->tickets_pendientes ?> Tickets  <i class="<?= $status ?>"><i class="fa <?= $arrow ?>"></i><?= $actual ?>%</i>
					    </span><br>				        
					    <span class="count_bottom">

						<?php if( $actual <= 10	 ): ?>
							<label class="label label-success">¡Buen promedio!</label>
						<?php else: ?>
							<label class="label label-danger">¡Reducir promedio !</label>
						<?php endif; ?>
					    </span>				        
				    </div>						
				    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				    	
				    	<?php $ideal  = round($estadisticas->tickets_asignados * 0.90) ?>
					    <?php $actual = round( $estadisticas->tickets_resueltos * 100 / $estadisticas->tickets_asignados ) ?>
					    <?php $status = $actual >= 90 ? "green" : "red"; ?>
					    <?php $arrow  = $actual >= 90 ? "fa fa-sort-asc" : "fa fa-sort-desc" ;  ?>
					    	
					    <span class="count_top"><i class="fa fa-ticket"></i> Tickets resueltos</span>
					    <div class="count <?= $status ?>"> <?= $estadisticas->tickets_resueltos ?> </div>

					    <span class="count_bottom">
					       	Min: <?= $ideal; ?> Tickets <i>90%</i>
					    </span><br>
					    <span class="count_bottom">
							Actual: <?= $estadisticas->tickets_resueltos ?> Tickets  <i class="<?= $status ?>"><i class="fa <?= $arrow ?>"></i><?= $actual ?>%</i>
					    </span><br>				        
					    <span class="count_bottom">

							<?php if( $actual >= 90	 ): ?>
								<label class="label label-success">¡Buen promedio!</label>
							<?php else: ?>
								<label class="label label-danger">¡Elevar promedio!</label>
							<?php endif; ?>
					    </span>
				    </div>
				<?php endif; ?>		    
				</div>


			</div>
		</div>
