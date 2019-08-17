<?php 

	Class Op_Seccion extends Db{

		public function get_op_secciones(){
			return $this->select("SELECT * FROM op_seccion");
		}
	}
?>