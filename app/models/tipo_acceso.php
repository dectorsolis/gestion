<?php 
	
	class Tipo_Acceso extends Db{

		public function __construct(){

		}

		public function get_lista(){
			return $this->select( "SELECT * FROM tipo_acceso ");
		}
	}
?>