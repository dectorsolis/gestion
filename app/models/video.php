<?php

	class Video extends Db{

		public function get_videos(){
			return $this->select( "SELECT * FROM op_video ORDER BY titulo ASC" );
		}
	}
?>