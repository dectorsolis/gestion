<?php

	class Reportes extends Controller{

		public function index(){

		}

		public function ficha(){
			$cliente =  $this->model("cliente");

			$data = array(
				"titulo" => "Lista de clientes",
				"clientes" => $cliente->get_clientes()
			);
			$this->view("reportes/index", $data);

			/*
			$helper_usuario =  $this->helper("helper_usuarios"); //equivalente a  | $variable = new Clase();

			$data = array(
				"titulo" => "Mi nombre es : " . $helper_usuario->get_nombre_usuario(),
				"mensaje" => "Mi nombre de usuario es: " . $helper_usuario->get_username()
			);
			$this->view("reportes/index", $data);*/


		}
	}