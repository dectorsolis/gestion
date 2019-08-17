<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2> <?= $data['titulo'] ?> </h2>
                    <ul class="nav navbar-right panel_toolbox">
                    	<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
            </div>

			<div class="x_content">
				<div class="row">
					<div class="col-md-6">
						<a href="<?= PATH . "prospectos/nuevo/" ?>">Agregar nuevo prospecto </a>			
					</div>
				</div>

		
				<?php require_once INCLUDES . "alerts.php"; ?>
				<div class="table-responsive">
					<table id="prospectos" class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Empresa</th>
								<th>Dominio</th>
								<th>Contacto</th>
								<th>Consultor</th>
								<th>Fuente</th>
								<th>Estatus</th>
							</tr>
						</thead>
						<tbody>
										            	
						</tbody>
					</table>	
				</div>            	    
			</div>


   		</div>
	</div>
</div>
<script type="text/javascript">
	var data = <?= $data['prospectos_json'] ?>;
	var row = "";
	jq(data).each(function(index, value){
		row += 	'<tr><td>'+ (index + 1 ) +'</td>'+
					'<td>'+ value.nombre_empresa +'</td>'+
					'<td>'+ value.dominio +'</td>'+
					'<td>'+ value.nombre_contacto +'</td>'+
					'<td>'+ value.nombre +'</td>'+
					'<td>'+ value.fuente +'</td>'+
					'<td><small class="estado estado-' + value.id_estatus +'">'+ value.descripcion +'</small></td>';
	});
	jq("#prospectos tbody").html(row);
</script>
<script type="text/javascript">
   	jq(document).ready(function() {
	    jq("#prospectos").DataTable();
	} );
</script>	
