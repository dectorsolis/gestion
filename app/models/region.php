<?php 
	
	class Region extends Db{

		public function __construct(){

		}

		public function create($region){
			if( ! $this->preparedSelect("SELECT nombre FROM region WHERE nombre = ?", "s", $region) )
				return $this->preparedQuery("INSERT INTO region (nombre) VALUES(?)", "s", $region);
		}

		public function update($region){
			return $this->preparedQuery("UPDATE region SET nombre = ? WHERE id_region = ?", "si", $region);
		}

		public function delete($token_region){
			return $this->preparedQuery( "DELETE FROM region WHERE id_region = ?", "i", $token_region );
		}

		public function get_regiones($id = 0){
			if( $id == 0)
				return $this->select("	SELECT 
											region.id_region AS id, 
										    region.nombre,
										    COUNT(cliente.id_region) AS total
										FROM region 
										LEFT JOIN cliente 
										ON cliente.id_region = region.id_region 
										AND cliente.activo
										GROUP BY region.nombre ASC");
			else
				return $this->preparedSelect( "SELECT id_region AS id, nombre FROM region WHERE id_region = ?", "i", ["id" => $id] );
		}

		public function get_total_regiones(){
			return $this->select("SELECT count(id_region)  AS total FROM region");
		}

		public function get_total_items( $id = 0 , $item = "empleado"){
			return $this->preparedSelect("SELECT 
											region.id_region,
											COUNT($item.id_region)AS total_$item
										FROM region 
										LEFT JOIN $item ON region.id_region = $item.id_region
										AND $item.activo
										WHERE region.id_region = ?
										GROUP BY region.nombre ASC", "i", ['id' => $id]);
		}	

		public function get_equipos(){
			$q = "	SELECT 
						region.nombre, region.id_region, COUNT(empleado.id_region) AS total
					FROM empleado 
					JOIN region ON empleado.id_region = region.id_region 
					GROUP BY region.nombre";

			return $this->select($q);
		}	

		public function valida( $id_region ){

			$q = "SELECT 1 FROM region WHERE id_region = ?";
			$t = "i";
			$data = array( "id" => $id_region );

			return $this->preparedSelect($q, $t, $data);
		}
	
		public function get_nombre( $id_region ){
			$q = "SELECT nombre FROM region WHERE id_region = ?";
			$t = 'i';
			$data = array("id" => $id_region);

			return $this->preparedSelect($q, $t, $data);
		}
	}
?>