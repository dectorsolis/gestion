<?php
	class Cuenta extends Controller{


		public function index(){
			
			if( $_POST ){
				$this->requests_cuenta( $_POST );
				exit();
			}
			$empleado = $this->model('empleado');
			$depto = $this->model('departamento');
			$region = $this->model('region');

			$id_empleado = $this->helper('helper_usuarios')->get_id_empleado();

			$data = array(
				'titulo' 	=> 'Configuración de la cuenta',
				'titulo1' 	=> 'Cambiar contraseña',
				'titulo2'	=> 'Editar información personal',
				'titulo3'	=> 'Acerca de mi',
				'info_personal' => $empleado->get_empleados( $id_empleado ),
				'deptos' => $depto->get_departamentos(),
				'regiones' => $region->get_regiones(),
				'action_sobremi' => PATH . "cuenta",
				'action_form_update_info' => PATH . 'cuenta/editar_informacion/',
				'action_form_update_pass' => PATH . 'cuenta/cambiar-password/'
			);

			$this->view( 'cuenta/index', $data);
		}
			
		public function requests_cuenta( $request ){
			
			switch( $request['type'] ){
				
				case "update_sobremi": 
					unset( $request['type'] );
					if( $this->prueba_de_post($request, "usuario", "update_about") ){
						echo json_encode(
							array(
								"type" => "redirect",
								"href" => PATH . "cuenta/"
						), JSON_UNESCAPED_UNICODE);
					}
				break;
			}
		}
		
		public function actualizar(){
			$id_rol =  $this->helper('helper_usuarios')->get_id_rol();
			$privilegios = $this->model('rol')->get_privilegios( $id_rol );

			if ( $_SESSION['op_user_session'][0]['privilegios'] = $privilegios[0]['privilegios'] ){

				$_SESSION['response'] = array(
					'type' => "success",
					'message' => "Tu cuenta se actualizó correctamente"
				);	
			}

			header("location: " . PATH . 'cuenta/' );
	
		}

		public function editar_informacion(){
			
			if( $_POST )
				$this->prueba_de_post( $_POST, 'empleado', 'update');

			header("Location: " . PATH . 'cuenta/');
		}

		public function cambiar_password(){

			if( $_POST ){

				if( isset( $_POST['pass'] ) ) {
					
					$update = array(
						'password' => $_POST['pass'],
						'id_user'  => $this->helper('helper_usuarios')->get_id_usuario()
					);

					$mensajes = array('success' => 'En tu siguiente sesión utiliza tu nuevo password <strong>' . $_POST['pass'] . '</strong>');

					$this->prueba_de_post( $update, 'usuario', 'update_password', $mensajes);
				}
					
				
			}

			header("Location: " . PATH . 'cuenta/' );
		}

	}
?>