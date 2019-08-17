
<div class="row">
	<div class="col-md-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2> <?= $data['titulo']?> </h2>
				<ul class="nav navbar-right panel_toolbox">
	                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
	            </ul>	
				<div class="clearfix"></div>	            
			</div>
				
			<div class="x_content">	
				<table class="table table-hover">
					<thead></thead>
					<tbody>

					<?php foreach( $data["top"] as $i => $item ): ?>
						<tr class='clickable-row' data-href='<?= PATH . "usuarios/perfil/" . $item['id_user'] ?>'>
							<td><?= "#" . ($i + 1) ?></td>
							<td>
							<?php if( $i + 1 == 1):  ?>
								<img class="medal" src="<?= PATH . "img/gold.png"?>"> 
							<?php elseif( $i + 1 == 2): ?>
								<img class="medal" src="<?= PATH . "img/silver.png"?>"> 
							<?php elseif( $i + 1 == 3): ?>
								<img class="medal" src="<?= PATH . "img/bronze.png"?>"> 
							<?php endif; ?>
							</td>
							<td>
								<img src = "<?= gravatar( $item["email_empresa"], 20 ) ?> " />
							</td>
							<td> 
								<?= $item["nombre"] ?> 
							</td>
							<td>
								<?= $item["total"] ?>
							</td>
						</tr>
					<?php endforeach; ?>							
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

