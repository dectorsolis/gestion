<?php

	class Login  extends Controller{

		public function __construct(){

		}

		public function index( $action = "" ){
			
			$autenticacion = $this->model('autenticacion');
			$redirect = PATH ;

			//si el usuario no esta logueado tenemos acceso a las siguientes acciones
			/*1. Autenticarme
			 *2. Resetear password
			 */
			if( ! $this->is_user_logged() ){

				if( $_POST){

					switch( $_POST['type'] ){

						case "reset-password": 

							if( $autenticacion->email_valido( $_POST['user'] ) ){
								
								$password = $this->helper('helper_usuarios')->get_random_password();
								$user = array(
									'password' => md5( $password ),
									'username' => $_POST['user']
								);

								if( $autenticacion->restaurar_password( $user ) ){

									$msg = $this->view_static( "plantillas/email_reset_password", array('new_password' => $password));
									
									if( $this->helper('helpers')->email( $user['username'], 'Nueva contraseña', $msg ) ){

										$_SESSION['response'] = array(
											'type' 		=> "success",
											'message' 	=> "Se generó una nueva contraseña y la envíamos a tu email"
										);										
									}
								}

							}
							else{
								$_SESSION['response'] = array(
									'type' 		=> "danger",
									'message' 	=> "No hallamos en nuestra base de datos el correo que ingresaste"
								);
							}
												
						break;

						default: 

							$redirect = $_POST['redirect'];
							unset( $_POST['redirect'] );
							unset( $_POST['type'] );
							
							if( $user = $autenticacion->autenticar( $_POST ) ){
								$id_user 	= $user[0]['id_user'];
								$fecha 		= date('Y-m-d');
								$autenticacion->update_last_login( $id_user, $fecha );

								$_SESSION['op_user_session'] = $user; 

							}
							else{
								
								$_SESSION['response'] = array(
									'type'		=> "danger",
									'message'	=> "El usuario o contraseña que ingresaste son incorrectos",
									'data_form' => (object)$_POST
								);
							}
						break;
					}
					
					header('Location: ' . $redirect);
					exit();
				}

				switch( $action ){
					case 'reset': 
						$view = "login/reset_password";
					break;
					default: 
						
						$view = "login/index";
					break;
				}

				$data = array( 'action' => PATH . 'login' );
				$this->view_nostyle( $view, $data );
			}
			else
				header( "Location: " . PATH);


		}

		public function is_user_logged(){

			return isset( $_SESSION['op_user_session'] );
		}

		public function logout(){
			session_destroy();
			header("Location: " . PATH );
		}
		
		public function reset(){
			echo "mamadas";
		}
	}
?>