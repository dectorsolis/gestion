<?php 
	class Proyectos Extends Controller{

		public function agregar_integrante(){

			$redirect = PATH;

			if($_POST){
				$this->prueba_de_post($_POST, "proyecto","agregar_integrante");
				$redirect = PATH . 'clientes/ficha/' . $_POST['cliente'];		
			}

			header("Location: " . $redirect);
		}	

		public function remover_integrante($id_cliente = 0){
			
			$cliente = $this->model('cliente');
			$empleado = $this->model('empleado');
			$redirect = PATH;
			
			if( isset( $_POST['id_empleado'] ) ){
				
				if( $cliente->valido( $id_cliente ) && $empleado->valido( $_POST['id_empleado'] )  ){
					
					$integrante = array(
						'id_empleado'	=> $_POST['id_empleado'],
						'id_cliente'	=> $id_cliente
					);
					
					$this->prueba_de_post( $integrante, "proyecto", "remover_integrante");
					
					$redirect = PATH . 'clientes/ficha/' . $id_cliente;
				}
				
			}
	
			header("Location: " . $redirect);
		}	

	}
?>