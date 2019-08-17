<?php

	class Secciones extends Controller{

		public function index(){
			$data = array(
				'titulo_panel'	=> 'Nueva sección',
				'placeholder'	=> 'Nombre de la nueva sección',
				'action_form'	=> PATH . 'secciones/nuevo'
			);
			$this->view('generico/formulario', $data);			
		}		
		
		public function nuevo(){

			if( $_POST ){
				
				if( $this->prueba_de_post( $_POST, 'seccion', 'create' ) ){
					header("Location: " . PATH . 'secciones/nuevo');
					exit();
				}
			}
			$data = array(
				'titulo_panel'	=> 'Nueva sección',
				'placeholder'	=> 'Nombre de la nueva sección',
				'action_form'	=> PATH . 'secciones/nuevo'
			);
			$this->view('generico/formulario', $data);		
		}

	}
?>