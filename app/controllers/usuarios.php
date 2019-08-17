<?php

	class Usuarios extends Controller{

		public function __construct(){

		}

		public function index(){
			$usuario = $this->model('usuario');

			$data = array(
				'titulo' => 'Control de usuarios del sistema',
				'usuarios' => $usuario->get_usuarios(),
				'href_cambiar_rol' => PATH . 'usuarios/cambiar-rol'
			);

			$this->view('usuarios/index', $data);
		}
		
		public function crear(){
			
			$redirect =  PATH . "empleados/";

			if( $_POST ){

				
				$modelo = $this->model("empleado");
				$id =  base64_decode( $_POST['token'] );

				$empleado = $modelo->get_empleados($id);

				if($empleado){

					$empleado = $empleado[0];
					$random_pass = $this->helper('helper_usuarios')->get_random_password();
					$user = array(
						'username'		=> $empleado['email_empresa'],
						'password'		=> md5($random_pass),
						'register_at'	=> date('Y-m-d'),
						'id_empleado'	=> $empleado['id_empleado'],
						'id_rol'		=> 3
					);

					$mensajes = array(
						'success' => 'Se creó la cuenta de usuario para: ' . 
									 '<strong>' . $user['username'] . '</strong> con password ' . 
									 '<strong>' . $random_pass . '</strong>'
					);

					if( $this->prueba_de_post( $user, "usuario" , "create", $mensajes ) ){
						
						$data_email = array(
							'username' => $user['username'],
							'password' => $random_pass,
						);

						$msg_email = $this->view_static('plantillas/email_bienvenida_sigo', $data_email);

						$this->helper("helpers")->email( $user['username'] , 'Accesos SIGO', $msg_email );

						header("Location:" . PATH . "empleados/" );
						exit();
					}
					
				}
				
			}

			header("Location: " . $redirect);
		}

		public function eliminar(){
	
			if( $_POST){
				
				$mensajes = array( 'success' => 'El usuario fue eliminado');

				$this->prueba_de_post( $_POST, 'usuario', 'delete', $mensajes);
			}

			header("Location: " . PATH . 'usuarios/');

		}
		public function ficha($id){
			if( empty($id) )
				header("Location: " . PATH . 'usuarios/');

			if( $_POST ){
				
				if( $this->prueba_de_post( $_POST, 'usuario', 'update_rol') ){
					header("Location: " . PATH  . 'usuarios/ficha/'. $id );
					exit();
				}
			}

			$usuario 	= $this->model('usuario');
			$rol 		= $this->model('rol');
			$data = array(
				'usuario' 	=> $usuario->get_usuarios( $id ),
				'roles'		=> $rol->get_roles()
			);
			$this->view('usuarios/ficha', $data);
		}

		public function perfil( $id_user = '' ){
			
			$usuario = $this->model('usuario');
			$data = [];

			/*Si el usuario final consulta el perfil de otro usuario*/
			if( !empty( $id_user) ){
				
				if( $usuario->valido( $id_user ) ){

					$info_usuario = $usuario->get_info_usuario( $id_user );
					$info_usuario[0]['total_prospectos'] = $usuario->get_total_prospectos( $id_user );
					$info_usuario[0]['tickets_resueltos'] = $usuario->get_total_tickets_resueltos( $id_user );
					$data = array(
						'titulo_p1' => 'Información',
						'titulo_p2' => 'Sobre mí',
						'titulo_p3' => 'Trayectoria',
						'info_usuario' => $info_usuario
					);

					$this->view('usuarios/perfil', $data);
				}
				else
					header("Location: " . PATH . 'usuarios/perfil/');
			}

			else{
				$id_user = $this->helper('helper_usuarios')->get_id_usuario();
				if( $usuario->valido( $id_user ) )
					$this->perfil( $id_user );
			}			

		}

		public function cambiar_rol( $id_user = 0){

			if( $_POST ){

				if( isset( $_POST['tipo'] ) )
				{
					switch( $_POST['tipo'] )
					{
						case 'get_roles': 

							$usuario = $this->model('usuario');

							if( $usuario->valido( $id_user ) ){
								
								$rol = $this->model('rol');

								$data = array(
									'roles' 	=> $rol->get_roles(),
									'id_rol' 	=> $_POST['id_rol'],
									'id_user' 	=> $id_user,
									'action_form' => PATH . 'usuarios/cambiar-rol/'
								);

								$this->view_nostyle("usuarios/cambiar_rol", $data);
							}

						break;

						case 'update_rol': 
							
							$user = array(
								'id_rol' => $id_rol = $_POST['rol'],
								'id_user' => $id_user = $_POST['id_user']
							);

							$href = PATH . 'usuarios/';
							$msg  = 'El rol ha sido actualizado...';

							if( !$this->model('usuario')->update_rol( $user ) )
								$msg  = 'Ocurrió un problema al actualizar el rol...';
							
							$data = array( 'href' => $href, 'msg'  => $msg );							

							$this->view_nostyle('usuarios/respuesta_cambio_de_rol', $data);								

						break;
					}
				}
			}
			//header("Location: " . PATH . 'usuarios/');
		}
		
		public function mi_agenda( $fecha = null ){
			
			$response = array();
			$agenda = array();
			$fecha = $fecha == null ? date("Ymd") : $fecha;
			$usuario = $this->model("usuario");
			$id_user = $this->helper("helper_usuarios")->get_id_usuario();
			
			if( isset($_POST["actividades"] ) ){
				json_encode( $_POST );
				
				
				$agenda = $usuario->get_agenda( $id_user);
				
				$agenda = json_decode( str_replace("\\","", $agenda[0]["mi_agenda"]) );
				$actividades =  json_decode( $_POST["actividades"] );
				
				if( $agenda == null)
					$agenda[$fecha] = $actividades;//si el puntero esta vacio
				else 
					$agenda->$fecha = $actividades; //si existe contenido en el puntero
				
				$agenda = json_encode($agenda, JSON_UNESCAPED_UNICODE);
				
				if( $usuario->update_agenda( $agenda, $id_user ) ){
					$response = array(
						"type" => "redirect",
						"href" => $_POST['url_redirect']
					);
				}
				else{
					$response = array(
						"type" 	=> "html",
						"msg" 	=> "No se realizó ningún cambio en tu agenda"
					);
				}
				
				if( $response )
					echo json_encode($response);
			}
		}
			
	}
?>