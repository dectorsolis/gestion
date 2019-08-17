<?php
	class Agendas extends Controller{

		public function index( $fecha ='' ){
			$data = [];
			$usuario = $this->model("usuario");
			$id_user = $this->helper("helper_usuarios")->get_id_usuario();
			$agendas = $usuario->get_agenda( $id_user )[0]["mi_agenda"];
			$agendas = json_decode(str_replace("\\", "", $agendas));
			$data = array(
				"agenda_history" => array(
					"titulo" => "Historial de tareas",
					"id_user" => $id_user,
					/*"agenda_json" => str_replace("\\", "", $agendas),*/
					"agenda" => $agendas
				),
				"mi_agenda" => array(
					"titulo" => "Tareas del día: ",
					"fecha" => $fecha,
					"mi_agenda" => $agendas,
				)
			);
			
			$this->view("agendas/index", $data);
		}
	}
?>