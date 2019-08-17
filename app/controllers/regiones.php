<?php
	
	class Regiones extends Controller{

		public function index(){
			$data = [];
			$vista = "generico/tabla";
			
			$modelo = $this->model("region");			
			$data = [	
							'nuevo' => PATH . "regiones/nuevo/",
							'titulo_panel' => "Regiones",
							'busqueda_placeholder' => "Buscar región",
							'texto_boton_agregar' => "Nueva región",
							'th' => "Región",
							'#' => "Clientes",
							'item' => $modelo->get_regiones(),
							'path' => PATH . "regiones/",
							'edit_url' => PATH . "regiones/editar/",
							'delete_url' => PATH . "regiones/eliminar/",
							'url_formulario_filtro' => "/gestion/public/empleados/",
							'item_nombre_filtro' => "filtro_region",
							'delete_message' => "¿Estás seguro de eliminar la oficina? esta acción es permanente y no se puede deshacer"];	

			$this->view("generico/tabla", $data);
		}

		public function nuevo(){
			$data = [];

			if($_POST){
				
				$redirect = "";

				if( $this->prueba_de_post( $_POST, "region", "create" ) )
					$redirect = PATH . "regiones/"; 
				else
					$redirect = PATH . "regiones/nuevo/";

				header("Location: " . $redirect);
				exit();
			}

			$data['action_form'] = PATH . "regiones/nuevo/";

			$data = [
				    	'action_form'	=> "/gestion/public/regiones/nuevo/",
				    	'titulo_panel' 	=> "Nueva región",
				    	'placeholder' 	=> "Nombre de la nueva región"	];

			$this->view("generico/formulario", $data);
		}

		public function editar($id = 0){
			$data = [];

			if( is_numeric($id) && $id != 0 ){

				if($_POST){
					
					$redirect = PATH . "regiones/";
					
					if( !$this->prueba_de_post( $_POST, "region", "update" ) )
						$redirect = PATH . "regiones/editar/$id/";

					header("Location: " . $redirect);
					exit();
				}

				$modelo = $this->model( "region" );

				$data = [	
							'action_form'	=> PATH . "regiones/editar/$id/",
							'update_data'  	=> $modelo->get_regiones($id),
							'titulo_panel' 	=> "Editar Región",
							'placeholder'  	=> "Nombre de la región" 
						];				
				$this->view("generico/formulario", $data);
			}

			else
				header("Location: " . PATH . "regiones/");
		}

		public function eliminar(){

			if($_POST)
				$this->prueba_de_post( $_POST, "region", "delete" );
			
			header("Location: " . PATH . "regiones/");
		}
	}
?>