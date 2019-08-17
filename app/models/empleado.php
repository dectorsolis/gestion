<?php

	class Empleado extends Db{

		public function create($empleado){

			if( !$this->existe_empleado( $empleado['email_empresa'] ) ){

				$query = "	INSERT INTO empleado
							(
							    nombre,
							    ap_paterno,
							    ap_materno,
							  	genero,
							    fecha_nac,
							    email_empresa,
							    telefono,
							    fecha_ingreso,
							    usuario_skype,
							    id_region,
							    id_departamento
							) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
				
				return $this->preparedQuery($query, "sssssssssii", $empleado );
			}

			return false;
		}

		public function update($empleado){
			$query = "	UPDATE empleado
						SET 
							nombre = ?,
							ap_paterno = ?,
							ap_materno = ?,
							genero  = ?,
							fecha_nac = ?,
							email_empresa = ?,
							telefono = ?,
							fecha_ingreso = ?,
							usuario_skype = ?,
							id_region = ?,
							id_departamento = ?
						WHERE id_empleado = ?";

			return $this->preparedQuery($query, "sssssssssiii", $empleado);
		}

		public function delete($empleado){
			return $this->preparedQuery("DELETE FROM empleado WHERE id_empleado = ?", "i", $empleado);
		}

		public function valido( $id_empleado ){

			$empleado = array(
				'id_empleado' => $id_empleado
			);

			$q = "SELECT id_empleado FROM empleado WHERE id_empleado = ?";

			$t = 'i';

			return $this->preparedSelect($q, $t, $empleado);
		}

		public function remover_de_proyecto( $ids ){
			$q = "DELETE FROM integrante_proyecto WHERE id_empleado IN(" . $ids . ")";
			return $this->query($q);
		}

		public function cambiar_status($empleado){
			
			$status = $this->preparedSelect("SELECT activo, usuario_activo FROM empleado WHERE id_empleado = ?", "i", $empleado);
			$data = array(
				"status"=> $status[0]['activo'], 
				"usuario_activo" => $status[0]['usuario_activo'],
				"id_empleado" => $empleado['id_empleado']
			);

			return $this->preparedQuery("UPDATE empleado SET activo = !?, usuario_activo = !? WHERE id_empleado = ?", "iii", $data);
		}
		
		public function get_lista_general( $filtro ){
			$q = "	SELECT
						e.id_empleado,
						e.nombre,
						e.ap_paterno,
						e.ap_materno,
						e.fecha_nac,
						e.genero,
						e.fecha_ingreso,
						e.telefono,
						e.email_empresa,
						e.usuario_skype,
						e.id_departamento,
						e.usuario_activo,
						d.nombre as departamento,
						r.id_region,		
						r.nombre as nombre_region,
						(SELECT COUNT(id_ticket) FROM ticket WHERE id_destinatario = e.id_empleado) AS tickets_asignados,
						(SELECT COUNT(id_ticket) FROM ticket WHERE id_destinatario = e.id_empleado AND id_estado = 3) AS tickets_resueltos,
						(SELECT COUNT(ip.id_empleado) FROM integrante_proyecto ip,cliente c WHERE c.id_cliente = ip.id_cliente AND c.activo AND ip.id_empleado = e.id_empleado ) AS total_proyectos
					FROM 
						empleado e, departamento d, region r
					WHERE
						e.activo = ? AND 
						e.id_departamento LIKE ? AND
						e.id_region LIKE ? AND
						e.id_departamento = d.id_departamento AND
						e.id_region = r.id_region
						ORDER BY d.nombre";
						
			$t = "iss";
			return $this->preparedSelect( $q, $t, $filtro );
		}
		public function get_info_equipo( $filtro ){
			$q = "	SELECT
						e.id_empleado,
						e.nombre,
						e.ap_paterno,
						e.ap_materno,
						e.fecha_ingreso,
						e.email_empresa,
						d.nombre as departamento,
						r.id_region,		
						r.nombre as nombre_region,
						u.id_user,
						(SELECT COUNT(id_ticket) FROM ticket WHERE id_destinatario = e.id_empleado) AS tickets_asignados,
						(SELECT COUNT(id_ticket) FROM ticket WHERE id_destinatario = e.id_empleado AND id_estado = 3) AS tickets_resueltos,
						(SELECT COUNT(ip.id_empleado) FROM integrante_proyecto ip,cliente c WHERE c.id_cliente = ip.id_cliente AND c.activo AND ip.id_empleado = e.id_empleado ) AS total_proyectos
					FROM 
						empleado e, departamento d, region r, op_user u
					WHERE
						e.activo = ? AND 
						e.id_departamento LIKE ? AND
						e.id_region LIKE ? AND
						e.id_departamento = d.id_departamento AND
						e.id_region = r.id_region AND
						e.id_empleado = u.id_empleado
						ORDER BY d.nombre";
						
			$t = "iss";
			return $this->preparedSelect( $q, $t, $filtro );
		}		
		
		public function get_equipo( $id_departamento, $id_region ){
			
			if( $id_departamento != 22){
				$q = "	SELECT 
							e.id_empleado, 
							CONCAT(e.nombre, ' ' ,e.ap_paterno, ' ' ,e.ap_materno) AS nombre, 
							e.email_empresa,
							DATE_FORMAT(u.last_login, '%d/%m/%Y') as last_login,
							u.id_user
						FROM 
							empleado e, 
							op_user u
						WHERE 
						e.id_departamento = (	SELECT id_departamento 
												FROM departamento 
												WHERE id_depto_padre = $id_departamento)
						AND e.activo
						AND u.id_empleado = e.id_empleado
						AND u.id_user != 14
						AND u.id_user != 30";
			}
			else{
				$q = "	SELECT 
							e.id_empleado, 
							CONCAT(e.nombre, ' ' ,e.ap_paterno, ' ' ,e.ap_materno) AS nombre, 
							e.email_empresa,
							DATE_FORMAT(u.last_login, '%d/%m/%Y') as last_login,
							u.id_user
						FROM 
							empleado e, 
							op_user u
						WHERE 
						e.id_departamento = (	SELECT id_departamento 
												FROM departamento 
												WHERE id_depto_padre = $id_departamento)
						AND	e.id_region = $id_region
						AND e.activo
						AND u.id_empleado = e.id_empleado
						AND u.id_user != 14
						AND u.id_user != 30";				
			}

			return $this->select( $q );
		}
		public function get_empleados($id = 0, $status = 1, $departamento = " '%' ", $region = " '%' ", $orderby = 1){
			
			if( $id == 0)
				return $this->select("	SELECT 
											e.id_empleado,
											e.nombre,
											e.ap_paterno,
											e.ap_materno,
											e.fecha_nac,
											e.genero,
											e.fecha_ingreso,
											e.telefono,
											e.email_empresa,
											e.usuario_skype,
											e.id_departamento,
											d.nombre as departamento,
											r.id_region,		
											r.nombre as nombre_region,
											e.usuario_activo,
											u.mi_agenda,
											u.id_user
										FROM empleado e, op_user u, departamento d, region r
										WHERE 
											e.id_departamento = d.id_departamento 
										AND e.id_empleado = u.id_empleado	
										AND e.id_region = r.id_region
										AND e.activo = ". $status . 	 
										" AND e.id_departamento LIKE " . $departamento . 
										" AND e.id_region LIKE " . $region .
										" ORDER BY " . $orderby);
			else
				return $this->preparedSelect("	SELECT
													empleado.id_empleado, 
													empleado.nombre,
													empleado.ap_paterno,
													empleado.ap_materno,
													empleado.genero,
													empleado.fecha_ingreso,
													empleado.fecha_nac,
													empleado.telefono,
													empleado.email_empresa,
													empleado.usuario_skype,
													empleado.id_region,
													empleado.id_departamento,
													departamento.nombre AS depto
												FROM empleado, departamento 
												WHERE id_empleado = ? 
												AND activo AND empleado.id_departamento = departamento.id_departamento ORDER BY fecha_ingreso", 

												"i", ["id_empleado" => $id] );
		}

		public function get_involucrados_proyecto($id_cliente = 0){
			$query = "	SELECT 
							e.nombre, 
						    e.ap_paterno,
						    e.ap_materno,
						    e.telefono,
						    e.email_empresa,
						    e.usuario_skype,
						    departamento.d.nombre AS depto 
						FROM empleado e
						INNER JOIN involucrado 		i 	ON 	i.id_empleado = e.id_empleado
						INNER JOIN departamento 	d	ON 	e.id_departamento = d.id_departamento
						WHERE i.id_cliente = ?;";
			$type = 'i';
			$data = [$id_cliente];
			return $this->preparedSelect($query, $type, $data);
		}

		public function get_activos(){
			return $this->select("SELECT COUNT(id_empleado) as total FROM empleado WHERE activo");
		}		

		public function get_inactivos(){
			return $this->select("SELECT COUNT(id_empleado) as total FROM empleado WHERE !activo");
		}

		public function get_empleados_recientes(){
			return $this->select("	SELECT 
										empleado.id_empleado,
										CONCAT(empleado.nombre, ' ', empleado.ap_paterno) as nombre,
										empleado.fecha_ingreso,
									    departamento.nombre AS depto
									FROM empleado, departamento
									WHERE empleado.id_departamento = departamento.id_departamento AND activo
									ORDER BY fecha_ingreso DESC LIMIT 10");
		}
		
		public function get_consultores(){
			return $this->select("SELECT
									id_empleado,
									nombre,
									ap_paterno,
									ap_materno
								FROM	
									empleado
								WHERE	
									id_departamento 
								IN (SELECT 
										id_departamento 
									FROM departamento 
									WHERE nombre IN ('direccion','consultoria')) AND activo");
		}

		public function get_tickets_generados( $id_empleado , $limite = ""){
			
			$q = "	SELECT 
						t.id_ticket,
						t.fecha_creacion,
						t.asunto,
						t.prioridad,
						t.fecha_inicio,
						t.fecha_final,
						t.id_estado, 
						c.dominio AS cliente,
						et.descripcion AS estado,
						d.nombre AS departamento,
						CONCAT(e.nombre, ' ', e.ap_paterno, ' ', e.ap_materno) as involucrado
					FROM 
						ticket t, cliente c, estado_ticket et, empleado e, departamento d
					WHERE 
						t.id_emisor = ? AND 
						t.id_cliente = c.id_cliente AND
						t.id_destinatario = e.id_empleado AND
						t.id_estado = et.id_estado AND
						d.id_departamento = e.id_departamento ORDER BY t.id_estado ASC " . $limite;

			return $this->preparedSelect( $q, 'i', array('id_empleado' => $id_empleado) );
		}

		public function get_ultimos_tickets_generados( $id_empleado){
			
			$q = "	SELECT 
						t.id_ticket,
						t.asunto,
						t.prioridad,
						c.dominio AS cliente,
						t.id_estado,
						t.fecha_creacion,
						et.descripcion AS status,
						CONCAT(e.nombre, ' ' , e.ap_paterno) AS destinatario,
						e.email_empresa,
						u.id_user					
					FROM 
						ticket t, cliente c, estado_ticket et, empleado e, op_user u
					WHERE 
						t.id_emisor = ? AND 
						t.id_estado = et.id_estado AND
						t.id_destinatario = e.id_empleado AND
						t.id_destinatario = u.id_empleado AND
						c.id_cliente = t.id_cliente ORDER BY t.id_ticket DESC  LIMIT 5";

			return $this->preparedSelect( $q, 'i', array('id_empleado' => $id_empleado) );
		}

		public function get_tickets_asociados($id_empleado, $limite){

			$limite = $limite == 'todo' ? '' : 't.id_estado BETWEEN 1 AND 2 AND';

			$q = "	SELECT 
						t.id_ticket,
						t.fecha_creacion,
						t.asunto,
						t.fecha_inicio,
						t.fecha_final,
						t.prioridad,
						t.id_estado,
						c.dominio AS cliente,
						et.descripcion AS estado,
						t.id_emisor,
						(SELECT CONCAT(nombre,' ',ap_paterno) FROM empleado WHERE id_empleado = t.id_emisor) AS emisor
					FROM 
						ticket t, 
						departamento d, 
						empleado e, 
						cliente c,
						estado_ticket et
					WHERE 
						t.id_destinatario = ? AND 
						t.id_destinatario = e.id_empleado AND 
						t.id_cliente = c.id_cliente AND
						t.id_estado = et.id_estado AND ".
						$limite . " e.id_departamento = d.id_departamento ORDER BY t.id_estado ASC";
			$t = "i";
			$data = array( 'id_empleado' => $id_empleado);

			return $this->preparedSelect($q, $t, $data);
		}

		public function get_ultimos_tickets_asociados( $id_empleado ){
			$q = "	SELECT 
						t.id_ticket,
						et.id_estado,
						CONCAT(SUBSTR(t.asunto, 1, 30), '...') AS asunto,
						c.dominio AS cliente,
						t.fecha_creacion,
						t.prioridad,
						et.descripcion AS status,
						t.id_emisor,
						u.id_user,
						e.nombre AS emisor,
						e.email_empresa
					FROM 
						ticket t, estado_ticket et, cliente c, empleado e, op_user u
					WHERE 
						t.id_destinatario = ? AND 
						et.id_estado != 3 AND
						t.id_estado = et.id_estado AND
						t.id_emisor = e.id_empleado AND
						t.id_emisor = u.id_empleado AND
						c.id_cliente = t.id_cliente ORDER BY t.id_ticket DESC LIMIT 5";

			return $this->preparedSelect( $q, 'i', array('id_empleado' => $id_empleado) );			
		}

		public function existe_empleado( $email ){
			$q = "SELECT email_empresa FROM empleado WHERE email_empresa = ?";
			$t = 's';
			$data = array( 'email_empresa' => $email );

			return $this->preparedSelect( $q, $t, $data);
		}

		public function get_empleados_por_departamento( $id_departamento){
			$q = "	SELECT id_empleado, CONCAT(nombre, ' ', ap_paterno,' ', ap_materno) AS nombre 
					FROM empleado 
					WHERE id_empleado != 143 AND id_departamento = ? AND activo";
			$t = 'i';
			$data = array('id' => $id_departamento);

			return $this->preparedSelect( $q, $t, $data);
		}

		public function get_totales( $id_empleado ){
			$q = "	SELECT CONCAT(nombre, ' ' ,ap_paterno, ' ' ,ap_materno) AS nombre, 
					(SELECT count(id_cliente) FROM cliente WHERE activo AND id_cliente IN
						( SELECT id_cliente FROM integrante_proyecto WHERE id_empleado = ?) ) AS proyectos_activos,
					(SELECT count(id_cliente) FROM cliente WHERE !activo AND id_cliente IN
						( SELECT id_cliente FROM integrante_proyecto WHERE id_empleado = ?) ) AS proyectos_inactivos,					
					(SELECT COUNT(id_prospecto) FROM prospecto WHERE id_empleado = ? ) AS prospectos,
					(SELECT COUNT(id_ticket) FROM ticket WHERE id_destinatario = ?) AS tickets_asignados,
					(SELECT COUNT(id_ticket) FROM ticket WHERE id_destinatario = ? AND id_estado != 3) AS tickets_pendientes,
					(SELECT COUNT(id_ticket) FROM ticket WHERE id_destinatario = ? AND id_estado = 3) AS tickets_resueltos,
					(SELECT COUNT(id_ticket) FROM ticket WHERE id_emisor = ?) AS tickets_generados
				FROM empleado
				WHERE id_empleado = ?";

			$t = "iiiiiiii";

			for($i = 0; $i < 8; $i++)
				$data[$i] = $id_empleado;

			return $this->preparedSelect( $q, $t, $data);
		}

		public function get_total( $id_empleado ){
			$q = "SELECT COUNT(id_empleado)	AS total FROM empleado WHERE activo AND id_empleado != ?";
			$t = "i";
			$data = array( "id_empleado" => $id_empleado);

			return $this->preparedSelect($q, $t, $data);
		}

		public function get_aniversarios(){
			$curr_month = date('Y-m-d');
			$q = "	 SELECT 	CONCAT(nombre, ' ',ap_paterno, ' ' , ap_materno ) AS nombre, 
							DATE_FORMAT(fecha_ingreso, '%d-%M-%Y'	) AS fecha_ingreso, 
							email_empresa
					FROM empleado
						WHERE MONTH(fecha_ingreso) = MONTH('".$curr_month."') AND activo ORDER BY fecha_ingreso ASC";
			return $this->select($q);
		}	

		public function get_cumpleanos(){
			$curr_month = date('Y-m-d');
			$q = "SELECT 	CONCAT(nombre, ' ',ap_paterno, ' ' , ap_materno ) AS nombre, 
							DATE_FORMAT(fecha_nac, '%d-%M-%Y'	) AS fecha_nac,	
							email_empresa
					FROM empleado
						WHERE MONTH(fecha_nac) = MONTH('".$curr_month."') AND activo ORDER BY fecha_nac ASC";
			return $this->select($q);			
		}

	}
?>