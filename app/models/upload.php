<?php

	class Upload{

		public function __construct(){

		}

		public function cargar( $imagenes ){
			
			$type	= $imagenes['evidencia']['type'];
			$error 	= $imagenes['evidencia']['error']; 
			$file 	= $imagenes['evidencia']['tmp_name'];
			$name 	= $imagenes['evidencia']['name'];

			foreach( $file as $index => $file){
				if( !$error[$index] && $type[$index] == 'image/png' || $type[$index] == 'image/jpeg')
					move_uploaded_file( $file, MAIN_ROOT . '/uploads/evidencia/' . basename( $name[$index] ) );
				else
					return false;
			}

			return true;	
		}		
	}
?>