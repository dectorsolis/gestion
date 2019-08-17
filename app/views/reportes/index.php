<section>
	<div class="container">
		<div class="row">
			<h1><?= $data['titulo'] ?></h1>
			<table class="table">
				<tr>
					<tr>
						<th>ID </th>
						<th>Empresa </th>
						<th>Ingreso </th>
					</tr>
				</tr>
				<tbody>
					<?php $clientes = $data['clientes']; ?>
					<?php for( $i = 0; $i< count($clientes); $i++ ):?>
						<tr>
							<td><?= $clientes[$i]['id_cliente'] ?></td>
							<td><?= $clientes[$i]['dominio'] ?></td>
							<td><?= $clientes[$i]['fecha_ingreso'] ?></td>
						</tr>
							
					<?php endfor?>
				</tbody>
			</table>
		</div>

		<pre><?php print_r($data['clientes']); ?></pre>
	</div>
</section>
