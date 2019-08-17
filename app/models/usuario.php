<?php

	class Usuario extends Db{

		public function create($user){
			$q = "INSERT INTO op_user(username, password, register_at, id_empleado, id_rol) VALUES (?,?,?,?,?)";
			$types = "sssii";

			if( $this->preparedQuery($q, $types, $user) ){
				
				$q = "UPDATE empleado SET usuario_activo = 1 WHERE id_empleado = ?";
				$t = 'i';
				$data = array(
					'id_empleado' => $user['id_empleado'] 
				);

				return $this->preparedQuery( $q, $t, $data);
			}

			return false;
		}

		public function delete( $user ){
			
			$q = "DELETE FROM op_user WHERE id_user = ?";
			
			if( $this->preparedQuery( $q, 'i', array('id' => $user['id_user'] ) ) ){
				$q = "UPDATE empleado SET usuario_activo = 0 WHERE id_empleado = ?";

				return $this->preparedQuery( $q, 'i', array('id' => $user['id_empleado'] ) );
			}

			return false;

		}
		
		public function valido( $id_user ){
			$q = "SELECT 1 as valido FROM op_user WHERE id_user = ?";
			$t = 'i';
			$data = array( 'id' => $id_user );

			if( $valido = $this->preparedSelect( $q, $t, $data ) )
				return $valido[0]['valido'];

			return false;
		}

		public function get_usuarios( $id = 0){
			
			if( $id == 0)
				return $this->select("	SELECT 
											u.id_user,
											u.id_empleado, 
											u.username, 
											CONCAT(e.nombre, ' ', e.ap_paterno, ' ', e.ap_materno) AS nombre,
											u.last_login, 
											u.id_rol,
											r.descripcion AS rol
										FROM op_user u, op_rol r, empleado e 
										WHERE u.id_empleado = e.id_empleado AND u.id_rol = r.id_rol");
			else{
				
				$q = "	SELECT 
							u.id_user, 
							u.username, 
							CONCAT(e.nombre, ' ', e.ap_paterno, ' ', e.ap_materno) AS nombre,
							u.register_at, 
							u.updated_at, 
							u.last_login, 
							u.id_rol,
							r.descripcion AS rol
						FROM op_user u, op_rol r, empleado e 
						WHERE u.id_user = ? AND u.id_empleado = e.id_empleado AND u.id_rol = r.id_rol";
				$t = 'i';
				$data = array(
					'id_user' => $id
				);

				return $this->preparedSelect( $q, $t, $data);
			}
			
		}

		public function get_id_usuario( $id_empleado ){

			$q = "SELECT id_user FROM op_user WHERE id_empleado = ?";
			$t = 'i';
			$data = array( 'id_empleado' => $id_empleado );
			if ( $id_user = $this->preparedSelect( $q, $t, $data ) )
				return $id_user[0]['id_user'];
			else
				return 0;
		}

		public function update_rol( $user ){
			
			$q = "UPDATE op_user SET id_rol = ? WHERE id_user = ?";
			$t = 'ii';
			
			return $this->preparedQuery( $q, $t, $user);
		}

		public function get_info_usuario( $id_empleado ){
			$q = "	SELECT 
						COUNT(ip.id_empleado) AS total_clientes,
						username,
					    concat(e.nombre, ' ', e.ap_paterno, ' ', e.ap_materno) AS nombre,
					    e.fecha_ingreso,
					    e.telefono,
					    e.usuario_skype,
					    e.fecha_nac,
					    d.nombre AS depto,
					    r.nombre AS region,
					    u.last_login,
					    u.about
					FROM op_user u, empleado e, departamento d, region r, integrante_proyecto ip
					WHERE u.id_empleado = e.id_empleado 
					AND e.id_departamento = d.id_departamento
					AND r.id_region = e.id_region
					AND ip.id_empleado = e.id_empleado
					AND u.id_user = ?";			

			$t = 'i';

			$data = array('id' => $id_empleado);

			return $this->preparedSelect( $q, $t, $data);
		}

		public function get_total_proyectos( $id_user ){
			$q = "	SELECT 
						COUNT(id_empleado) AS total_proyectos
					FROM integrante_proyecto
					WHERE id_empleado = (SELECT id_empleado FROM op_user WHERE id_user = ?)";
			$t = "i";
			$data = array( 'id' => $id_user );

			if( $total = $this->preparedSelect($q, $t, $data) )
				return $total[0]['total_proyectos'];
			return "";
		}

        public function get_total_prospectos( $id_user ){
            $q = "	SELECT 
            			COUNT(id_empleado) AS total_prospectos 
            		FROM prospecto 
            		WHERE id_empleado = (SELECT id_empleado FROM op_user WHERE id_user = ?) ";
            $t = "i";
            $data = array( 'id' => $id_user );

            if( $total = $this->preparedSelect( $q, $t, $data ) )
                return $total[0]['total_prospectos'];
            return "";
        }

		public function get_total_tickets_generados( $id_user ){
			
			$q = "	SELECT 
						COUNT(id_emisor) AS total 
					FROM ticket 
					WHERE id_emisor = ( SELECT id_empleado FROM op_user WHERE id_user = ?)";
			$t = 'i';
			
			$data = array( 'id' => $id_user );

			if( $total = $this->preparedSelect( $q, $t, $data ) )
				return $total[0]['total'];
			return "";
		}

		public function get_total_tickets_resueltos( $id_user ){
			
			$q = "	SELECT 
						COUNT(id_destinatario) AS total 
					FROM ticket 
					WHERE id_destinatario = ( SELECT id_empleado FROM op_user WHERE id_user = ?)
					AND id_estado = 3";
			$t = 'i';
			
			$data = array( 'id' => $id_user );

			if( $total = $this->preparedSelect( $q, $t, $data ) )
				return $total[0]['total'];
			return "";
		}

		public function get_total_tickets_pendientes( $id_user ){
			
			$q = "	SELECT 
						COUNT(id_destinatario) AS total 
					FROM ticket 
					WHERE id_destinatario = ( SELECT id_empleado FROM op_user WHERE id_user = ?)
					AND id_estado != 3";
			$t = 'i';
			
			$data = array( 'id' => $id_user );

			if( $total = $this->preparedSelect( $q, $t, $data ) )
				return $total[0]['total'];
			return "";
		}		

		public function update_password( $update ){
			$q = "UPDATE op_user SET password = MD5(?) WHERE id_user = ?";
			$t = 'si';

			return $this->preparedQuery( $q, $t, $update);
		}      
		/*
		public function es_integrante( $id_cliente, $id_empleado ){
			$q =  "	SELECT 1 
					FROM integrante_proyecto 
					WHERE 
						id_cliente = ? AND
						id_empleado = ?";
			$t = "ii";
			
			$data = array(
				'id_cliente' => $id_cliente,
				'id_empleado' => $id_empleado
			);
			
			return $this->preparedSelect( $q, $t, $data );
		}
		
		public function es_admin( $id_user ){
			$q = "	SELECT 1
					FROM op_user
					WHERE 
						id_rol = 1 AND
						id_user = ?";
			$t = 'i';
			
			$data = array( 'id' => $id_user );
			return $this->preparedSelect( $q, $t, $data);
						
		}*/
		
		public function get_agenda( $id_user ){
			$q = "SELECT mi_agenda FROM op_user WHERE id_user = ?";
			$t = "i";
			$data = array("id" => $id_user);
			
			return $this->preparedSelect($q, $t, $data);
		}
		
		public function update_agenda($mi_agenda, $id_user){
			$q = "UPDATE op_user SET mi_agenda = ? WHERE id_user = ?";
			$t = "si";
			$data = array(
				"mi_agenda" => $mi_agenda,
				"id_user" => $id_user
			);
			
			return $this->preparedQuery( $q, $t, $data);
		}

		public function update_about( $about ){
			$q = "UPDATE op_user SET about = ? WHERE id_user = ?";
			$t = "si";
			return $this->preparedQuery($q,$t,$about);
		}
	}
?>