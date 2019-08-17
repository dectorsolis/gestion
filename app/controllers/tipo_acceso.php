<?php

	class Tipo_Acceso extends Controller{

		function index(){
			$data = [];
			$vista = "generico/tabla";
			$modelo = $this->model("acceso");


			$data = [	
						'nuevo' => PATH . "tipo_acceso/nuevo/",
						'titulo_panel' => "Agregar nuevo tipo de acceso",
						'busqueda_placeholder' => "Buscar tipo de acceso",
						'texto_boton_agregar' => "Nuevo tipo",
						'th' => "Tipo",
						'item' => $modelo->get_tipo_de_acceso(),
						'edit_url' => PATH . "tipo-acceso/editar/",
						'delete_url' => PATH . "tipo-acceso/eliminar/",
						'#' => "Total"];

			$this->view($vista, $data);
		}

		public function nuevo(){

			if( $_POST ){
				$redirect = PATH . "tipo-acceso/";

				if( ! $this->prueba_de_post( $_POST, "acceso", "create_tipo_acceso") )
					$redirect .= "nuevo/";

				header("Location: " . $redirect);
				exit();
			}

			$data = [];
			$data = [
						'action_form'  => PATH . "tipo-acceso/nuevo/", 
						'titulo_panel' => "Nuevo tipo de acceso",
						'placeholder'  => "Nombre del tipo de acceso"
					];

			$this->view("generico/formulario", $data);
		}	

		public function editar($id = 0){
			
			if( !is_numeric($id) || $id == 0)
				header("Location: " . PATH . "tipo-acceso/");

			if( $_POST ){

				$redirect = PATH . "tipo-acceso/";

				if ( !$this->prueba_de_post( $_POST, "acceso", "update_tipo_acceso") )
					$redirect .= "editar/$id/";

				header("Location: " . $redirect);
				exit();
			}

			$modelo = $this->model("acceso");
			$data = [
						"action_form"  => PATH . "tipo-acceso/editar/$id/",
						"titulo_panel" => "Editar tipo de acceso",
						"placeholder"  => "Nombre del tipo de acceso",
						"update_data"  => $modelo->get_tipo_de_acceso($id) ];

			$this->view("generico/formulario", $data);
		}	

		public function eliminar(){
			
			if( $_POST )
				$this->prueba_de_post( $_POST, "acceso", "delete_tipo_acceso" );

			header("Location: " . PATH . "tipo-acceso/");

		}
	}

?>