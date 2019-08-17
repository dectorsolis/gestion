<?php 

	class Departamento extends Db{

		public function create($depto){
			if( ! $this->preparedSelect( "SELECT id_departamento FROM departamento WHERE nombre = ?", "s", $depto ) )
				return $this->preparedQuery( "INSERT INTO departamento (nombre) VALUES (?)" , "s", $depto);
			return false;
		}

		public function update($depto){
			return $this->preparedQuery("UPDATE departamento SET nombre = ? WHERE id_departamento = ?", "si", $depto);
		}

		public function delete($depto){
			return $this->preparedQuery( "DELETE FROM departamento WHERE id_departamento = ? ", "i", $depto);
		}

		public function get_departamentos($id = 0){
			if($id == 0)
				return $this->select("	SELECT 
											d.id_departamento AS id, 
											d.nombre, 
											COUNT(e.id_departamento) AS total
										FROM departamento d 
										LEFT JOIN empleado e 
										ON d.id_departamento = e.id_departamento AND e.activo
										GROUP BY d.nombre");
			else
				return $this->preparedSelect(" SELECT id_departamento AS id, nombre FROM departamento WHERE id_departamento = ?", "i", ["id" => $id] );
		}

		public function get_total_deptos(){
			return $this->select("SELECT count(id_departamento) AS total FROM departamento");
		}

	}
?>