<?php
    //carga el archivo de configuración con la info de la base de datos
        
    class Db{
        
        private static $connection;
        
        public function __construct(){
            self::$connection = null;
            $this->id = 0;
        }

        public function get_connection(){
            return self::$connection;
        }

        public function connect(){
            
            if( !isset(self::$$connection) ){
                $prefix = "";
                $config = parse_ini_file(MAIN_ROOT . '/configuration.ini'); 
                
                if( $_SERVER['HTTP_HOST'] == 'localhost' )
                    $prefix = "dev_";

                self::$connection = new mysqli(
                    $config[$prefix . 'hosting'], 
                    $config[$prefix . 'username'], 
                    $config[$prefix . 'password'], 
                    $config[$prefix . 'dbname']);
                self::$connection->query("SET NAMES utf8");
            }
            
            
            return self::$connection;
        }
        
        public function query($query){
            return $this -> connect() -> query($query);
            
        }
        
        public function select($query){
            $rows = array();
            $result = $this->query($query);
            
            if($result === false){
                return false;
            }
            
            while( $row = $result -> fetch_assoc()){
                $rows[] = $row;
            }
            
            return $rows;
        }
        
        public function preparedQuery($query, $types, $data, $get_last_id = false ){
            
            $stmt = $this->get_prepared_statement($query, $types, $data);

            if( $stmt->execute() ){
                
                if( $get_last_id )
                    return $stmt->insert_id;
                else
                    return $stmt->affected_rows;
            }
            return false;
        }

        public function preparedSelect($query, $types, $data){

            $stmt = $this->get_prepared_statement($query, $types, $data);

            if($stmt->execute()){
                
                $meta = $stmt->result_metadata();
                
                while($field = $meta->fetch_field()){
                    $params[] = &$row[$field->name]; 
                }    
                
                call_user_func_array([$stmt, 'bind_result'], $params);
                
                $rows = [];
                while ( $stmt->fetch() ) { 
                    
                    foreach($row as $key => $val) 
                        $tmp[$key] = $val;  
                    
                    $rows[] = $tmp;
                }    
                return $rows;
            }
            
            $stmt->close();

            return false;
        }
        

        public function get_prepared_statement($query, $types, $data){
            $params  = [];
            $params[0] = $types;
            foreach($data as $index=>$value){

                $data[$index] = $this->quote($data[$index]);
                $params[] = &$data[$index];
            }
            
            $stmt = $this->connect()->prepare($query);
            call_user_func_array([$stmt, 'bind_param'], $params);    
            
            return $stmt;        
        }

        public function error(){
            return $this -> connect() -> error;
        }
        
        /*
        * Para escapar caracteres extraños y proteger la base de datos de SQL Injection
        */
        public function quote($value){
            $connection = $this->connect();
            return $connection -> real_escape_string($value);
        }
    }
?>