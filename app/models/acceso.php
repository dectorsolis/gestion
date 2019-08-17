<?php 

	class Acceso extends Db{


		public function create($acceso){
			$q = "INSERT INTO accesos (url_acceso, usuario, pass, id_tipo, id_cliente) VALUES (?,?,?,?,?)";
			$t = "sssii";
			return  $this->preparedQuery( $q, $t ,$acceso );
		}

		public function update($acceso){
			
			$q = "	UPDATE 
						accesos 
					SET 
						url_acceso = ?,
						usuario = ?,
						pass = ?,
						id_tipo = ?
					WHERE 
						id_acceso = ?";
			
			$t = "sssii";
					
			return $this->preparedQuery( $q, $t, $acceso );
		}

		public function delete($acceso){
			return $this->preparedQuery("DELETE FROM accesos WHERE id_acceso = ?", "i", $acceso);
		}

		public function get_acceso($id){
			if( $id != 0){
				return $this->preparedSelect("	SELECT  
													a.id_acceso,
													a.url_acceso,
												    a.usuario,
												    a.pass,
												    a.id_cliente,
												    a.id_tipo,
												    t.nombre,
												    c.dominio
												FROM accesos a 
												INNER JOIN tipo_acceso t ON a.id_tipo = t.id_tipo
												INNER JOIN cliente c ON c.id_cliente = a.id_cliente
												WHERE a.id_cliente = ?", "i", ["id_cliente" => $id]);
			}
			else{
				return $this->select("SELECT id_cliente, dominio, nombre_empresa FROM cliente");				
			}
		}
		
		public function get_info_acceso( $id_cliente, $id_acceso ){
			$q = "	SELECT 
						id_acceso, url_acceso, usuario, pass, id_tipo 
					FROM 
						accesos 
					WHERE 
						id_acceso = ? AND id_cliente = ?";
			$t = "ii";
			
			$data = array( 
				"id_acceso" => $id_acceso,
				"id_cliente" => $id_cliente
			);

			return $this->preparedSelect( $q, $t, $data );
		}
		public function get_tipo_de_acceso($id_tipo = 0){
			if( $id_tipo == 0)
				return $this->select("	SELECT 
											t.id_tipo AS id,
											t.nombre, 
											COUNT(a.id_acceso ) AS total
										FROM tipo_acceso t
										LEFT JOIN accesos a 
										ON a.id_tipo = t.id_tipo
										GROUP BY t.nombre" );
			else
				return $this->preparedSelect("	SELECT 
													id_tipo AS id, 
													nombre 
												FROM tipo_acceso 
												WHERE id_tipo = ?",  "i",  ["id" => $id_tipo] );
		}

		public function create_tipo_acceso($acceso){
			return $this->preparedQuery(" INSERT INTO tipo_acceso (nombre) VALUES (?)", "s", $acceso);
		}		

		public function update_tipo_acceso($acceso){
			return $this->preparedQuery( "UPDATE tipo_acceso SET nombre = ? WHERE id_tipo = ? ", "si", $acceso); 
		}

		public function delete_tipo_acceso($acceso){
			return $this->preparedQuery(" DELETE FROM tipo_acceso WHERE id_tipo = ?", "i", $acceso);
		}
		
		public function valido( $id_acceso ){
			
			$q = "SELECT 1 FROM accesos WHERE id_acceso = ?";
			$t = 'i';
			$data = array( "id" => $id_acceso );
			
			return $this->preparedSelect( $q, $t, $data );
		}

		public function get_backup_general( $estado ){
			$q = "CALL backup_accesos($estado);";
			return $this->select($q);
		}	

	}
?>