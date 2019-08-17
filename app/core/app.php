<?php 
	class App{
		
		protected $controller;
		protected $method;
		protected $params;
		protected $error_404;
		protected $user;
		protected $db;

		public function __construct(){
				
			$this->controller 	= "home";
			$this->method 		= "index";
			$this->params		= [];
			$this->db 			= new Db();

			$url = $this->parseUrl();

			if( isset($url[0]) ){

				if(file_exists(CONTROLLERS . $url[0] . ".php")){
					$this->controller = $url[0];
					unset($url[0]);
				}
				else
					$this->method = "e404";
			}
		

			require_once(CONTROLLERS . $this->controller . ".php");

			$this->controller = new $this->controller;
				
			if( isset($url[1]) ){

				if(method_exists($this->controller, $url[1])){

					$this->method = $url[1];
					
					unset($url[1]);
				}

				else if( !is_numeric($url[1]) )
					$this->method = "e404";
					
			}

			if( $this->is_user_logged_in() ){

				if( $this->has_access() ){
					$this->params = $url? array_values($url) : array();
					call_user_func_array( [$this->controller, $this->method], $this->params );	
				}
				else{
					$data = array(
						'titulo' => 'ERROR - 403',
						'msg' 	 => 'La página que buscas no existe o tienes acceso restringido, por favor contacta al administrador de la aplicación'
					);

					(new controller)->acceso_denegado( $data );
				}
	
			}
			else{
				require_once( CONTROLLERS . "login.php");
				$this->params = $url? array_values($url) : array();
				call_user_func_array( [new Login, 'index'], $this->params );					
			}	

		}		

		public function parseUrl(){

			if( isset($_GET['url']) ){
				$url = str_replace("-", "_", $_GET['url']);
				return explode( "/", filter_var( trim($url, "/"), FILTER_SANITIZE_URL));
			}
		}

		public function error_404(){
			require_once(CONTROLLERS . "home.php");
			$this->controller = new Home();
			$this->controller->index(true);
			die();
		}

		public function get_id_seccion(){
			
			$q = "SELECT id_seccion FROM op_seccion WHERE descripcion = ?";
			
			$params = array(
				'descripcion' => get_class($this->controller)
			);
			
			$id_seccion = $this->db->preparedSelect( $q, 's', $params );			

			if( $id_seccion )
				return $id_seccion[0]['id_seccion'];
			else
				return 0;
		}

		public function get_id_modulo(){
			
			$q = "SELECT id_modulo FROM op_modulo WHERE descripcion = ? AND id_seccion = ?";
			
			$params = array(
				'descripcion' => $this->method,
				'id_seccion'  => $this->get_id_seccion()
			);

			$id_modulo = $this->db->preparedSelect( $q, 'si', $params );

			if( $id_modulo )
				return $id_modulo[0]['id_modulo'];
			else
				return 0;
		}

		public function get_id_user(){

			if( $this->is_user_logged_in() ){

				$this->user = $_SESSION['op_user_session'][0];
				return $this->user['id_user'];	
			}

			return 0;			
		}

		public function has_access(){

			$privilegios 	= $_SESSION['op_user_session'][0]['privilegios'];
			$privilegios 	= unserialize( $privilegios );
			$id_modulo 		= $this->get_id_modulo();

			if( $privilegios ){
				foreach( $privilegios as $value){
					if( $value == $id_modulo )
						return true;
				} 
			}

			return false;
		}

		public function is_user_logged_in(){
			return isset( $_SESSION['op_user_session'] );
		}
	}

?>