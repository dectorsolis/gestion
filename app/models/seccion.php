<?php
	
	Class Seccion extends Db{

		public function create( $seccion ){
			$q = "INSERT INTO op_seccion(descripcion) VALUES(?) ";
			$t = 's';
			return $this->preparedQuery( $q, $t, $seccion );
		}

		public function get_secciones(){
			return $this->select("SELECT * FROM op_seccion");
		}
	}
?>