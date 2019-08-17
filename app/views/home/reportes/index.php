<section>
	<div class="container">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Dominio</th>
						<th>Empresa</th>
						<th></th>
						<th></th>
						<th>Fecha ingreso</th> 
					</tr>
				</thead>
				<tbody>
				<?php foreach($data['clientes'] as $item): ?>
					<tr>
						<td><?= $item['id_cliente'] ?></td>
						<td><?= $item['dominio'] ?></td>
						<td><?= $item['nombre_empresa'] ?></td>
						<th>
							<a href="<?= PATH . 'clientes/ficha/' . $item['id_cliente'] ?>">Ficha</a></th>
						<th>Solicitar Bitácora</th>						
						<td><?= $item['fecha_ingreso'] ?></td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<pre><?php print_r($data); ?></pre>