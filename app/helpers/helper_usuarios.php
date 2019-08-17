<?php
	
	class Helper_Usuarios{

		private $patron = "abcdefghijklmnopqrstuvwxyz0123456789";

		public function get_id_empleado(){
			if( $this-> is_user_logged_in() )			
				return $_SESSION['op_user_session'][0]['id_empleado'];
			return 0;
		}

		public function get_id_usuario(){
			if( $this-> is_user_logged_in() )
				return $_SESSION['op_user_session'][0]['id_user'];
			return 0;
		}

		public function get_id_rol(){
			if( $this-> is_user_logged_in() )
				return $_SESSION['op_user_session'][0]['id_rol'];
			return false;
		}

		public function get_username(){
			if( $this-> is_user_logged_in() )
				return $_SESSION['op_user_session'][0]['username'];
			return false;
		}

		public function get_nombre_usuario(){
			if( $this-> is_user_logged_in() ) 
				return $_SESSION['op_user_session'][0]['nombre'];
			return false;
		}
		public function get_id_region(){
			if( $this-> is_user_logged_in() )
				return $_SESSION['op_user_session'][0]['id_region'];
			return false;			
		}

		public function get_id_departamento(){
			if( $this->is_user_logged_in() )
				return $_SESSION['op_user_session'][0]['id_departamento'];
			return false;
		}

		public function is_user_logged_in(){
			return isset( $_SESSION['op_user_session'] );
		}

		public function get_random_password( $pass = "", $i = 0 ){
			
			if( strlen( $pass ) == 8 )
				return $pass;
			else{

				$random = rand(0, strlen( $this->patron ) -1);
				return $this->get_random_password( $pass = $pass . $this->patron[$random], $random);

			}
				
		}
	}
?>