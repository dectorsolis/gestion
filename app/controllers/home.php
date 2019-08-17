<?php 

	class Home extends Controller{
		
		public function index(){
			
			$helper = $this->helper('helper_usuarios');
			$id_rol = $helper->get_id_rol();
			$view 	= "";
			$data = [];
			
			switch( $id_rol ){

				case 1: 
					$cliente  = $this->model("cliente");
					$empleado = $this->model("empleado");
					$region = $this->model("region");
					$departamento = $this->model("departamento");
					$helper = $this->helper("helpers");
					
					$data = array(
						'titulo'			=> "¡ Bienvenido!",
						'total_clientes' 	=> $cliente->get_activos(),
						'ultimos_clientes'	=> $cliente->get_clientes_recientes(), ["fecha_ingreso"],
						'total_empleados'	=> $empleado->get_activos(),
						'ultimos_empleados' => $empleado->get_empleados_recientes(),
						'total_oficinas'	=> $region->get_total_regiones(),
						'total_deptos'		=> $departamento->get_total_deptos()
					);

					$view 	= "home/admin_home";

				break;

				case 3: 
					
					$usuario = $this->model("usuario");
					$empleado 	= $this->model("empleado");
					$prospecto 	= $this->model("prospecto");
					$proyectos 	= $this->model("proyecto");
					$video 		= $this->model("video");
					$ticket 	= $this->model("ticket");
					$helper_usuario	= $this->helper("helper_usuarios");
					$id_empleado = $helper_usuario->get_id_empleado();
					
					

					$data = array(
						"estadisticas" => array(
							"titulo" => "Trayectoria",
							"estadisticas" => (object)$empleado->get_totales( $id_empleado )[0]
						),						
						"mi_agenda" => array(
							"titulo" => "Mi lista de tareas",
							"id_user" => $helper_usuario->get_id_usuario(),
							"mi_agenda" => json_decode(str_replace("\\", "", $usuario->get_agenda( $helper_usuario->get_id_usuario())[0]["mi_agenda"]))
						),
						/*	
						"top_ten_tickets" => array(
							"titulo" => "Top 10 tickets atendidos",
							"top" => $ticket->get_top_ten()
						),	
						"top_ten_prospectos" => array(
							"titulo" => "Top 10 prospección",
							"top" => $prospecto->get_top_prospeccion()
						),
						"top_ten_tickets_mensuales_resueltos" => array(
							"titulo" => "Tickets resueltos este mes",
							"top" => $ticket->get_top_tickets_resueltos_por_mes()
						),	*/																			
						"clientes_recientes" => array(
							"titulo" => "Mis clientes recientes",
							"proyectos"	=> $proyectos->get_top_nuevos( $helper_usuario->get_id_empleado() )
							),
						"prospectos" => array(
							"titulo" => "Mis prospectos recientes",
							"prospectos"	=> $prospecto->get_prospectos_por_empleado( $id_empleado, 'LIMIT 5' ),
							),
						"tickets_asociados" => array(
							"titulo" => "Tickets que me asignaron",
							"tickets_asociados" => $empleado->get_ultimos_tickets_asociados( $id_empleado),
							),
						"tickets_generados" => array(
							"titulo" => "Tickets que envié",
							"tickets_generados" => $empleado->get_ultimos_tickets_generados( $id_empleado ),	
							)
					);

					$view 	= "home/usuario_final_home";

				break;

				/*Solo para alta de info empleados*/
				case 5: 
					$depto = $this->model('departamento');
					$region = $this->model('region');

					$data = array(
						'titulo' 		=> 'Alta de información del empleado',
						'action'		=> PATH . 'empleados/nuevo',
						'departamentos' => $depto->get_departamentos(),
						'regiones' 		=> $region->get_regiones()	
					);
					$view = "temporal/tmp_alta_empleados";
				break;
				
				case 6: 

					$usuario = $this->model("usuario");
					$empleado 	= $this->model("empleado");
					$prospecto 	= $this->model("prospecto");
					$proyectos 	= $this->model("proyecto");
					$video 		= $this->model("video");
					$ticket 	= $this->model("ticket");
					$helper_usuario	= $this->helper("helper_usuarios");
					$id_empleado = $helper_usuario->get_id_empleado();		
					$id_departamento = $helper_usuario->get_id_departamento();
					$id_region 	= $this->helper("helper_usuarios")->get_id_region();

					$data = array(
						"estadisticas" => array(
							"titulo" => "Trayectoria",
							"estadisticas" => (object)$empleado->get_totales( $id_empleado )[0]
						),							
						"mi_agenda" => array(
							"titulo" => "Mi lista de tareas",
							"action" => PATH . "usuarios/mi-agenda/",
							"id_user" => $helper_usuario->get_id_usuario(),
							"mi_agenda" => json_decode(str_replace("\\", "", $usuario->get_agenda( $helper_usuario->get_id_usuario())[0]["mi_agenda"]))
						),/*
						"top_ten_tickets" => array(
							"titulo" => "Top 10 tickets atendidos",
							"top" => $ticket->get_top_ten()
						),	
						"top_ten_prospectos" => array(
							"titulo" => "Top 10 prospección",
							"top" => $prospecto->get_top_prospeccion()
						),	
						"top_ten_tickets_mensuales_resueltos" => array(
							"titulo" => "Tickets resueltos este mes",
							"top" => $ticket->get_top_tickets_resueltos_por_mes()
						),*/
						"mi_equipo" => array(
							"titulo" => "Mi equipo",
							"empleados" => $empleado->get_equipo( $id_departamento, $id_region)
							),
						"clientes_recientes" => array(
							"titulo" => "Clientes recientes",
							"proyectos" => $proyectos->get_top_nuevos( $helper_usuario->get_id_empleado() )
							),
						"prospectos" => array(
							"titulo" => "Mis prospectos recientes",
							"prospectos"	=> $prospecto->get_prospectos_por_empleado( $id_empleado, 'LIMIT 5' ),
							),	
						"tickets_asociados" => array(
							"titulo" => "Tickets",
							"tickets_asociados" => $empleado->get_ultimos_tickets_asociados( $id_empleado),
							),
						"tickets_generados" => array(
							"titulo" => "Tickets enviados",
							"tickets_generados" => $empleado->get_ultimos_tickets_generados( $id_empleado ),	
							)		
					);
					$view = "home/director_zona/index";
				break;

				case 7: 
					$empleado = $this->model("empleado");
					$cliente = $this->model("cliente");
					$prospecto = $this->model("prospecto");
					$ticket = $this->model("ticket");
					$region = $this->model("region");

					$helper_usuario	= $this->helper("helper_usuarios");
					$id_empleado = $helper_usuario->get_id_empleado();		

					$data = array(
						"estadisticas" 	=> array(
							"title" 	=> "Estadísticas generales de Optimización",
							"empleados" => (object) $empleado->get_total( $id_empleado )[0],
							"clientes" 	=> (object) $cliente->get_estadisticas()[0],
							"prospectos" => (object) $prospecto->get_total()[0],
							"tickets" 	=> (object) $ticket->get_estadisticas()[0],
						),
						"oficinas" => array(
							"title" => "Colabores por región",
							"oficinas" => $region->get_equipos()
						)
					);
					$view = "home/ceo/index";
				break;

				case 8: 
					$empleado = $this->model('empleado');

					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
					
					$data = array(
						"aniversarios" => array(
							"titulo" => "Aniversarios mes de " . $meses[date('n')-1],
							"aniversarios" => $empleado->get_aniversarios()
						),
						"cumpleanos" => array(
							"titulo" => "Cumpleaños mes de " . $meses[date('n')-1],
							"cumpleanos" => $empleado->get_cumpleanos()
						)
					);
					$view = "/home/rh/index";
				break;

				case 9: 
					$cliente = $this->model("cliente");

					$data = array(
						"clientes" => $cliente->get_clientes()
					);
					$view = "/home/reportes/index";
				break;
			}

			if( $view && $data )
				$this->view( $view, $data);
		}

	}
?>
