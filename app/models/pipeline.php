<?php 
	Class Pipeline extends Db{

		public function create( $pipeline ){
			$q = "INSERT INTO op_pipelines(id_seccion, nombre, no_fases) VALUES(?,?,?)";
			$t = "isi";

			if( $this->preparedQuery( $q, $t, $pipeline ) )
				return $this->get_connection()->insert_id;
			return 0;
		}

		public function update( $pipeline ){
			$q = "	UPDATE op_pipelines 
					SET id_seccion = ?, nombre = ?, no_fases = ?, json_fases = ?
					WHERE id_pipeline = ?";
			$t = "isisi";

			return $this->preparedQuery( $q, $t, $pipeline );
		}
		public function valido( $id ){
			$q = "SELECT 1 FROM op_pipelines WHERE id_pipeline = ?";
			$t = 'i';
			$data = array( 'id' => $id );
			return $this->preparedSelect( $q, $t, $data);
		}

		public function get_pipeline( $id_pipeline ){
			$q = "SELECT * FROM op_pipelines WHERE id_pipeline = ?";
			$t = 'i';
			$data = array("id" => $id_pipeline);

			return $this->preparedSelect($q, $t, $data);
		}

		public function update_pipeline_status( $update ){
			$q = "UPDATE op_pipeline SET ultima_fase = ? WHERE id_pipeline = ?";
			$t = "ii";

			
			return $this->preparedQuery($q, $t, $update);
		}
	}
?>