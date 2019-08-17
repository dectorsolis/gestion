<?php  

	Class Helpers{

		public function __construct(){

		}

		public function empty_fields($data, $no_requeridos = array()){
			
			$empty_fields = array();

			foreach($data as $index => $value){
				if( !array_key_exists( $index, $no_requeridos) && empty($value) )
					$empty_fields[] = $index;
			}

			return $empty_fields;
		}

		public function email( $email, $asunto, $mensaje ){

			require_once PHPMAILER;

			$mail = new PHPMailer;

			$mail->isSMTP();
			$mail->SMTPSecure = 'ssl';
			$mail->Host = 'optimizacion-online.com';
			$mail->Port = 465;
			$mail->SMTPAuth = true;
			$mail->Username = 'noreply@optimizacion-online.com';
			$mail->Password = 'C@&zM)F$!Cqh';
			$mail->From = 'noreply@optimizacion-online.com';
			$mail->FromName = 'SIGO';
			$mail->AddAddress( $email );
			$mail->isHTML(true);
			$mail->Subject = utf8_decode($asunto);
			$mail->Body = $mensaje;

			if( $mail->send() )
				return true;

			return false;
		}





		public function orderby( $orden ){
			
			switch($orden){
				case "ingreso": return "e.fecha_ingreso"; break;
				case "oficina": return "e.id_departamento"; break;
				case "region": return "e.id_region"; break;
				default: return 1; break;
			}
		}
		
		public function parse_uri( $uri ){
			if( stripos( $uri, "http://") === 0 )
				return $uri;
			else
				return "http://" . $uri;
		}
		
		public function get_keywords_from_uri( $uri ){
			
			try {
				
				if( ! $sitio = @file_get_contents( $this->parse_uri( $uri ), true) )
					throw new Exception('No fue posible leer la meta tag "keywords" ');
				else{
					
					if ($sitio = strstr($sitio, 'keywords') ){
						
						$sitio = strstr($sitio, 'content');
						$quote = '"';
						$start = strpos($sitio, $quote);
						$end = strpos( $sitio, $quote, $start+1 );
						
						return substr( $sitio, $start+1, ($end-1) - $start );
					}
					else
						return 'No se halló la meta etiqueta "keywords" en ' . $uri;
				}
				
			} catch (Exception $e ) {
				return $e->getMessage();
			}

		}

		public function count_words( $txt ){
			return str_word_count( $txt );
		}

	}
?>