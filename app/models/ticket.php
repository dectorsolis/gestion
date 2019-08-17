<?php

	Class Ticket extends Db{

		public function __construct(){
			date_default_timezone_set('America/Mexico_City');
		}

		public function valido( $id_ticket ){

			$q = "SELECT id_estado, id_ticket FROM ticket WHERE id_ticket = ?";
			$t = 'i';
			$ticket = array(
				'id_ticket' => $id_ticket
			);

			return $this->preparedSelect( $q, $t, $ticket);
		}
		public function create( $data ){
			
			$q = "INSERT INTO ticket( 
					fecha_creacion, 
					asunto, 
					descripcion, 
					prioridad, 
					id_estado, 
					id_emisor, 
					id_destinatario,
					id_cliente,
					evidencia) VALUES(?,?,?,?,?,?,?,?,?)";

			$types = "ssssiiiis";

			$ticket = array(
				'fecha_creacion' 	=> date('Y-m-d'),
				'asunto'			=> $data['asunto'],
				'descripcion'		=> $data['descripcion'],
				'prioridad'			=> trim($data['prioridad']),
				'id_estado'			=> 1,
				'id_emisor'			=> base64_decode( $data['token'] ),
				'id_destinatario'	=> $data['destinatario'],
				'id_cliente'		=> $data['cliente'],
				'evidencia'			=> isset($data['evidencia']) ? base64_encode($data['evidencia']) : ""  
			);			

			return $this->preparedQuery($q, $types, $ticket, true);
		}
		
		public function delete( $ticket ){
			
			$q = "DELETE FROM ticket WHERE id_ticket = ?";
			$t = 'i';
			
			return $this->preparedQuery( $q, $t, $ticket);
		}

		public function get_tickets( $id_ticket = 0){

			if( $id_ticket == 0){
				
				return $this->select("SELECT 
										t.id_ticket,
										t.fecha_creacion,
										t.asunto,
										t.prioridad,
										t.fecha_inicio,
										t.fecha_final,
										t.id_estado,
										t.id_cliente,
										e.nombre AS nombre, 
										d.nombre AS departamento,
										c.dominio AS cliente,
										et.descripcion AS estado
									FROM 
										ticket t, empleado e, departamento d, cliente c, estado_ticket et
									WHERE 
										t.id_emisor = e.id_empleado AND 
										d.id_departamento = e.id_departamento AND
										c.id_cliente = t.id_cliente AND
										t.id_estado = et.id_estado
									ORDER BY t.fecha_creacion");
			}
			else{
				return $this->preparedSelect("SELECT 
												t.id_ticket,
												t.id_cliente,
												t.fecha_creacion,
												t.asunto,
												t.id_emisor,
												t.id_destinatario,
												t.prioridad,
												t.fecha_inicio,
												t.fecha_final,
												t.id_estado,
												t.descripcion,
												t.evidencia,
												t.observaciones,
												CONCAT(e.nombre, ' ', e.ap_paterno, ' ', e.ap_materno) AS nombre,  
												e.email_empresa,
												e.usuario_skype,
												e.telefono,
												d.nombre AS departamento,
												c.dominio AS cliente,
												et.descripcion AS estado
											FROM 
												ticket t, empleado e, departamento d, cliente c, estado_ticket et
											WHERE 
												t.id_ticket = ? AND
												t.id_emisor = e.id_empleado AND 
												d.id_departamento = e.id_departamento AND
												c.id_cliente = t.id_cliente AND
												t.id_estado = et.id_estado
											ORDER BY t.fecha_creacion", 'i', ['id_ticket' => $id_ticket] );				
			}
		}

		public function get_total_tickets_asociados( $id_empleado ){
			$q = "SELECT COUNT(*) AS total FROM ticket WHERE id_estado != 3 AND id_destinatario = ?";
			$t = 'i';
			$data = array( 'id' => $id_empleado );

			if( $total = $this->preparedSelect( $q, $t, $data) )	
				return $total[0]['total'];
			return "";		
		}

		public function set_estado( $ticket ){
			
			$q = "";
			$t = "";
			$data = array();

			switch( $ticket['id_estado']){

				case 1: 

					$q = "UPDATE ticket 
							SET id_estado = ?, fecha_inicio = NULL, fecha_final = NULL
								WHERE id_ticket = ?";
					$t = "ii";

					$data = array(
						"id_estado" => $ticket["id_estado"],
						"id_ticket" => $ticket["id_ticket"]
					);

				break;
				case 2: 
				
					$q = "UPDATE ticket 
							SET id_estado = ?, fecha_inicio = ?, fecha_final = NULL
								WHERE id_ticket = ?";
					$t = 'isi';

					$data = array(
						"id_estado" => $ticket["id_estado"],
						"fecha_inicio" => $ticket["fecha_modificacion"],
						"id_ticket" => $ticket["id_ticket"]
					);
				break;
				case 3: 
					if( $ticket['estado_actual'] == 1 ){
						$q = "UPDATE ticket 
								SET id_estado = ?, fecha_inicio = ?, fecha_final = ? 
									WHERE id_ticket = ?"; 
						
						$t = "issi";

						$data = array(
							"id_estado" => $ticket["id_estado"],
							"fecha_inicio" => $ticket["fecha_modificacion"],
							"fecha_final" => $ticket["fecha_modificacion"],
							"id_ticket" => $ticket["id_ticket"]
						); 
					}
					else{

						$q = "UPDATE ticket 
								SET id_estado = ?, fecha_final = ?
									WHERE id_ticket = ?";
						$t = 'isi';

						$data = array(
							"id_estado" => $ticket["id_estado"],
							"fecha_final" => $ticket["fecha_modificacion"],
							"id_ticket" => $ticket["id_ticket"]							
						);
					}
				break;
			}
			
			
			return $this->preparedQuery( $q, $t, $data );
		}
		
		public function get_estado( $id_ticket ){
			$q = "SELECT id_estado FROM ticket WHERE id_ticket = ?";
			$t = 'i';
			$data = array("id" => $id_ticket);

			return $this->preparedSelect($q, $t, $data);
		}
		public function get_estados(){
			return $this->select( "SELECT id_estado, descripcion FROM estado_ticket" );
		}
		public function set_comentario( $ticket ){
			$q = "UPDATE ticket SET observaciones = ? WHERE id_ticket = ?";
			$t = 'si';
			
			return $this->preparedQuery( $q, $t, $ticket);
		}
		
		public function get_info_destinatario( $id_ticket ){
			$q = "	SELECT 
						e.id_empleado,
						CONCAT(e.nombre, ' ', e.ap_paterno,' ', e.ap_materno) AS nombre,
						e.email_empresa,
						d.nombre AS depto
					FROM empleado e, departamento d
					WHERE id_empleado  = (
						SELECT id_destinatario 
						FROM ticket
						WHERE id_ticket = ?) AND e.id_departamento = d.id_departamento";
			$t = 'i';

			$data = array( 'id' => $id_ticket );

			return $this->preparedSelect( $q, $t, $data );
		}

		public function delegar_ticket( $ticket ){
			$q = "UPDATE ticket SET id_destinatario = ? WHERE id_ticket = ?";
			$t = "ii";

			return $this->preparedQuery( $q, $t, $ticket);
		}

		public function get_estadisticas(){
			$q = "	SELECT COUNT(id_ticket) AS total,
					(SELECT COUNT(id_ticket) FROM ticket WHERE id_estado = 3) AS resueltos,
					(SELECT COUNT(id_ticket) FROM ticket WHERE id_estado = 2) AS procesando,
					(SELECT COUNT(id_ticket) FROM ticket WHERE id_estado = 1 )AS pendientes
					FROM ticket";

			return $this->select( $q );
		}

		public function get_top_ten(){
			$q = 	"SELECT 
						u.id_user,
						e.nombre, 
						e.email_empresa,
						t.id_destinatario , 
						COUNT(t.id_ticket) AS total 
					FROM ticket t, empleado e, op_user u
					WHERE t.id_estado = 3 
					AND t.id_destinatario = e.id_empleado
					AND t.id_destinatario = u.id_empleado
					AND e.activo
					GROUP  BY t.id_destinatario ORDER BY total DESC LIMIT 10";

			return $this->select($q);
		}

		public function get_top_tickets_resueltos_por_mes(){
			$q = "SELECT 
					CONCAT(e.nombre, ' ', e.ap_paterno) AS nombre,
				    COUNT(t.id_ticket) AS total,
				    e.email_empresa,
				    u.id_user
				FROM 
					empleado e, ticket t, op_user u
				WHERE
					t.id_destinatario = e.id_empleado
				AND 
					u.id_empleado = e.id_empleado
				AND 
					MONTH(t.fecha_creacion) = MONTH(CURRENT_DATE())
				AND 
					MONTH(t.fecha_final) = MONTH(CURRENT_DATE())	
				AND
					YEAR(t.fecha_creacion) = YEAR(CURRENT_DATE())		
				AND
					t.id_estado = 3
				GROUP BY e.nombre ORDER BY total DESC LIMIT 10";

			return $this->select($q);
		}

		public function get_email_destinatario( $id_empleado ){
			$q = "SELECT nombre, email_empresa FROM empleado WHERE id_empleado = ?";
			$t = 'i';
			$data = array("id" => $id_empleado);

			return $this->preparedSelect($q, $t, $data);
		}
	}
?>