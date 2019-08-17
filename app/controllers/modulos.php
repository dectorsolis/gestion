<?php

	class Modulos extends Controller{

		public function index(){

		}

		public function nuevo(){

			if( $_POST ){

				if( $this->prueba_de_post( $_POST, 'modulo', 'create' ) ){
					header("Location: " . PATH . 'modulos/nuevo');
					exit();
				}
			}
			
			$seccion = $this->model('seccion');

			$data = array(
				'titulo'	=> "Nuevo módulo",
				'action'	=> PATH . 'modulos/nuevo',
				'secciones' => $seccion->get_secciones()
			);

			$this->view( 'modulos/nuevo', $data);
		}
	}
?>