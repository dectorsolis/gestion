<?php

	class Autenticacion extends Db{

		public function __construct(){}

		public function autenticar( $data ){
			$data['pass'] = md5( $data['pass'] );
			return $this->preparedSelect( " SELECT 
												u.id_user,
												u.username,
												u.register_at,
												u.updated_at,
												u.last_login,
												u.id_rol,
												CONCAT(e.nombre, ' ', e.ap_paterno) AS nombre,
												e.id_empleado,
												e.id_region,
												e.id_departamento,
												r.privilegios
											FROM op_user u, empleado e, op_rol r
											WHERE u.username = ? 
											AND u.password = ? 
											AND u.id_empleado = e.id_empleado 
											AND u.id_rol = r.id_rol
											AND e.usuario_activo
											AND e.activo", "ss", $data );
		}

		public function update_last_login( $id_user, $fecha ){
			$q = "UPDATE op_user SET last_login = ? WHERE id_user = ?";
			$t = 'si';
			$data = array(
				'last_login'	=> $fecha,
				'id_user' 		=> $id_user
			);

			return $this->preparedQuery( $q, $t, $data );
		}

		public function restaurar_password( $update_email ){
			$q = "UPDATE op_user SET password = ? WHERE username = ?";
			$t = "ss";

			return $this->preparedQuery( $q, $t, $update_email);
		}

		public function email_valido( $email ){
			$q = "SELECT 1 FROM op_user WHERE username = ?";
			$t = 's';
			$data = array( 'email' => $email );

			if( $this->preparedSelect( $q, $t, $data) )
				return true;

			return false;
		}
	}
?>