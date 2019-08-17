<?php 
	class Pipeline_Meta extends Db{

		public function create_pipeline_meta($pipeline_meta){
			$q = "INSERT INTO op_pipeline_meta(id_pipeline, meta_key, meta_value) VALUES(?,?,?)";
			$t = "iss";

<<<<<<< HEAD
			return $this->preparedQuery($q, $t, $pipeline_meta);
		}

		public function get_pipeline_meta( $meta_key, $id_pipeline ){
			$q = "	SELECT 
						id_pipeline, 
						meta_key, 
						meta_value 
					FROM op_pipeline_meta 
					WHERE meta_key LIKE ? AND id_pipeline = ?
					ORDER BY meta_key DESC";
			$t = "si";
			$meta = array(
				'meta_key' => $meta_key,
				'id_pipeline' => $id_pipeline
			);
			return $this->preparedSelect($q, $t, $meta);
=======
		public function create( $pipeline_meta ){
			$q = "	INSERT INTO op_pipeline_meta(id_pipeline, meta_key, meta_value) VALUES(?,?,?) ";
			$t = "iss";

			return $this->preparedQuery($q, $t, $pipeline_meta);
>>>>>>> 4e87d0b0ac34f99f819c65fa84cf01996a5026a5
		}
		public function update_pipeline_meta( $pipeline_meta ){
			$q = "UPDATE op_pipeline_meta  SET meta_value = ?  WHERE meta_key = ? AND id_pipeline = ?";
			$t = "ssi";

			return $this->preparedQuery( $q, $t, $pipeline_meta );
		}

		public function get_meta( $meta_key, $id_pipeline ){
			$q = "	SELECT id_meta, id_pipeline, meta_key, meta_value 
					FROM op_pipeline_meta 
					WHERE meta_key LIKE ? AND id_pipeline = ? ORDER BY meta_key DESC";
			$t = "si";

			$data = array("meta_key" => $meta_key, "id_pipeline" => $id_pipeline);

			return $this->preparedSelect( $q, $t, $data );
		}
	}
?>