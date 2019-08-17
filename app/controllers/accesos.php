<?php 
	
	class Accesos extends Controller{
		
		public function __construct(){
			
		}
		
		public function index($id = 0){

			$data 	= [];
			$vista 	= "accesos/index";
			$modelo = $this->model('acceso');

			if( $id != 0){
								
				$vista = "accesos/ficha_accesos";
				$data['accesos'] = $modelo->get_acceso($id);
				$data['id_cliente'] = $id;
				$this->view( $vista, $data );
			}
		}


		public function nuevo( $id_cliente = 0 ){

			$cliente = $this->model('cliente');
			
			if( $cliente->valido( $id_cliente ) ){
				
				if( $_POST ){
					
					$_POST['pass'] = base64_encode( $_POST['pass'] ); //encriptar la pass para no perder formato

					$response = array(
						"type" => "redirect",
						"href" => PATH . "clientes/ficha/" . $id_cliente
					);	

					$this->prueba_de_post($_POST, "acceso", "create");
					echo json_encode( $response );
					exit();
				} 
				
				$tipo_acceso = $this->model('tipo_acceso');
				$data = array(
					'id_cliente' => $id_cliente,
					'action' => PATH . "accesos/nuevo/" . $id_cliente,
					'tipo_acceso' => $tipo_acceso->get_lista(),
					'texto_submit' => "Agregar"
				);
				
				$this->view_nostyle( "accesos/nuevo", $data );				
			}
			
		}

		public function editar($id_cliente = 0, $id_acceso = 0){
			
			$acceso = $this->model("acceso");
			$cliente = $this->model("cliente");
			$tipo_acceso = $this->model('tipo_acceso');
			
			$data = [];
			
			if( $cliente->valido( $id_cliente ) && $acceso->valido( $id_acceso ) ){
				
				if($_POST){
					
					//sanitizacion de los datos
					$acceso = array(
						"url_acceso" => trim($_POST['url_acceso']),
						"usuario" 	=> trim($_POST['usuario']),
						"pass" 		=> base64_encode(trim($_POST['pass'])),
						"id_tipo" 	=> trim($_POST['id_tipo']),
						"id_acceso" => trim($id_acceso)
					);

					$response = array(
						"type" => "redirect",
						"href" => PATH . "clientes/ficha/" . $id_cliente
					);					
					
					$this->prueba_de_post( $acceso, 'acceso', 'update');
					
					echo json_encode( $response );
					exit();
				}	
				
				$data = array(
					'update_data' => $acceso->get_info_acceso( $id_cliente, $id_acceso ),
					'tipo_acceso' => $tipo_acceso->get_lista(),
					'action' => PATH . "accesos/editar/" . $id_cliente . "/" . $id_acceso . "/",
					'texto_submit' => "Actualizar"
				);
				
				$this->view_nostyle("accesos/nuevo", $data);				
				
			}
			
		}

		public function eliminar($id_acceso){
			
			$acceso = $this->model('acceso');
			
			if( $acceso->valido( $id_acceso ) ){
				
				$data = array( "id_acceso" => $id_acceso );
				
				if( $this->prueba_de_post( $data, "acceso", "delete" ) ){
					
					$response = array(
						"type" => "remove",
						"state" => "success",
						"msg" => "Registro eliminado correctamente",
						"selector" => "#acceso-" . $id_acceso
					);
					
					echo json_encode( $response );
				}
			}
			
		}

		public function general(){

			$acceso = $this->model("acceso");
			$data = array(
				"titulo" => "Accesos",
				"backup" => $acceso->get_backup_general(true),
				"backup_json" => json_encode($acceso->get_backup_general(true))
			);
			$this->view("accesos/general", $data);
		}
		
	}

?>