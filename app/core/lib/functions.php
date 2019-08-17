<?php

	function gravatar( $email, $size ){
		return 'https://www.gravatar.com/avatar/' . MD5( $email ) . '?s=' . $size;
	}

	function view_partial( $view, $data = []){
		require_once VIEWS . $view . ".php";
	}

	function get_fecha_esp($fecha){
		$fecha = trim($fecha, " ");
		$fecha = date_parse($fecha);

		$fecha['month'] = get_mes($fecha['month']);
		return $fecha['day'] . " " . $fecha['month'] . " " . $fecha['year'];
	}

	function get_mes($mes){
		switch($mes){
			case 1: return "Enero"; break;
			case 2: return "Febrero"; break;
			case 3: return "Marzo"; break;
			case 4: return "Abril"; break;
			case 5: return "Mayo"; break;
			case 6: return "Junio"; break;
			case 7: return "Julio"; break;
			case 8: return "Agosto"; break;
			case 9: return "Septiembre"; break;
			case 10: return "Octubre"; break;
			case 11: return "Noviembre"; break;
			case 12: return "Diciembre"; break;
		}
	}	
?>