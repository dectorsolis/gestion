<?php
	
	class Departamentos extends Controller{

		public function index(){

			$data = [];

			if( isset($_POST['token']) ){

				$vista = "generico/total_items";
				$modelo = $this->model("departamento");

				$data = [
							'titulo_panel' => "Relaciones de empleados",
							'total_empleados' => 27];	
				$this->view($vista, $data);			
			}
			else{
				$vista = "generico/tabla";
				$modelo = $this->model("departamento");

				$data = [	
							'nuevo' => PATH . "departamentos/nuevo/",
							'titulo_panel' => "Departamentos",
							'busqueda_placeholder' => "Buscar departamento",
							'texto_boton_agregar' => "Nuevo departamento",
							'th' => "Departamento",
							'item' => $modelo->get_departamentos(),
							'edit_url' => PATH . "departamentos/editar/",
							'delete_url' => PATH . "departamentos/eliminar/",
							'#' => "Empleados",
							'url_formulario_filtro' => "/gestion/public/empleados/",
							'item_nombre_filtro' => "filtro_departamento",
							'delete_message' => "¿Estás seguro de eliminar el departamento? esta acción es permanente y no se puede deshacer"];				 
				$this->view($vista, $data);
			}
		}

		public function nuevo(){
			
			if( $_POST ){
				
				$redirect = PATH . "departamentos/";

				if( ! $this->prueba_de_post( $_POST, "departamento", "create" ) )
					$redirect .= "nuevo/";

				header("Location: " . $redirect);
				exit();
			}

			$data = array(
				'action_form'  =>  PATH . "departamentos/nuevo/",
				'titulo_panel' => "Nuevo departamento",
				'placeholder'  => "Nombre del nuevo departamento"
			);
			
			$this->view("generico/formulario", $data);
		}

		public function editar($id = 0){
			
			if( !is_numeric($id) && $id == 0)
				header("Location: " . PATH . "departamentos/");
				
			if( $_POST ){

				$redirect = PATH . "departamentos/";

				if( !$this->prueba_de_post( $_POST, "departamento", "update" ) )
					$redirect .= "editar/$id/";

				header("Location: " . $redirect);
				exit();
			}
				

			$data = [];
			$modelo = $this->model("departamento");

			$data = [	
						'url_privilegios' => PATH . "departamentos/privilegios/" . $id,
						'action_form'  	=> PATH . "departamentos/editar/$id/",
						'update_data'  	=> $modelo->get_departamentos($id),
						'titulo_panel' 	=> "Editar departamento",
						'placeholder'	=> "Nombre del Departamento"
					];
			$this->view("generico/formulario", $data);
		}

		public function eliminar(){

			if( $_POST ){
				$this->prueba_de_post( $_POST, "departamento", "delete" );
			}

			header("Location: " . PATH . "departamentos/");
		}

	}

?>