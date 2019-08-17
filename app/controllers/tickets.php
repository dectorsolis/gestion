<?php

	class tickets extends Controller{

		public function __construct(){

		}

		public function index(){
			$ticket = $this->model('ticket');
			$helper = $this->helper('helpers');

		    $data = array(
		    	'tickets' =>  $ticket->get_tickets()
		    );
		    
		    $this->view("tickets/index", $data);
		}

		public function nuevo($id_cliente = 0){
				
			$data = [];
			
			$usuarios 	= $this->helper('helper_usuarios');
			$proyectos 	= $this->model('proyecto');
			$depto 		= $this->model('departamento');
			$cliente 	= $this->model('cliente')->get_basic_info( $id_cliente );
			$ticket 	= $this->model('ticket');
			$helper = $this->helper("helpers");

			if( $_POST){
								
				
				if( $valida_form = $helper->empty_fields( $_POST ) ){
					$data_response = $this->set_mensaje('danger', $mensajes, "Por favor completa los siguientes campos", $valida_form);
				}
				else{

					if( $this->cargar( $_FILES['evidencia'] ) ){

						$array_files = $_FILES['evidencia']['name'];

						$_POST['evidencia'] = serialize( $array_files );

					}	

					
					if( $id_ticket = $ticket->create( $_POST ) ){

						$data_response = $this->set_mensaje('success', $mensajes, "Acción completada correctamente");

						$empleado = $this->model("ticket")->get_email_destinatario( $_POST['destinatario'] )[0];

						$data_email = array(
							"nombre" => $empleado["nombre"],
							"asunto" => $_POST["asunto"],
							"sitio" => $cliente[0]['dominio'],
							"emisor" => $usuarios->get_username(),
							"prioridad" => $_POST["prioridad"],
							"body" 	=> $_POST["descripcion"],
							"id_ticket" => $id_ticket
						);

						$msg_email = $this->view_static('plantillas/email_nuevo_ticket', $data_email);

						$this->helper("helpers")->email( 
							$empleado['email_empresa'], 
							$_POST['asunto'],
							$msg_email
						);	


					}
				}

				$data_response["data_form"] = $_POST;
				$_SESSION["response"] = $data_response;
				header("Location:" . PATH . "tickets/nuevo/" . $id_cliente );
				exit();
				
			}


			if( $cliente ){
				
				$dominio 	= $cliente[0]['dominio'];
				$id_cliente = $cliente[0]['id_cliente'];
				$id_empleado = $this->helper('helper_usuarios')->get_id_empleado();

				$data =  array(
					'titulo' 		=> $dominio,
					'integrantes'	=> $proyectos->get_integrantes( $id_cliente, $id_empleado ),
					'action'   		=> PATH . 'tickets/nuevo/' . $id_cliente,
					'id_cliente'	=> $id_cliente
				);

				$this->view("tickets/nuevo", $data );
			}
			else{

				$data = array(
					'titulo' => 'Crear nuevo ticket',
					'clientes'		=> $proyectos->get_proyectos_de_empleado( $usuarios->get_id_empleado() )
				);
				$this->view("tickets/nuevo_con_seleccion_cliente", $data );
			}

		}

		public function ficha( $id_ticket = 0  ){
				
			$ticket 	= $this->model('ticket');
			$proyecto 	= $this->model('proyecto');

			/*Para actualizaciones del ticket*/
			if( $_POST ){

				$redirect = PATH;

				if( isset( $_POST['type'] ) ){

					switch( $_POST['type'] ){

						case "delegar":

							unset( $_POST['type'] );
							$_POST['id_ticket'] = $id_ticket;
							$mensajes = array( 
								'success'	=> 'El ticket #' . $id_ticket . ' ha sido delegado correctamente',
								'warning' 	=> 'Ocurrió un problema al intentar delegar el ticket #' . $id_ticket
							);
							$this->prueba_de_post( $_POST, 'ticket', 'delegar_ticket', $mensajes);
							$redirect = PATH . "tickets/asociados/";

						break;
					}
				}
				
				header("Location: " . $redirect);
				exit();				
			}

			/*se procesan los datos y se presenta info del ticket*/
			if( $ticket->valido( $id_ticket ) ){

				$usuarios = $this->helper('helper_usuarios');
				$info_ticket = $ticket->get_tickets( $id_ticket);
				$id_cliente = $info_ticket[0]['id_cliente'];
				$id_emisor  = $info_ticket[0]['id_emisor'];
				$id_destino = $info_ticket[0]['id_destinatario'];

				if( $id_emisor != $usuarios->get_id_empleado() ){
					$data = array(
						
						"id_ticket" => $info_ticket[0]["id_ticket"],
						"prioridad" => $info_ticket[0]["prioridad"],
						"id_estado" => $info_ticket[0]["id_estado"],
						"estado" => $info_ticket[0]["estado"],
						"id_cliente" => $info_ticket[0]["id_cliente"],
						"estado_ticket" => array(
							"title" => "Modificar estado del ticket",
							"id_ticket" => $info_ticket[0]["id_ticket"],
							"id_estado" => $info_ticket[0]["id_estado"],
							"action_estado_ticket_form" => PATH . "tickets/cambiar-estado/",
							"estado_ticket"	=> $ticket->get_estados()
						),
						"info_ticket" => array(
							"info" => $info_ticket[0],
							"title" => "Información del ticket",
							"id_empleado" => $usuarios->get_id_empleado()
						),
						"empleado_asignado" => array(
							"title" 	=> "Empleado asignado",
							"id_destinatario" => $info_ticket[0]["id_destinatario"],
							"id_empleado" => $usuarios->get_id_empleado(),
							"destinatario"	=> $ticket->get_info_destinatario( $id_ticket )
						),
						"mensaje_ticket" => array(
							"asunto" => $info_ticket[0]["asunto"],
							"descripcion" => str_replace( array('\n','\r'), '<br>', $info_ticket[0]["descripcion"] )
						),
						"evidencia_ticket" => array(
							"title" => "Evidencia del ticket",
							"evidencia" => $info_ticket[0]["evidencia"]
						),
						"observaciones" => array(
							"title" => "Comentarios finales",
							"observaciones" => str_replace( array('\n','\r'), '<br>', $info_ticket[0]["observaciones"] )
						),
						"agregar_observacion" => array(
							"title" => "Agregar un comentario",
							"id_ticket" => $info_ticket[0]["id_ticket"],
							"action" => PATH . "tickets/agregar-comentario/"
						),
						"delegar_ticket" => array(
							"title" => "Delegar ticket",
							"id_ticket" => $info_ticket[0]["id_ticket"],
							'integrantes_proyecto' => $proyecto->get_integrantes( $id_cliente, $id_emisor, $id_destino ),
						)

					);
				}	
				else{
					$data = array(
						
						"id_ticket" => $info_ticket[0]["id_ticket"],
						"prioridad" => $info_ticket[0]["prioridad"],
						"id_estado" => $info_ticket[0]["id_estado"],
						"estado" => $info_ticket[0]["estado"],
						"info_ticket" => array(
							"info" => $info_ticket[0],
							"title" => "Información del ticket",
							"id_empleado" => $usuarios->get_id_empleado()
						),
						"empleado_asignado" => array(
							"title" 	=> "Empleado asignado",
							"id_destinatario" => $info_ticket[0]["id_destinatario"],
							"id_empleado" => $usuarios->get_id_empleado(),
							"destinatario"	=> $ticket->get_info_destinatario( $id_ticket )
						),
						"mensaje_ticket" => array(
							"asunto" => $info_ticket[0]["asunto"],
							"descripcion" => $info_ticket[0]["descripcion"]
						),
						"evidencia_ticket" => array(
							"title" => "Evidencia del ticket",
							"evidencia" => $info_ticket[0]["evidencia"]
						),
						"observaciones" => array(
							"title" => "Observaciones",
							"observaciones" => str_replace( array('\n','\r'), '<br>', $info_ticket[0]["observaciones"] )
						)
					);					
				}

				if( $info_ticket[0]['id_destinatario'] == $usuarios->get_id_empleado() )
					unset( $data['destinatario'] );
				else{
					unset( $data['action_estado_ticket_form'] );
					unset( $data['estado_ticket'] );
				}
				

				$this->view( 'tickets/ficha', $data );
				
			}
			else
				$this->e404();
		}

		public function generados(){

			$helper_usuarios = $this->helper('helper_usuarios');
			$id_empleado = $helper_usuarios->get_id_empleado();

			$empleado = $this->model('empleado');
			$tickets_generados = $empleado->get_tickets_generados( $id_empleado );

			$data =  array(
				'titulo' 				=> "Mis tickets generados",
				'tickets_generados' 	=> $tickets_generados
			);
			$this->view("tickets/generados", $data);
		}

		public function asociados( $limite = "" ){

			$helper_usuarios = $this->helper('helper_usuarios');
			$id_empleado = $helper_usuarios->get_id_empleado();

			$empleado = $this->model('empleado');
			$tickets_asociados = $empleado->get_tickets_asociados( $id_empleado, $limite );	

			$data = array(
				'titulo' 			=> "Tickets asociados a mi perfil",
				'tickets_asociados' => $tickets_asociados
			);
			$this->view("tickets/asociados", $data);
		}

		public function cambiar_estado(){
			
			$redirect =  PATH ;

			if( $_POST ){

				$ticket = $this->model("ticket");
				$usuarios 	= $this->helper('helper_usuarios');
				
				
				$mensajes = array( 'success' => 'El ticket cambió de estado correctamente' );
					
				$status = array(
					'id_estado' => $_POST['id_estado'],
					'fecha_modificacion' => date('Y-m-d'),
					'id_ticket' => $_POST['token'], 
					'estado_actual' => $ticket->get_estado( $_POST['token'] )[0]['id_estado']
				);	

				if( $this->prueba_de_post( $status, 'ticket', 'set_estado', $mensajes)){
					
					$ticket = $this->model('ticket');
					$info = $ticket->get_tickets( $_POST['token'] )[0];

					$data_email = array(
						"nombre" 	=> $info["nombre"],
						"id_ticket" => $info["id_ticket"],
						"fecha_creacion" => $info["fecha_creacion"],
						"asunto" => $info["asunto"],
						"sitio" 	=> $info["cliente"],
						"remitente" => $usuarios->get_nombre_usuario(),
						"estado" 	=> $info["estado"]
					);

					$msg_email = $this->view_static("plantillas/email_status_ticket", $data_email);
					
					$this->helper("helpers")->email(
						$info["email_empresa"],
						"Seguimiento ticket #" . $info["id_ticket"] . " - " . $info["estado"],
						$msg_email
					); 

					$redirect = $_POST['redirect'];						
				}
			}
			header("Location: " . $redirect);
		}

		public function cargar( $imagenes ){
			
			if( $imagenes ){

				$type	= $imagenes['type'];
				$error 	= $imagenes['error']; 
				$f 	= $imagenes['tmp_name'];
				$name 	= $imagenes['name'];

				foreach( $f as $index => $file){
					if( $error[$index] == 0 && $type[$index] == 'image/png' || $type[$index] == 'image/jpeg')
						move_uploaded_file( $file, MAIN_ROOT . '/uploads/evidencia/' . basename( $name[$index] ) );
					else
						return false;
				}

				return true;
			}

			return false;	
		}
		
		public function agregar_comentario(){
			
			$ticket = $this->model('ticket');
			$data = [];
			$redirect = PATH;
			
			if($_POST){

				unset($_POST['files']);

				if( $ticket->valido( $_POST['id_ticket'] ) ){
					$redirect = PATH . 'tickets/ficha/' . $_POST['id_ticket'];
					$mensajes = array( 'success' => 'Se añadió tu observación a la ficha del ticket');
					$this->prueba_de_post( $_POST, 'ticket','set_comentario', $mensajes);
				}
			
			}
			header("Location: " . $redirect);		
		}
		
		public function eliminar_tickets(){
			if( $_POST ){
				if( isset( $_POST['acciones'] )  ){
					
					switch( $_POST['acciones'] ){
						case 1: 
							
							foreach( $_POST['tickets'] as $id_ticket){
								
								$ticket = $this->model('ticket');
								
								if( $ticket->valido( $id_ticket) ){
									
									$tmp = array( 'id_Ticket' => $id_ticket );
									$this->prueba_de_post( $tmp, 'ticket', 'delete');
								}
							}	
							
						break;
					}
				}
			}
			
			header("Location: " . PATH . 'tickets/');
			exit();
		
		}

		public function get_total_tickets_asociados(){
			$usuarios = $this->helper('helper_usuarios');
			$ticket = $this->model('ticket');
			echo $ticket->get_total_tickets_asociados( $usuarios->get_id_empleado() );
		}
		
		public function get_last_tickets(){
			$usuarios = $this->helper("helper_usuarios");
			$empleado =  $this->model("empleado");
			$data = $empleado->get_ultimos_tickets_asociados( $usuarios->get_id_empleado());
			
			echo $this->view_nostyle("tickets/last_tickets", $data);
		}
		public function historial( $id_cliente ){
			echo $id_cliente;
		}

	}
?>