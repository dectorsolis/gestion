		<div class="x_panel">
			<div class="x_title">
				<h2> <?= $data["titulo"]?> </h2>
				<ul class="nav navbar-right panel_toolbox">
	                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
	            </ul>	
				<div class="clearfix"></div>	            
			</div>
			
			<div class="x_content">	
			<?php if( isset( $data["agenda"] ) ): ?>
				<table id="agendas">
					<thead>
						<tr>
							<td>#ID fecha</td>
							<td>Actividad</td>
							<td>Estado</td>
						</tr>
					</thead>
					<tbody>
					<?php foreach( $data["agenda"] as $index => $value): ?>
						<?php foreach( $value as $item): ?>
						<tr>
							<td><?= $index ?></td>
							<td><?= $item->actividad ?></td>
							<td>
								<?php if( $item->estado ): ?>
									<span class="label label-success">Completa</span>
								<?php else: ?>
									<span class="label label-danger">Incompleta</span>
								<?php endif; ?>
							</td>
						</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<strong>No hay registros recientes</strong>				
			<?php endif; ?>
			</div>
		</div>
		<script type="text/javascript">
			jq(document).ready(function() {
				jq("#agendas").DataTable({
					 "order": [[ 0, 'desc' ]]
				});
			} );
		</script>	