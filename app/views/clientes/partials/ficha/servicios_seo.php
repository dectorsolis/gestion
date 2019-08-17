	<?php $servicios = $data['servicios'] ? $data['servicios'] : [] ; ?>
	<div class="col-md-4">
		<div class="x_panel">
			<div class="x_title">
				<h4 class="float-left"> <?= $data['titulo']?> </h4>
				<ul class="nav navbar-right panel_toolbox">
	                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li><a class="close-link"><i class="fa fa-close"></i></a></li>
	            </ul>	
				<div class="clearfix"></div>	            
			</div>
					
			<div class="x_content">	
				<button 
					class="btn btn-primary link-ajax" 
					data-href="<?= $data['href_update_servicios_seo'] ?>"
					data-id-loader = "#response-servicios-seo"
					data-id-response="response-servicios-seo" 
					data-response-method ="html">Actualizar servicios SEO
				</button>					
				<div id="response-servicios-seo">
				<table class="table">
					<tbody>
					<?php if( $servicios ): ?>
						<tr><th>SEO</th><td><?= isset($servicios->seo) ? $servicios->seo : '' ?></td></tr>
						<tr><th>Rediseño</th><td><?= $servicios->rediseno ?></td></tr>
						<tr><th>Branding</th><td><?= $servicios->branding ?></td></tr>
						<tr><th>Contenidos</th><td><?= $servicios->contenidos ?></td></tr>
						<tr><th>Social Media</th><td><?= $servicios->smm ?></td></tr>
						<tr><th>Email Marketing</th><td><?= $servicios->crm ?></td></tr>
						<tr><th>Hosting</th><td><?= $servicios->hosting ?></td></tr>
						<tr><th>Dominio</th><td><?= $servicios->dominio ?></td></tr>
						<tr><th>Link Building</th><td><?= $servicios->enlaces ?></td></tr>
						<tr><th>Adwords</th><td><?= isset($servicios->adwords) ? $servicios->adwords : '' ?></td></tr>
					<?php else: ?>
						<tr><th>SEO</th><td>N/A</td></tr>
						<tr><th>Rediseño</th><td>N/A</td></tr>
						<tr><th>Branding</th><td>N/A</td></tr>
						<tr><th>Contenidos</th><td>N/A</td></tr>
						<tr><th>Social Media</th><td>N/A</td></tr>
						<tr><th>Email Marketing</th><td>N/A</td></tr>
						<tr><th>Hosting</th><td>N/A</td></tr>
						<tr><th>Dominio</th><td>N/A</td></tr>
						<tr><th>Link Building</th><td>N/A</td></tr>
						<tr><th>Adwords</th><td>N/A</td></tr>
					<?php endif;?>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
