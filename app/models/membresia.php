<?php
	class Membresia extends Db{
		
		public function get_membresias( $id_membresia = 0){
			
			if( $id_membresia == 0)
				return $this->select("SELECT id_membresia, descripcion FROM op_membresia");
			else{
				$q = "SELECT id_membresia, descripcion FROM op_membresia WHERE id_membresia = ?";
				$t = "i";
				$data = array( "id" => $id_membresia );
				return $this->preparedSelect( $q, $t, $data);
			}
		}
	}
?>