
<!-- response keywords via ajax -->
		<?php if( $data['keywords'] ): ?>
			<?php $keywords = $data['keywords']; ?>
			
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th> Término </th>
							<th> Búsquedas</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach( $keywords as $index => $item ):?>
						<tr id="list-key-<?= $index ?>">
							<td> <?= $index + 1; ?> </td>
							<td> <?= $item->keyword; ?> </td>
							<td> <?= $item->busquedas; ?> </td>
							<td> 
								<a href="#" data-li-id ="<?= $index ?>" class="key"> 
									<span style="color:red; font-size:15px;" class="fa fa-remove"> </span>
								</a> 
							</td>
						</tr>
						<?php endforeach; ?> 	
					</tbody>				
				</table>
				
				<form 
					method ="POST" 
					action ="<?= $data['action']; ?>" 
					class ="form-ajax hidden-keywords" 
					data-id-response = "response-keywords" 
					data-response-method="html" 
					data-id-loader="#response-keywords">

					<input type="hidden" name="type" value="update_keywords"/>
					<?php foreach( $keywords as $index => $item ): ?>
						<input type="hidden" class="input-key-<?= $index; ?>" name="keyword[]" value="<?= $item->keyword; ?>" class="form-control" readonly>
						<input type="hidden" class="input-key-<?= $index; ?>" name="busquedas[]" value="<?= $item->busquedas; ?>" class="form-control" readonly>
					<?php endforeach; ?>
					<button style="display:none;" class="btn btn-primary" type="submit">Guardar ajustes</button>
				</form>
		<?php else: ?>	
			<strong>No hay keywords asignadas</strong>
		<?php endif; ?>
<!-- Fin response keywords via ajax -->