<?php 

	class Roles extends Controller{

		public function index(){

			$rol = $this->model('rol');

			$data = array(
				'titulo' => 'Administración de roles',
				'roles' => $rol->get_roles()
			);

			$this->view('roles/index', $data);
		}

		public function nuevo(){
			if( $_POST ){

				if( $this->prueba_de_post( $_POST, 'rol','create') ){
					header('Location: ' . PATH . 'roles/nuevo/' );
					exit();
				}
			}

			$data = array(
				'titulo' => 'Nuevo rol'
			);

			$this->view('roles/nuevo', $data);
		}

		public function privilegios( $id ){

			if( empty($id) )
				header("Location: " . PATH . "roles/");
			$seccion = $this->model('seccion');
			$modulo  = $this->model('modulo');
			$rol     = $this->model('rol');
			$id_rol = $rol->get_id_rol( $id );

			if( $_POST ){
				
				$array_id_modulos = serialize( $this->array_indexes_to_integer( $_POST['privilegios'] ) );
				

				$array_privilegios = array(
					'array_id_modulos' 	=> $array_id_modulos,
					'id_rol'	=> $id
				);

				if( $this->prueba_de_post( $array_privilegios, 'rol','set_privilegios') ){
					header("Location: " . PATH . 'roles/privilegios/' . $id );
					exit();
				}

			}
			

			$privilegios_rol = $rol->get_privilegios( $id );
			
			if( $privilegios_rol )
				$privilegios_rol = unserialize( $privilegios_rol[0]['privilegios'] );


			$modulos_permitidos = $this->validar_modulos( $modulo->get_modulos() , $privilegios_rol );

			$privilegios = $this->ordenar_privilegios( $seccion->get_secciones(), $modulos_permitidos );


			$data = array(
				'titulo' 		=> "Edición de privilegios",
				'permisos' 		=> $this->get_lista_privilegios( $privilegios ),
				'action_form' 	=> PATH . 'roles/privilegios/' . $id
			);
			

			$this->view('roles/privilegios', $data);
		}	

		//valida a que modulos tiene acceso el usuario
		public function validar_modulos( $modulos, $privilegios_rol){
			
			for( $i = 0; $i < count($modulos); $i++ ){
				
				$modulos[$i]['acceso'] = false;

				for( $j = 0; $j < count($privilegios_rol); $j++ ){
					if( $modulos[$i]['id_modulo'] == $privilegios_rol[$j] )
						$modulos[$i]['acceso'] = true;
				}
			}
			return $modulos;		
		}

		//crea la matriz multidimensional de permisos
		public function ordenar_privilegios( $secciones, $modulos ){

			for( $i = 0; $i < count( $secciones ); $i++ ){
				
				$secciones[$i]['modulos'] = [];

				for($j = 0; $j < count( $modulos ); $j++){
					
					if( $modulos[$j]['id_seccion'] == $secciones[$i]['id_seccion'] )

						array_push( $secciones[$i]['modulos'] , $modulos[$j] );				
				}
			}

			return $secciones;
		}	
		
		//retorna el arbol de permisos html
		public function get_lista_privilegios( $secciones){

			$tmp = "";
			foreach( $secciones as $index => $item){

				if( is_array($item) ){

					if( is_numeric($index) ){
						$tmp = $tmp . $this->get_lista_privilegios( $item ) . '</li>';
					}
					else{
						$tmp = $tmp . '<ul class="lista-permisos">' . $this->get_lista_privilegios( $item ) . '</ul>';
					}
				}
				else{
					if( $index == 'descripcion' )
						$tmp = $tmp . '<li>- ' . $item ;
					else if( $index == 'descrip'){

						$cheked = '';
						if( $secciones['acceso'] )
							$cheked = 'checked';

						$tmp = $tmp . '<li><input 
											name="privilegios[]" 
											type="checkbox" 
											value="' . $secciones['id_modulo'] . '" 
											'. $cheked . '>' . ' ' . $item ;
					}
				}

			}

			return $tmp;
		}	

		//convierte los indices del array de string a integer
		public function array_indexes_to_integer( $array_id_modulos ){
			
			foreach( $array_id_modulos as $index => $value)
				$array_id_modulos[ $index ] = intval( $value );

			return $array_id_modulos;
		}			
	}
?>