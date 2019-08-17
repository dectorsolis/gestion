<?php 
	
	class Clientes extends Controller{
		
		public function __construct(){
			
		}
		
		public function index($id = 0, $status = 1){
			$data = [];
			$id_region = " '%' ";
			$cliente = $this->model('cliente');
			$region = $this->model('region');
			
			
			if(isset($_POST['filtro_regiones'])  &&  is_numeric($_POST['filtro_regiones'])){
				$id_region = $_POST['filtro_regiones'];
			}

			$data = array(
				"titulo" => "Listado general de clientes",
				"cliente" => $cliente->get_clientes($id, $status, $id_region),
				"activos" => $cliente->get_activos(),
				"inactivos" =>  $cliente->get_inactivos(),
				"regiones" => $region->get_regiones()
			);


			$this->view( "clientes/index", $data );
		}

		public function nuevo(){

			if( $_POST ){		

					$redirect = PATH . "clientes/nuevo/";

					$_POST['activo'] = 1;
					
					if( $this->prueba_de_post( $_POST, "cliente", "create") ){
						
						$id_cliente = $this->get_model_response();

						if( $id_cliente != 0){

							$nuevo_integrante = array(
								'id_cliente' => $id_cliente,
								'id_empleado' => $this->helper("helper_usuarios")->get_id_empleado()
							);					

							$mensajes = array(
								"success" => "Has completado el registro del nuevo cliente, adicionalmente también has sido agregado a la ficha técnica",
								"danger" => "No se pudo crear la ficha técnica, ocurrió un problema contacta a tu programador"
							);

							if( $this->prueba_de_post( $nuevo_integrante, "proyecto", "agregar_integrante", $mensajes) )
								$redirect = PATH . "clientes/ficha/" . $id_cliente;
						}
					}
					header("Location: " . $redirect);
					exit();
			}

			$region = $this->model("region");
			$membresia = $this->model("membresia");
			
			$data = array(
				'titulo'	=> 'Registrar nuevo cliente',
				'action' 	=> PATH . "clientes/nuevo/",
				'regiones'	=> $region->get_regiones(),
				'membresias' => $membresia->get_membresias()
			);

			$this->view("clientes/nuevo", $data);
		}

		public function editar( $id = 0 ){
			
			$cliente = $this->model('cliente');
			
			if( $cliente->valido( $id ) ){
				
				if($_POST){

					$redirect =  PATH . "clientes/ficha/" . $id;

					$this->prueba_de_post($_POST, "cliente", "update");
					
					header("Location: " . $redirect);
					exit();
				}

				$region = $this->model('region');
				$membresia = $this->model('membresia');
				

				$update_data = $cliente->get_clientes($id);
					
				$data = array(
					'titulo'		=> "Editar info de " . $update_data[0]['dominio'],
					'update_data' 	=> $update_data,
					'action'		=> PATH . "clientes/editar/" . $id,
					'regiones'		=> $region->get_regiones(),
					'membresias'	=> $membresia->get_membresias(),
					'h1'			=> "Actualizar información"
				);

				$this->view("clientes/nuevo", $data);				
			}
			else
				$this->e404();
		}		

		public function eliminar(){

			$redirect = PATH . "clientes/"; 
			if($_POST){
				
				if( $this->prueba_de_post($_POST, "cliente", "delete") )
					$redirect .= "status/inactivo/";
			}
			header("Location: " . $redirect);
			exit();
		}	
		
		public function status($status = "activo"){
			if($status === "activo")
				$this->index(0, 1);
			else if($status === "inactivo")
				$this->index(0, 0);
			else
				$this->index();
		}

		public function cambiar_status(){
			
			if($_POST){
				$this->prueba_de_post($_POST, "cliente","cambiar_status");
			}
			
			header("Location: " . PATH . "clientes/");
			exit();
		}	

		public function filtro(  ){

			if( $_POST ){

				if( !empty( $_POST['id_departamento'] ) )
				{
					$empleados = $this->model('empleado');
					
					$data = array(
						'action' 		=> PATH . "proyectos/agregar-integrante/",
						'empleados' 	=> $empleados->get_empleados_por_departamento( $_POST['id_departamento'] ),
						'id_cliente'	=> $_POST['id_cliente']
					);

					$this->view_nostyle('clientes/partials/ficha/select_menu_empleados', $data);
				}
			}

		}

		public function ficha( $id_cliente = 0){

			$cliente = $this->model('cliente');
			$usuario = $this->model('usuario');
			$acceso  = $this->model('acceso');
			
			$id_empleado = $this->helper('helper_usuarios')->get_id_empleado();
			$id_user = $this->helper('helper_usuarios')->get_id_usuario();
			
			if( $cliente->valido( $id_cliente ) ){
				
				/*Peticiones sobre la ficha*/
				if( $_POST ){
					$this->requests_ficha( $_POST , $id_cliente);
					exit();
				}
				$data = [];
				$vista = "clientes/ficha_cliente";
				$proyecto = $this->model('proyecto');
				$departamento = $this->model("departamento");
				$tipo_acceso = $this->model("tipo_acceso");
				$id_empleado = $this->helper('helper_usuarios')->get_id_empleado();
				
				$data_cliente =  $cliente->get_clientes( $id_cliente );

				if( $data_cliente ){
					
					$data = array(
					
					'titulo' => "Segundo paso de logística",
					'dominio' => $data_cliente[0]['dominio'],
					'href_ticket' => PATH . "tickets/nuevo/" . $id_cliente,
					'info_cliente'	=> array(
							'titulo' => "Datos del cliente",
							'datos' => $data_cliente[0]
						),
					'responsable_contenido' => array(
						'titulo' => "Responsable de contenido",
						'action_form' => PATH . "clientes/ficha/" . $id_cliente,
						'info_responsable' => json_decode( str_replace("\\", "", $data_cliente[0]['responsable_contenido']))
					),
					'info_keywords' => array(
							'titulo' => "Keywords",
							'keywords' => $data_cliente[0]['keywords'],
							'action_form_keywords' => PATH . "clientes/ficha/" . $id_cliente
						),
					'agregar_integrante' => array(
							'titulo' => 'Agregar integrantes',
							'deptos' => $departamento->get_departamentos(),
							'id_cliente' => $id_cliente
						),
					'directorio_proyecto' => array(
							'titulo'		=> "Directorio del proyecto",
							'integrantes' 	=> $proyecto->get_integrantes_del_proyecto( $id_cliente),
							'action_form_remover_integrante' => PATH . 'proyectos/remover-integrante/' . $id_cliente,
							'deptos' => $departamento->get_departamentos(),
							'id_cliente' => $id_cliente
						),
					'update_servicios_seo' => array(
							'titulo' => "Actualizar servicios SEO",
							'action' => PATH . "clientes/ficha/" . $id_cliente,
							"servicios" => str_replace( "\\","", $data_cliente[0]['servicios_seo'])
						),	
					'servicios_seo' => array(
							'titulo' => "Servicios SEO de la cuenta",
							'servicios' => json_decode( str_replace( "\\","", $data_cliente[0]['servicios_seo']) ),
							'href_update_servicios_seo' => PATH . "clientes/update-servicios-seo/" . $id_cliente
						),
					'ficha_accesos'		=> array(
							'titulo' => "Accesos",
							'accesos' => $acceso->get_acceso( $id_cliente ),
							'href_nuevo_acceso' => PATH . 'accesos/nuevo/' . $id_cliente
						),					
					'datos_varios'  => array(
							'titulo' => "Datos varios",
							'productos_servicios' => json_decode( str_replace( "\\","", $data_cliente[0]['datos_varios'] ) ),
							'action_form_servicios' => PATH . "clientes/ficha/" . $id_cliente
						),
					'informacion_directorios' => array(
							'titulo' => "Informacion para directorios",
							'directorios' => json_decode( str_replace( "\\","", $data_cliente[0]['info_directorios'] )),
							'action_form' => PATH . "clientes/ficha/" . $id_cliente, 
							'info' => ""
						)
					);
					
					$this->view( $vista, $data );
				}
				
			}
			else
				$this->e404();
		}

		public function requests_ficha( $request, $id_cliente ){

			if( isset( $request['type']) ){

				$response = [];
				$cliente = $this->model('cliente');
				
				switch( $request['type'] ){
					
					case 'update_keywords': 
						
						unset( $request['type'] ); 
						
						/*
						 *Verifica si existen keywords en el registro del cliente
						 */
						$keywords = $cliente->get_keywords( $id_cliente );
						if( $keywords != null ){
							//decodifico y preparo el array php
							$keywords = json_decode( str_replace("\\","",$keywords) );							
						}					
						else
							$keywords = [];
						
						//para incrustar en la vista
						$data = array(
							"keywords" => $keywords,
							"action" => PATH . "clientes/ficha/" . $id_cliente
						);				
						

						/*si existe una solicitud para nueva palabra clave*/
						if( isset( $request['keyword'] ) && isset( $request['busquedas'] )) {
						
							if( $keywords ){

								if( is_array( $request['keyword'] ) && is_array( $request['busquedas'] )){
									$keywords = [];
									foreach( $request['keyword'] as $i => $value)
										array_push( $keywords, array("keyword"=> $value, "busquedas"=> $request['busquedas'][$i] ) );
								}
								else//si hay 1 o mas keywords								
									$keywords[] = $request;
							}
							else //si no hay keywords en la BD
								$keywords[] = $request;
						}
						else
							$keywords = [];
						

						$keywords = json_encode( $keywords , JSON_UNESCAPED_UNICODE);
							
						$cliente->update_keywords( $keywords,  $id_cliente);
							
						$data["keywords"] = json_decode( $keywords );						
						
						/*Imprime la lista de keywords*/
						$this->view_nostyle( "clientes/partials/ficha/lista_keywords", $data);							

					break;
					
					case "update_datos_varios": 
						
						unset( $request['type'] ); 
						
						$datos_varios =  array( 
							"datos_varios" => json_encode( $request, JSON_UNESCAPED_UNICODE ),
							"id_cliente" => $id_cliente
						); 
						
						$this->prueba_de_post( $datos_varios, "cliente", "update_datos_varios");
						
						$response  = array(
							"type" => "redirect",
							"href" => PATH . "clientes/ficha/" . $id_cliente
						);						
								
					break;

					case "update_directorios": 
						unset( $request['type'] );

						$count_desc_corta = $this->helper("helpers")->count_words( $request['descripcion_corta'] );
						$count_desc_larga = $this->helper("helpers")->count_words( $request['descripcion_larga'] );
						
						if(  $count_desc_corta < 150 ){
							$response = array(
								"type" => "html",
								"msg" => "La descripción corta debe tener al menos 150 palabras, ingresaste: " . $count_desc_corta
							);
						}
						else if( $count_desc_larga < 250 ){
							$response = array(
								"type" => "html",
								"msg" => "La descripción larga debe tener al menos 250 palabras, ingresaste: " . $count_desc_larga
							);
						}
						else{

							$info_directorios = array(
								"info_directorios" => json_encode( $request , JSON_UNESCAPED_UNICODE),
								"id_cliente" => $id_cliente
							);

							$this->prueba_de_post( $info_directorios, "cliente", "update_info_directorios");
							
							$response  = array(
								"type" => "redirect",
								"href" => PATH . "clientes/ficha/" . $id_cliente
							);		
						}
										
					break;
					
					case "update_responsable_contenido": 
						
						unset( $request['type'] );
						
						$responsable_contenido = array(
							"responsable" => json_encode($request, JSON_UNESCAPED_UNICODE),
							"id_cliente" => $id_cliente
						);
						
						$this->prueba_de_post( $responsable_contenido, "cliente","update_responsable_contenido");
						
						$response = array(
							"type" => "redirect",
							"href" => PATH. "clientes/ficha/" . $id_cliente
						);
					break;
					
					case "edit_servicios_seo":
						
						$data = array(
							'titulo' => "Actualizar servicios SEO",
							'action' => PATH . "clientes/ficha/" . $id_cliente
						);
						
						$this->view_nostyle('clientes/partials/ficha/update_servicios_seo',$data );
						
					break;
					case "update_servicios_seo": 
						unset( $request['type'] );

						$servicios_seo = array(
							"servicios" => json_encode($request, JSON_UNESCAPED_UNICODE),
							"id_cliente" => $id_cliente
						);

						$this->prueba_de_post( $servicios_seo, "cliente", "update_servicios_seo");

						header("Location: " . PATH . "clientes/ficha/" . $id_cliente);

					break;
				}

				if( $response )
					echo json_encode( $response , JSON_UNESCAPED_UNICODE); 			
			}

		}

		public function lista(){

			$usuarios = $this->helper('helper_usuarios');
			$proyecto = $this->model('proyecto');

			$id_empleado = $usuarios->get_id_empleado();

			$data = array(
				"clientes_activos" => array(
						"titulo" => "Mis clientes activos",
						"lista" => $proyecto-> get_lista( $id_empleado)
					),					
				"clientes_inactivos" => array(
						"titulo" => "Mis clientes inactivos",
						"lista" => $proyecto-> get_lista( $id_empleado, false)	
					)
			);			
			
			$this->view('clientes/lista' , $data);
		}

		public function update_servicios_seo( $id_cliente ){
			$servicios_seo =  $this->model('cliente')->get_servicios_seo( $id_cliente );
			$data = array(
				'titulo' => "Actualizar servicios SEO",
				'action' => PATH . "clientes/ficha/" . $id_cliente,
				"servicios" => str_replace( "\\","", $servicios_seo[0]['servicios_seo'])
			);
			$this->view_nostyle("clientes/partials/ficha/update_servicios_seo", $data);
		}

		public function tickets($id_cliente){
			$helper_usuarios = $this->helper('helper_usuarios');
			$id_empleado = $helper_usuarios->get_id_empleado();

			$tickets_asociados = $this->model('cliente')->get_tickets_asociados( $id_cliente, $id_empleado);


			$data = array(
				"titulo" => "Historial de tickets",
				"tickets_asociados" => $tickets_asociados
			);
			$this->view("tickets/asociados", $data);
		}

	}

?>