<?php

	class Controller{

		private $model_response;

		public function __construct(){
			$this->model_response = null;
		}

		public function get_model_response(){
			return $this->model_response;
		}
		public function model($model){
			require_once MODELS . $model . ".php";
			return new $model();
		}

		public function view($view, $data = []){

			$data['user'] 	=  $_SESSION['op_user_session'][0];
			$data['sidebar'] = $this->get_sidebar( $data['user']['id_rol'] );

			require_once INCLUDES . 'dashboard/header.php';
			require_once INCLUDES . "response.php"; 
			require_once VIEWS . $view . ".php";
			require_once INCLUDES . 'dashboard/footer.php';
		}	

		public function view_static( $view, $data = array()){
			
			$template = file_get_contents( VIEWS . $view . ".php");

			foreach( $data as $index => $value){
				$template = str_replace( '['. $index . ']', $value, $template);
			}
			return utf8_decode($template);
		}
		
		public function view_nostyle($view, $data = []){
			require_once VIEWS . $view . ".php";
		}

		public function get_sidebar( $id_rol ){
			switch( $id_rol){

				case 1: return "sidebar/admin"; break;
				case 3: return "sidebar/usuario_final"; break;
				case 5: return "temporal/tmp_sidebar"; break;
				case 6: return "sidebar/director_zona"; break;
				case 7: return "sidebar/ceo"; break;
				case 8: return "sidebar/rh"; break;
				case 9: return "sidebar/reportes"; break;
			}
		}	

		public function e404(){
			$this->view("404/index");
		}

		public function acceso_denegado( $mensajes = [] ){
			$this->view("403/index", $mensajes );
		}

		public function helper($helper){
			require_once HELPERS . $helper . ".php";
			return new $helper();
		}

		public function prueba_de_post($post, $modelo, $funcion, $mensajes = array(), $campos_no_requeridos = array() ){
			
			$helper = $this->helper("helpers");
			$data_response = [];

			$response = false;				
			

			if( $valida_form = $helper->empty_fields($post, $campos_no_requeridos) ){
				
				$data_response = $this->set_mensaje('danger', $mensajes, "Por favor completa los siguientes campos", $valida_form);
			}

			else{
					
				$this->model_response = ($this->model($modelo))->$funcion($post);

				if( $this->model_response ){
					$response = true;
					$data_response = $this->set_mensaje('success', $mensajes, "Acción completada correctamente");
				}
				else
					$data_response = $this->set_mensaje('warning', $mensajes, "Ocurrió un problema al procesar tu solicitud");	
			}

			$data_response["data_form"] = $post;
			$_SESSION["response"] = $data_response;
			return $response;
		}

		public function set_mensaje( $type, $mensajes, $mensaje_secundario, $campos_vacios = array() ){

			$msg_campos_vacios = $this->get_nombres_de_campos_vacios( $campos_vacios );

			$data_response["type"] = $type;

			if( isset( $mensajes[$type] ) )
				$data_response['message'] = $mensajes[$type] . '' . $msg_campos_vacios;
			else
				$data_response['message'] = $mensaje_secundario . '' . $msg_campos_vacios;

			return $data_response;
		}

		public function get_nombres_de_campos_vacios( $campos_vacios ){
			
			$msg = "";

			if( $campos_vacios ){

				foreach( $campos_vacios as $indice)
					$msg .= "<li>" . $this->get_nombre_por_indice( $indice ) . "</li>";

				return "</ul>" . $msg . "</ul>";
			}	

			return "";		
		}	

		public function get_nombre_por_indice( $indice ){
			
			$directorio_campos = array(
				'asunto' => 'Asunto',
				'destinatario' 	=> 'Destinatario del ticket',
				'descripcion' 	=> 'Descripción',
				'nombre'		=> 'Nombre',
				'ap_paterno'	=> 'Apellido paterno',
				'ap_materno'	=> 'Apellido materno',
				'dominio'		=> 'Url del dominio',
				'nombre_empresa'	=> 'Nombre de la empresa',
				'creacion_dominio' 	=> 'Fecha de creación del dominio',
				'email_empresa'		=> 'Dirección de correo corporativo',
				'telefono_casa'		=> 'Teléfono fijo o de oficina',
				'telefono_movil'	=> 'Teléfono celular',
				'fecha_ingreso'		=> 'Fecha de ingreso a la empresa',
				'usuario_skype'		=> 'ID de skype',
				'region'			=> 'Región u oficina',
				'fecha_contacto'	=> 'Fecha de contacto',
				'nombre_contacto'	=> 'Nombre del contacto',
				'fuente'			=> 'Fuente',
				'estatus'			=> 'Estatus',
				'fecha_nac'	=> 'Fecha de nacimiento',
				'telefono'	=> 'Teléfono',
				'id_region'	=> 'Región u Oficina',
				'id_departamento'	=> 'Departamento',
				'nombre-rol' => 'Nombre del rol',
				'pass'	=> 'Nueva contraseña',
				'password' => 'contraseña',
				'no_fases' => 'Número de fases'		
			);


			foreach( $directorio_campos as $etiqueta => $valor ){
				if( $indice == $etiqueta)
					return $valor;
	
			}

			return $indice;
		}		
	}

?>