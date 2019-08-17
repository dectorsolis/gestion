<?php 

    class Prospecto extends Db{
        
        public function get_prospectos($id = 0){
            if( $id == 0)
                return $this->select("SELECT  
                                        p.id_prospecto,
                                        p.nombre_empresa,
                                        p.dominio,
                                        p.fecha_contacto,
                                        p.nombre_contacto,
                                        p.id_empleado,
                                        p.fuente,
                                        p.id_estatus,
                                        CONCAT(e.nombre, ' ', e.ap_paterno,' ', e.ap_materno) AS nombre,
                                        ep.descripcion
                                    FROM prospecto p, empleado e, op_estatus_prospecto ep
                                    WHERE 
                                        p.id_empleado = e.id_empleado AND 
                                        
                                        p.id_estatus = ep.id_estatus
                                    ORDER BY 
                                        p.id_prospecto ASC");
            
            else{
            
                $query = "SELECT  
                                p.id_prospecto,
                                p.nombre_empresa,
                                p.dominio,
                                p.fecha_contacto,
                                p.nombre_contacto,
                                p.id_empleado,
                                p.fuente,
                                p.id_estatus,
                                CONCAT(e.nombre, ' ', e.ap_paterno,' ', e.ap_materno) AS nombre,
                                ep.descripcion
                            FROM prospecto p, empleado e, op_estatus_prospecto ep
                            WHERE 
                                p.id_prospecto = ? AND
                                p.id_empleado = e.id_empleado AND 
                                p.id_estatus = ep.id_estatus";    
                
                return $this->preparedSelect($query, 'i', ['id' => $id]);                            
            }
                
        }
        
        public function create( $prospecto ){

            $q = "INSERT INTO prospecto 
                    (   nombre_empresa, 
                        dominio, 
                        fecha_contacto, 
                        nombre_contacto, 
                        id_empleado, 
                        fuente, 
                        id_estatus) VALUES  (?,?,?,?,?,?,?)";

            $t = "ssssisi";
            
            return $this->preparedQuery( $q, $t, $prospecto);
        }
        
        public function update($prospecto){
            $query = "  UPDATE prospecto
                        SET 
                           nombre_empresa = ?, 
                           dominio = ?, 
                           fecha_contacto = ?, 
                           nombre_contacto = ?, 
                           id_empleado = ?, 
                           fuente = ?, 
                           id_estatus = ?
                        WHERE id_prospecto = ?";

                        
           return $this->preparedQuery($query, "ssssisii", $prospecto);
        }
        
        public function delete($prospecto){
            $q = "DELETE FROM prospecto WHERE id_prospecto = ? AND id_empleado = ?";
            return $this->preparedQuery($q, 'ii', $prospecto);
        }
        
        public function get_prospectos_por_empleado( $id_empleado, $limite = ''){
            $q = "  SELECT 
                        *
                    FROM 
                        prospecto p, 
                        op_estatus_prospecto ep 
                    WHERE 
                        p.id_empleado = ? AND 
                        p.id_estatus = ep.id_estatus " . $limite;
            $t = 'i';
            $data = array( 'id_empleado' => $id_empleado );
            return $this->preparedSelect( $q, $t, $data);
        }

        public function get_estatus(){
            return $this->select("SELECT id_estatus, descripcion FROM op_estatus_prospecto");
        }

        public function get_id_empleado( $id_prospecto ){
            $q = "SELECT id_empleado FROM prospecto WHERE id_prospecto = ?";
            $t = 'i';
            $data = array(
                'id' => $id_prospecto
            );

            if( $id_empleado = $this->preparedSelect( $q, $t, $data) )
                return $id_empleado[0]['id_empleado'];
            else
                return 0;
        }

        public function get_total(){
            $q = "SELECT COUNT(id_prospecto) AS total FROM prospecto WHERE id_estatus != 3";
            return $this->select($q);
        }

        public function get_top_prospeccion(){
            $q = "SELECT 
                    CONCAT(e.nombre, ' ' , e.ap_paterno ) AS nombre,
                    COUNT(p.id_prospecto) AS total,
                    u.id_user,
                    e.email_empresa
                FROM 
                    empleado e, prospecto p, op_user u
                WHERE
                    p.id_empleado = e.id_empleado
                AND
                    u.id_empleado = e.id_empleado
                GROUP BY nombre
                ORDER BY total DESC 
                LIMIT 10";

            return $this->select($q);
        }

        public function valido( $id_prospecto, $id_empleado ){
            $q =    "SELECT  1 FROM prospecto WHERE  id_prospecto = ? AND id_empleado = ?";
            $t = "ii";
            $data = array(
                "id_prospecto" => $id_prospecto,
                "id_empleado" => $id_empleado
            );

            return $this->preparedSelect( $q, $t, $data );
        }

        public function get_pipeline( $id_prospecto ){
            $q =  "SELECT * FROM op_pipeline WHERE id_prospecto = ? ";     

            $t = 'i';       
            $data = array("id" => $id_prospecto);

            return $this->preparedSelect( $q, $t, $data);
        }

             

    }
?>