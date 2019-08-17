		<div class="x_panel">
			<div class="x_title">
				<h3><?= $data['titulo'] ?></h3>
		        <div class="clearfix"></div>							
			</div>

			<div class="x_content">
				<table class="table">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Fecha ingreso</th>
						</tr>
					</thead>
					<tbody>
						<?php if( $data['aniversarios'] ): ?>
							<?php foreach( $data['aniversarios'] as $item): ?>
								<tr>
									<td>
										<img src="<?= gravatar( $item['email_empresa'], 40 ) ?>">
										<?= $item['nombre'] ?>
									</td>
									<td<?= $item['email_empresa'] ?>></td>
									<td><?= $item['fecha_ingreso'] ?></td>
								</tr>
							<?php endforeach; ?>

						<?php else:?>

							<strong>No hay registros</strong>

						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>