<?php

	class Proyecto extends Db{

		public function get_integrantes_del_proyecto($id_cliente){
			$q = "	SELECT 
						e.id_empleado,
						CONCAT(e.nombre, ' ' , e.ap_paterno, ' ', e.ap_materno ) AS nombre, 
						e.telefono, 
						e.email_empresa,
						e.usuario_skype,
						d.nombre as departamento
					FROM empleado e
					INNER JOIN departamento d ON e.id_departamento = d.id_departamento
					INNER JOIN integrante_proyecto ip ON ip.id_cliente = ? AND ip.id_empleado = e.id_empleado
					WHERE e.activo";

			$t = "i";

			$data = array( 'id_cliente' => $id_cliente );

			return $this->preparedSelect( $q, $t, $data);
		}

		public function agregar_integrante($proyecto){
			$existe = $this->preparedSelect("SELECT id_empleado FROM integrante_proyecto WHERE id_cliente = ? AND id_empleado = ?", "ii", $proyecto);
			if(!$existe)
				return $this->preparedQuery("INSERT INTO integrante_proyecto(id_cliente, id_empleado) VALUES(?,?)", "ii", $proyecto);
			else
				return false;
		}

		public function vinculacion_masiva( $integrante ){
			
			$q = "DELETE FROM integrante_proyecto WHERE id_empleado = ?";
			$t = "i";

			if( $this->preparedQuery($q, $t, $integrante) > 0){
				$q = "INSERT INTO integrante_proyecto(id_cliente, id_empleado) (SELECT id_cliente, ? FROM cliente)";
				return $this->preparedQuery($q, $t, $integrante);
			}

			return 0;
		}
		public function get_proyectos_de_empleado($id){
			return $this->select("	SELECT c.id_cliente, c.dominio, c.activo, r.nombre as region
									FROM cliente c, region r
									WHERE c.id_cliente 
									IN 
									(	SELECT id_cliente 
										FROM integrante_proyecto 
										WHERE id_empleado = ". $id .") 
									AND c.id_region = r.id_region ORDER BY activo DESC" 
								);
		}

		public function remover_integrante($integrante){
			return $this->preparedQuery("DELETE FROM integrante_proyecto WHERE id_empleado = ? AND id_cliente = ?", "ii", $integrante);
		}

		public function get_integrantes( $id_proyecto, $emp1 = 0, $emp2 = 0 ){
			$q = "SELECT 
						e.id_empleado, 
						CONCAT(e.nombre, ' ' ,e.ap_paterno, ' ', e.ap_materno) AS nombre,
					    d.nombre AS departamento
					FROM 
						empleado e,  
						departamento d
					WHERE 
						e.id_departamento = d.id_departamento AND
						e.id_empleado
					IN (	SELECT id_empleado 
							FROM integrante_proyecto 
							WHERE id_cliente = ? 
							AND id_empleado NOT IN(?,?) )";
			$t = 'iii';
			$data = array( 
				'id_cliente' => $id_proyecto,
				'emp1' => $emp1,
				'emp2' => $emp2
			);

			return $this->preparedSelect( $q, $t, $data );
		}

		public function get_top_nuevos( $id_empleado ){
			$q = "	SELECT 
						id_cliente, dominio 
					FROM cliente 
					WHERE id_cliente IN ( 
						SELECT id_cliente 
						FROM integrante_proyecto 
						WHERE id_empleado = ?) AND activo ORDER BY fecha_ingreso DESC LIMIT 5";
			$t = 'i';
			$data = array( 'id' => $id_empleado);

			return $this->preparedSelect( $q, $t, $data);
		}

		public function get_lista( $id_empleado, $activo = 1 ){

			$q = "	SELECT
						c.id_cliente,
						CONCAT(c.nombre, ' ', c.ap_paterno,' ', c.ap_materno) AS nombre,
						c.dominio,
						c.creacion_dominio,
						c.nombre_empresa,
						c.email_empresa,
						c.telefono_casa,
						c.telefono_movil,
						c.fecha_ingreso,
						c.usuario_skype,
						c.id_region,
						c.activo,
						r.nombre AS region
					FROM cliente c, region r
					WHERE c.id_cliente IN(
						SELECT ip.id_cliente 
						FROM integrante_proyecto ip
						WHERE ip.id_empleado = ?
					) 
					AND c.id_region = r.id_region 
					AND c.activo = ?
					ORDER BY c.fecha_ingreso DESC";
			$t = 'ii';

			$data = array( 
				'id' => $id_empleado,
				'activo' => $activo
			);
			return $this->preparedSelect( $q, $t, $data);
		}
	}
?>