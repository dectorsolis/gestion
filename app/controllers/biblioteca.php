<?php

	class Biblioteca extends Controller{

		public function __construct(){

		}

		public function index(){

		}

		public function multimedia(){
			$data = array(
				'titulo' => 'Recursos SEO Multimedia'
			);
			$this->view("biblioteca/multimedia", $data);
		}

		public function descargas(){

			$data = array(
				'titulo' => 'Descarga de documentos'
			);

			$this->view("biblioteca/descargas", $data);
		}

	}