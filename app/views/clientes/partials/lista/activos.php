
<div class="" row>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2> <?= $data['titulo'] ?> </h2>
				<ul class="nav navbar-right panel_toolbox">
	                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
	            </ul>	
				<div class="clearfix"></div>	            
			</div>
			
			<div class="x_content">

				<div class="table-responsive">
					<table id="tabla-proyectos-activos" class="table table-hover" >
						<thead>
							<tr>
								<th>#</th>
								<th>Dominio</th>
								<th>Región</th>
								<th>Crear Ticket</th>
								<th>Editar</th>
								<th>Historial</th>
							</tr>
						</thead>
						<tbody>
						<?php if( $data['lista'] ): ?>
							<?php foreach( $data['lista'] as $i => $item): ?>
							<?php 
								$class = "";
								if( !$item['activo'] )
									$class = "danger";
							?>
							<tr class="<?= $class; ?>" data-href="<?= PATH . 'clientes/ficha/' . $item['id_cliente']; ?>">
								<td> <?= $i + 1; ?> </td>
								<td> 
									<a href="<?= PATH . 'clientes/ficha/' . $item['id_cliente'] ; ?>"><?= $item['dominio']; ?> </a>
								</td>
								<td> <?= $item['region']; ?> </td>
								<td> 
									<a href="<?= PATH . 'tickets/nuevo/' . $item['id_cliente']; ?>">
										<i class="ticket icon-size fa fa-ticket"></i>
									</a> 
								</td>
								<td>
							        <a href="<?= PATH . "clientes/editar/" . $item['id_cliente']; ?>">
							          <i class="icon-size fa fa-edit"></i>
							        </a>

								</td>	
								<td>
									<a href="<?= PATH . "clientes/tickets/" . $item['id_cliente'] ?>" class="btn btn-sm btn-success">Historial Tickets</a>
								</td>						
							</tr>
							<?php endforeach; ?>
						<?php endif; ?>
						</tbody>
					</table>	
	                <script type="text/javascript">
	                    jq(document).ready(function() {
	                    jq("#tabla-proyectos-activos").DataTable();
	                } );
	                </script>							
				</div>
			</div>
		</div>
	</div>
</div>