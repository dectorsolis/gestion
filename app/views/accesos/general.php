
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
				<?php foreach( $data['backup'] as $i => $item): ?>
				<table class="table">
					<thead>
						<tr style="color: white;background-color: #2a3f54;">
							<th><?= "#". ($i + 1) . " " . $item['dominio'] ?></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php $accesos = json_decode(stripslashes($item['accesos']));?>
								<table class="table table-striped">
									<thead >
										<tr>
											<th>Tipo</th>
											<th>Url</th>
											<th>Usuario</th>
											<th>Pass</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach( $accesos as $item):?>
										<tr>
											<td><?= $item->type ?></td>
											<td><?= $item->url ?></td>
											<td><?= $item->user ?></td>
											<td><?= base64_decode($item->pass) ?></td>
										</tr>						
										<?php endforeach?>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table> 
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	//var data = <?= $data['backup_json']; ?>;
	/*
	for( var i=0; i < data.length; i++){
		var tmp = jq(JSON.parse(data[i]['accesos'])).each(function(index, value){
			console.log(value.type);
			console.log(value.url);
			console.log(value.user);
			console.log(value.pass);
		});
	}*/
</script>