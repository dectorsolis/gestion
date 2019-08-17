<?php 
	/*Controlador empleados*/
	class Empleados extends Controller{

		public function index( $status = 1 ){

			$data = [];
			$empleado = $this->model("empleado");
			$depto = $this->model("departamento");
			$region = $this->model("region");
			$helper = $this->helper("helpers");
			
			$id_departamento = '%';
			$id_region = '%';

			if( isset( $_POST['ordenar_por'] ) ){
				$orderby = $helper->orderby( $_POST['ordenar_por'] );
			}
			if( isset( $_POST['filtro_departamento'] ) && is_numeric( $_POST['filtro_departamento'] ) ){
				$id_departamento = $_POST['filtro_departamento'];
			}			
			
			if( isset( $_POST['filtro_region'] ) && is_numeric( $_POST['filtro_region'] ) ){
				$id_region = $_POST['filtro_region'];
			}
			
			$data = array(
				'valido' => $status,
				'action_filtros' => $status ? PATH . "empleados/" : PATH . "empleados/status/inactivo/" ,
				'empleado' 	=> $empleado->get_lista_general(
					array(
						'activo' => $status,
						'depto' => $id_departamento,
						'region' => $id_region
					)
				),
				'activos'  	=> $empleado->get_activos(),
				'inactivos' => $empleado->get_inactivos(),
				'departamento' => $depto->get_departamentos(),
				'regiones' => $region->get_regiones(),
				'action_create_user' => PATH . 'usuarios/crear/',
				'titulo' => "Relación general de empleados",
				'action-vinculacion' => PATH . 'empleados/vinculacion/',
				'msg-vinculacion' => '¿Estás seguro?, se vinculará al empleado con todos los proyectos'
			);
	
			$this->view("empleados/index", $data);
		}

		public function nuevo(){

			if($_POST){
				$this->prueba_de_post($_POST, "empleado", "create");
			}
				
			/*Para cargar departamentos*/
			$depto = $this->model( "departamento" );
			$region = $this->model( "region" );

			$data = array(
				'departamentos' => $depto->get_departamentos(),
				'regiones'		=> $region->get_regiones(),
				'action'		=> PATH . "empleados/nuevo/",
				'titulo'		=> 'Alta de información de empleado'
			);
		
			$this->view("empleados/nuevo", $data);
		}

		public function editar($id = 0){
			
			if( empty($id) )
				header("Location: " . PATH . "empleados/");

			if($_POST){
				$this->prueba_de_post($_POST, "empleado", "update");				
			}

			$data = array("titulo" => "Editar información del empleado");
			$data['action'] = PATH . "empleados/editar/" . $id . "/";

			$modelo = $this->model("empleado");
			$data['update_data'] = $modelo->get_empleados($id);

			$modelo = $this->model("departamento");
			$data['departamentos'] = $modelo->get_departamentos();

			$modelo = $this->model( "region" );
			$data['regiones'] = $modelo->get_regiones();			

			$this->view("empleados/nuevo", $data);
		}

		public function vinculacion(){
			if( $_POST ){
				$this->prueba_de_post( $_POST, "proyecto", "vinculacion_masiva");
			}

			header("Location: " . PATH .  "empleados/");
		}
		public function eliminar(){		
			$redirect = PATH . "empleados/";
			
			if($_POST){
				
				if ( !$this->prueba_de_post($_POST, "empleado", "delete") )
					$redirect = "status/inactivo/";
			}

			header("Location: " . $redirect);
		}

		public function cambiar_status( $type = "" ){
			if( $_POST){

				if( $type == "lotes" ){
					$_POST['idEmpleados'] = implode(',', $_POST['idEmpleados']);
					
					if($this->prueba_de_post( $_POST, "empleado",  "cambiar_status")){
						echo json_encode(array(
								"status" => true,
								"href" => PATH . "empleados/"));
					}
				}
				else{
					$this->prueba_de_post($_POST, "empleado", "cambiar_status");
					header("Location: " . PATH . "empleados/");
				}
			}
				
		}

		public function status($status = "activo"){
			if($status === "activo")
				$this->index(1);
			else if($status === "inactivo")
				$this->index(0);
			else
				$this->index();
		}		

		public function ficha( $id_empleado = 0 ){

			if( isset( $id_empleado) ){
			
				$data = [];
				$vista = "empleados/ficha_empleado";

				/*Empleado*/
				$empleado = $this->model("empleado");

				if( $empleado->valido( $id_empleado ) ){
					
					$proyectos = $this->model("proyecto");
					$prospectos = $this->model('prospecto');
					$usuario = $this->model("usuario");

					$id_user = $usuario->get_id_usuario( $id_empleado );
					$info_empleado = $empleado->get_empleados( $id_empleado );
					$proyectos = $proyectos->get_proyectos_de_empleado( $id_empleado );
					$prospectos = $prospectos->get_prospectos_por_empleado( $id_empleado );
					$tickets_generados = $empleado->get_tickets_generados( $id_empleado );
					$tickets_asociados = $empleado->get_tickets_asociados( $id_empleado, 'todo' );	
					

					$data = array(
						
						"estadisticas" => array(
								"titulo" => "Trayectoria",
								"estadisticas" => (object)$empleado->get_totales( $id_empleado )[0]
							),
						"proyectos" => array(
							"titulo" => "Proyectos donde está involucrado",
							"proyectos" => $proyectos
							),
						"prospectos" => array(
							"titulo" => "Prospectos",
							"prospectos" => $prospectos
							),
						"tickets_generados" => array(
							"titulo" => "Tickets generados",
							"tickets_generados" => $tickets_generados
							),
						"tickets_asociados" => array(
							"titulo" => "Tickets asociados",
							"tickets_asociados" => $tickets_asociados
							),
						"agenda_empleado" => array(
							"titulo" => "Agenda del empleado",
							"agenda" => json_decode(str_replace("\\","", $usuario->get_agenda( $id_user )[0]["mi_agenda"]))
							)
					);

					$this->view($vista, $data);
				}
				else{
					
					$this->e404();
				}

			}			
		}

		public function equipos( $id_region = 0){

			$region = $this->model("region");

			if( $region->valida( $id_region ) ){

				$empleado = $this->model("empleado");
				$data =  array(
					"title" => "Equipo de " . $region->get_nombre( $id_region)[0]['nombre'],
					"equipo" => $empleado->get_info_equipo(
						array(
							"activo" => 1,
							"depto" => '%',
							"region" => $id_region
						)
					)
				);

				$this->view("empleados/equipos", $data);
			}
			else
				header("Location:" . PATH 	);
		}

	}

?>