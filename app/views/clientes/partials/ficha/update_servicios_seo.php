
				<div id="response-servicios-seo"></div>
				<div class="ajax-request">
					<form action="<?= $data['action'] ?>"  method="POST" class="servicios-seo">
						<input type="hidden" name="type" value="update_servicios_seo" class="ignore">
						<p>
							<label for="Adwords">SEO</label>
							<select name="seo" id="seo" class="form-control">
								<option value="N/A">N/A</option>
								<option value="SI">Si</option>
								<option value="NO">No</option>
							</select>		
						</p>						
						<p>
							<label for="rediseno">Rediseño</label>
							<select name="rediseno" id="rediseno" class="form-control">
								<option value="N/A">N/A</option>
								<option value="SI">Si</option>
								<option value="NO">No</option>
							</select>
						</p>
						<p>
							<label for="branding">Branding</label>
							<select name="branding" id="branding" class="form-control">
								<option value="N/A">N/A</option>
								<option value="SI">Si</option>
								<option value="NO">No</option>
							</select>						
						</p>
						<p>
							<label for="contenidos">Contenidos</label>
							<textarea name="contenidos" id="contenidos" rows="4" class="form-control"></textarea>
						</p>
						
						<p>
							<label for="smm">Social Media</label>
							<textarea name="smm" id="smm" class="form-control"></textarea>
						</p>
						<p>
							<label for="crm">CRM</label>
							<select name="crm" id="crm" class="form-control">
								<option value="N/A">N/A</option>
								<option value="SI">Si</option>
								<option value="NO">No</option>
							</select>							
						</p>
						<p>
							<label for="hosting">Hosting</label>
							<select name="hosting" id="hosting" class="form-control">
								<option value="N/A">N/A</option>
								<option value="SI">Si</option>
								<option value="NO">No</option>
							</select>							
						</p>
						<p>
							<label for="dominio">Dominio</label>
							<select name="dominio" id="dominio" class="form-control">
								<option value="N/A">N/A</option>
								<option value="SI">Si</option>
								<option value="NO">No</option>
							</select>							
						</p>	
						<p>
							<label for="enlaces">Link building</label>
							<select name="enlaces" id="enlaces" class="form-control">
								<option value="N/A">N/A</option>
								<option value="SI">Si</option>
								<option value="NO">No</option>
							</select>		
						</p>						
						<p>
							<label for="Adwords">Adwords</label>
							<select name="adwords" id="adwords" class="form-control">
								<option value="N/A">N/A</option>
								<option value="SI">Si</option>
								<option value="NO">No</option>
							</select>		
						</p>							
						<p>
							<button type="submit" class="btn btn-primary">Guardar</button>
						</p>			
					</form>
					<script type="text/javascript">
						var data = <?= $data['servicios'] ? $data['servicios']: 'null'; ?>;
						if(data != null ){
							for(var key in data){
								var element = jq("#" + key);

								if( jq(element).is('textarea') )
									jq(element).val(data[key]);
								else if( jq(element).is('select') ){

									jq("#" + key + " option").each(function(index, value){
										if( value.value == data[key] ){
											jq(element).prop("selectedIndex", index);
										}
									});
								}
							}		
						}				
					</script>
				</div>
