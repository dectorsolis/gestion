<?php
	
	class Rol extends Db{


		public function create( $nuevo_rol ){

			$q = "INSERT INTO op_rol(descripcion) VALUES(?)";
			$t = 's';

			return $this->preparedQuery($q, $t, $nuevo_rol);
		}

		public function get_roles(){

			return $this->select("SELECT id_rol, descripcion FROM op_rol");
		}
		public function set_privilegios( $array_permisos ){
			
			$q = "UPDATE op_rol SET privilegios = ? WHERE id_rol = ?";
			$t = "si";

			return $this->preparedQuery( $q, $t, $array_permisos);
		}

		public function get_privilegios( $id_rol ){

			$q = "SELECT privilegios FROM op_rol WHERE id_rol = ?";
			$t = 'i';
			$data = array(
				'id_rol' => $id_rol
			);
			
			return $this->preparedSelect( $q, $t, $data);
		}
		
		public function get_id_rol( $id_rol ){
			
			$q = "SELECT id_rol FROM op_rol WHERE id_rol = ?";
			$t = 'i';
			$data = array(
				'id_rol' => $id_rol
			);

			if( $id = $this->preparedSelect( $q, $t, $data ) )
				return $id[0]['id_rol'];
			else
				return 0;
		}

	}
?>