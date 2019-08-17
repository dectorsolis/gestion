<?php

	class Modulo extends Db{

		public function create( $modulo ){
			$q = "INSERT INTO op_modulo (descripcion, id_seccion) VALUES( ?,? )";
			$t = "si";

			return $this->preparedQuery( $q, $t, $modulo );
		}

		public function get_modulos( ){
			return $this->select( "SELECT id_modulo, descripcion as descrip, id_seccion FROM op_modulo" );
		}		

		public function get_modulo( $id ){
			$q = "SELECT id_modulo, descripcion FROM op_modulo WHERE id_seccion = ?";
			$t = 'i';
			$params = array( 'id_seccion' => $id );
			return $this->preparedSelect( $q, $t, $params);
		}
	}
?>