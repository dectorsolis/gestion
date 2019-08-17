<?php
	
	class Analisis extends Controller{

		public function index(){
			$data = [];
			$this->view( "analisis/index" , $data);
		}

		public function nuevo(){
			
			$data = array(
				"titulo" => "Solicitar análisis de sitio"
			);
			$this->view("analisis/nuevo", $data);
		}
	}