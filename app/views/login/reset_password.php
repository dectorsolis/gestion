<?php require_once INCLUDES . "response.php"; ?>
<!DOCTYPE>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0" />

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= PATH; ?>assets/css/login.css?v=1.0.1">
	</head>
	<body>
		<div class="container">		
			<div class="row login">
				<div class="col-md-6 col-md-offset-3">
					<?php require_once INCLUDES . "alerts.php"; ?>
				</div>		
				<div class="col-md-6 col-md-offset-3">
					<form class="op-form form-login" method="POST" action="<?= $data['action']; ?>" >
						<div class="row">
							<div class="col-md-3 col-xs-4">
								
								<div class="logo">
									<img src="<?= PATH . '/img/logo_big.png'; ?>" />
								</div>
								
							</div>
							<div class="col-md-9 col-xs-8">
								<h1 class="sigo">S.I.G.O</h1>
								<small>Sistema de Información General de Optimización</small>
							</div>							
						</div>	
						<br>
						<div class="row">
							<div class="col-md-12">
								<input 
									type="text" 
									id="user" 
									name="user"
									class="form-control"
									placeholder="Correo electrónico">
								<input type="hidden" name="type" value="reset-password">
							</div>
						</div>
						<br>					
						<div class="row">
							<div class="col-md-3 col-xs-6">
								<button type="submit" class="btn btn-success btn-submit">Enviar correo</button>
							</div>
							<div class="col-md-4 col-xs-6">
								<a class="btn btn-success" href="<?= PATH  ?>">
									Cancelar
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>