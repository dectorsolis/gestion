<?php 
	class Pipelines extends Controller{

		public function index(){

			$this->view("pipelines/index", []);
		}

		public function nuevo(){

			if( $_POST ){

				$pipeline = $this->model("pipeline");
				$redirect = PATH . "pipelines/nuevo/";
				$id_pipeline = $pipeline->create( $_POST );

				if( $id_pipeline != 0 )
					$redirect = PATH . "pipelines/editar/" . $id_pipeline ;

				header("Location: " . $redirect );
				exit();
			}

			$seccion = $this->model("op_seccion");

			$data = array(
				"titulo" => "Crear nuevo pipeline",
				"action" => "",
 				"secciones" => $seccion->get_op_secciones()
			);
			$this->view("pipelines/nuevo", $data);
		}

		public function editar( $id_pipeline ){
			$pipeline = $this->model("pipeline");
			$seccion = $this->model("op_seccion");

			if( $pipeline->valido($id_pipeline) ){

				if( $_POST ){

					$_POST['id_pipeline'] =  $id_pipeline;
					if( isset( $_POST["fases"] ) )
						$_POST["fases"] = json_encode( $_POST["fases"], JSON_UNESCAPED_UNICODE);
				
					$this->prueba_de_post($_POST, "pipeline", "update");

					header("Location: " . PATH . "pipelines/editar/" . $id_pipeline);
					exit();
				}

				$data = array(
					"titulo" 	=> "Editar mi pipeline",
					"action" 	=> PATH . "pipelines/editar/" . $id_pipeline,
					"secciones" => $seccion->get_op_secciones(),
					"pipeline" 	=> (Object)$pipeline->get_pipeline( $id_pipeline )[0]
				);
				$this->view("pipelines/nuevo", $data);
			}

			else
				$this->e404();
		}
	}
?>