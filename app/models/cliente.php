<?php 

	class Cliente extends Db{

		public function __construct($cliente = []){
			
		}


		public function create($cliente){
			
			$q = "	INSERT INTO cliente
					(
						nombre,
						ap_paterno,
						ap_materno,
						dominio,
						nombre_empresa,
						creacion_dominio,
						email_empresa,
						telefono_casa,
						telefono_movil,
						fecha_ingreso,
						usuario_skype,
						id_region,
						id_membresia,
						activo
					)
					VALUES
					(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
			$t = "sssssssssssiii";
			
			if( $this->preparedQuery($q, $t, $cliente) )
				return $this->get_connection()->insert_id;
			return 0;
		}

		public function get_id_cliente(){
			return $this->get_last_id();
		}

		public function prospecto_cliente( $nuevo_cliente ){
			
			$q = "INSERT INTO cliente(
						nombre_empresa, 
						dominio, 
						fecha_ingreso, 
						activo, 
						id_region,
						id_membresia) 
				 	VALUES(?,?,?,?,?,?)";
			$t = 'sssiii';

			if( $this->preparedQuery( $q, $t, $nuevo_cliente) )
				return $this->get_connection()->insert_id;

			return 0;
		}

		public function update($cliente){
			
			$types= "sssssssssssiii";

			return $this->preparedQuery("	UPDATE cliente
											SET
												nombre = ?,
												ap_paterno = ?,
												ap_materno = ?,
												dominio = ?,
												nombre_empresa = ?,
												creacion_dominio = ?,
												email_empresa = ?,
												telefono_casa = ?,
												telefono_movil = ?,
												fecha_ingreso = ?,
												usuario_skype = ?,
												id_region = ?,
												id_membresia = ?
											WHERE id_cliente = ?", $types, $cliente);
		}

		public function cambiar_status($cliente){

			$status = $this->preparedSelect("SELECT activo FROM cliente WHERE id_cliente = ?", "i", $cliente);

			$status['status'] = boolval($status[0]['activo']);
			$status['cliente'] = $cliente['cliente'];
			unset($status[0]);

			return $this->preparedQuery("UPDATE cliente SET activo = !? WHERE id_cliente = ?", "ii", $status);
		}

		public function delete($cliente){
			return $this->preparedQuery("DELETE FROM cliente WHERE id_cliente = ?", "i", $cliente);
		}			

		public function get_keywords( $id_cliente ){
			$q = "SELECT keywords FROM cliente WHERE id_cliente = ?";
			$t = 'i';
			$data = array( 'id' => $id_cliente );

			if( $keywords = $this->preparedSelect( $q, $t, $data ) )
				return $keywords[0]['keywords'];
		}

		public function update_keywords( $keywords, $id_cliente ){
			$q = "UPDATE cliente SET keywords = ? WHERE id_cliente =  ?";
			$t = 'si';
			$data = array(
				'keywords' => $keywords,
				'id_cliente' => $id_cliente
			);

			return $this->preparedQuery( $q, $t, $data );
		}


		public function valido( $id_cliente ){
			$q = "SELECT id_cliente FROM cliente WHERE id_cliente = ?";
			$t = 'i';

			$cliente = array( 
				'id_cliente' => $id_cliente
			);

			return $this->preparedSelect( $q, $t, $cliente );
		}

		public function get_clientes($id = 0, $status = 1, $id_region = " '%' "){

			if( $id != 0)
				return  $this->select(
				"SELECT 
					c.id_cliente, 
					c.nombre, 
					c.ap_paterno, 
					c.ap_materno, 
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
					c.keywords, 
					c.datos_varios, 
					c.info_directorios, 
					c.id_membresia, 
					c.responsable_contenido,
					c.servicios_seo,
					r.nombre as region, 
					m.descripcion AS membresia 
				FROM cliente c 
				INNER JOIN region r 
					ON c.id_region = r.id_region 
				INNER JOIN op_membresia m 
					ON c.id_membresia = m.id_membresia 
				WHERE c.id_cliente = $id");	
			else
				return  $this->select("	SELECT 
											c.id_cliente,
											c.nombre,
										    c.ap_paterno,
										    c.ap_materno,
										    c.dominio,
										   	c.creacion_dominio,
										    c.nombre_empresa,
										   	c.fecha_ingreso,
										   	r.id_region,
										    r.nombre as region
										FROM cliente c 
										INNER JOIN region r 
										ON c.id_region = r.id_region AND c.activo = " . $status . 
										" AND r.id_region LIKE ". $id_region ." ORDER BY r.nombre");
		}

		public function get_activos(){
			return $this->select("SELECT count(id_cliente) as total FROM cliente WHERE activo");
		}

		public function get_inactivos(){
			return $this->select("SELECT count(id_cliente) as total FROM cliente WHERE !activo");
		}


		public function get_clientes_recientes(){
			return $this->select("	SELECT 
										id_cliente,
										CONCAT(nombre, ' ', ap_paterno, ' ', ap_materno) as nombre, dominio, 
										fecha_ingreso 
									FROM cliente
									ORDER BY fecha_ingreso DESC LIMIT 5");
		}

		public function update_mantenimiento( $cliente ){
			$mantenimiento = $this->preparedSelect("SELECT mantenimiento FROM cliente WHERE id_cliente = ?", "i", $cliente);

			$data = array(
				'status' 	=> $mantenimiento[0]['mantenimiento'],
				'cliente' 	=> $cliente['cliente']
			);
			
			print_r($data);
			die();
			return $this->preparedQuery("UPDATE cliente SET mantenimiento = ? WHERE id_cliente = ?", "ii", $data);			
		}

		public function get_basic_info( $id_cliente ){
			$q = "SELECT id_cliente, dominio FROM cliente WHERE id_cliente = ?";
			$t = 'i';
			$data = array( 'id' => $id_cliente);

			return $this->preparedSelect( $q, $t, $data );
		}
		
		public function update_datos_varios( $datos_varios ){
			
			$q = "UPDATE cliente SET datos_varios = ? WHERE id_cliente = ?";
			$t = "si";
			return $this->preparedQuery( $q, $t, $datos_varios );
		}

		public function update_info_directorios( $info_directorios ){
			$q = "UPDATE cliente SET info_directorios = ? WHERE id_cliente = ?";
			$t = "si";

			return $this->preparedQuery( $q, $t, $info_directorios);
		}
		
		public function update_responsable_contenido( $responsable_contenido ){
			$q = "UPDATE cliente SET responsable_contenido = ? WHERE id_cliente = ?";
			$t = "si";
			return $this->preparedQuery( $q, $t, $responsable_contenido);
		}

		public function update_servicios_seo( $servicios_seo ){
			$q = "UPDATE cliente SET servicios_seo = ? WHERE id_cliente = ?";
			$t = "si";
			return $this->preparedQuery( $q, $t, $servicios_seo);
		}

		public function get_estadisticas(){
			$q = "	SELECT COUNT(id_cliente) AS total,
					(SELECT count(id_cliente)FROM cliente WHERE activo) AS activos,
					(SELECT count(id_cliente)FROM cliente WHERE !activo) AS inactivos
					FROM cliente";

			return $this->select( $q );
		}

		public function get_servicios_seo( $id_cliente ){
			$q = "SELECT servicios_seo FROM cliente WHERE id_cliente = ?";
			$t = 'i';
			$id_cliente = array( 'id' => $id_cliente );
			return $this->preparedSelect($q, $t, $id_cliente);
		}

		public function get_tickets_asociados( $id_cliente, $id_empleado){
			$q = "					SELECT 
										t.id_ticket,
										t.fecha_creacion,
										t.asunto,
										t.prioridad,
										t.fecha_inicio,
										t.fecha_final,
										t.id_estado,
										t.id_cliente, 
										c.dominio AS cliente,
										et.descripcion AS estado
									FROM 
										ticket t, cliente c, estado_ticket et
									WHERE 
										
										c.id_cliente = ? AND
										t.id_cliente = ? AND
										t.id_estado = et.id_estado AND
										t.id_destinatario = ?
									ORDER BY t.fecha_creacion";
			$t = "iii";
			$data = array('id_cliente' => $id_cliente, 'id_cliente2' => $id_cliente, 'id_empleado' => $id_empleado);

			return $this->preparedSelect($q, $t, $data);
		}
	}
?>