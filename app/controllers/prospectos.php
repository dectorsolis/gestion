<?php 
    class Prospectos extends Controller{
        
        protected $fuentes;

        public function __construct(){

            $this->fuentes = array(

                'ADWORDS',
                'ORGANICO',
                'COLD CALLING',
                'ANUNCIO',
                'PERIODICO',
                'REVISTA',
                'TELEVISION',
                'MERCADO NATURAL',
                'REDES SOCIALES',
                'OTROS'
            );
        }
        public function index(){
            $modelo = $this->model("prospecto");

            $data = array(
                'titulo'     => "Lista general de prospectos",
                'prospectos_json' => json_encode($modelo->get_prospectos()),
                'type'       => 'list'
            );
            $this->view("prospectos/index", $data);
        }
        
        public function nuevo(){
            
            if( $_POST ){
                
                $redirect = PATH . "prospectos/mis-prospectos";
                
                if(!$this->prueba_de_post( $_POST, "prospecto", "create" ))
                    $redirect = PATH . "prospectos/nuevo/";
                
                header("Location: " . $redirect);  
                exit();
            }

            $prospecto = $this->model('prospecto');

            $data = array(
                'titulo'    => "Agregar nuevo prospecto",
                'action'    => PATH . "prospectos/nuevo/",
                'estatus'   => $prospecto->get_estatus(),
                'fuentes'   => $this->fuentes
            );
            
            $this->view("prospectos/nuevo", $data);
        }
        
        public function editar($id = 0){
            
            $id_empleado = $this->helper('helper_usuarios')->get_id_empleado();

            if( $_POST){
                               
                $redirect = PATH . "prospectos/mis-prospectos";

                if( isset( $_POST['estatus'] ) ){

                    $campos_no_requeridos = array(
                        'nombre_empresa' => '', 
                        'fecha_contacto' => '', 
                        'nombre_contacto' => '',
                        'fuente' => ''
                    );

                    $this->prueba_de_post( $_POST, "prospecto", "update", null, $campos_no_requeridos);

                    if( $_POST['estatus'] == 3 ){
                    
                        $nuevo_cliente = array(
                            'nombre_empresa' => $_POST['nombre_empresa'],
                            'dominio' => $_POST['dominio'],
                            'fecha_ingreso' => date('Y-m-d'),
                            'activo' => true,
                            'id_region' => $this->helper('helper_usuarios')->get_id_region(),
							'membresia' => 1
                        );      
                        
                        $id_cliente = $this->model('cliente')->prospecto_cliente( $nuevo_cliente );
                        
                        if( $id_cliente != 0 ){
                            
                            $proyecto = array(
                                'id_cliente' => $id_cliente,
                                'id_empleado' => $id_empleado
                            );

                            $this->model('proyecto')->agregar_integrante( $proyecto );
                            $redirect = PATH . 'clientes/editar/' . $id_cliente;
                        }
                    }
                }
                    
                header("Location: " . $redirect);
                exit();
            }
            
            $prospecto = $this->model('prospecto');

            if( $prospecto->get_id_empleado( $id ) == $id_empleado){

                $data = array(
                    'titulo'        => 'Editar información de prospecto',
                    'action'        => PATH . "prospectos/editar/" . $id . "/",
                    'update_data'   => $prospecto->get_prospectos($id),
                    'estatus'       => $prospecto->get_estatus(),
                    'fuentes'       => $this->fuentes
                );
                
                $modelo = $this->model("empleado");
                $this->view("prospectos/nuevo", $data);

            }
            else
                header("Location: " . PATH . 'prospectos/mis-prospectos/');
        }
        
        public function eliminar( $id_prospecto ){
            
            $prospecto = $this->model('prospecto');
            $id_empleado = $this->helper('helper_usuarios')->get_id_empleado();

            if( $prospecto->valido($id_prospecto, $id_empleado) )
                $this->prueba_de_post( array('id_prospecto' => $id_prospecto, 'id_empleado' => $id_empleado) , 'prospecto', 'delete');
            
            header("Location: " . PATH . 'prospectos/mis_prospectos/');
            
        }

        public function mis_prospectos(){
            $id_empleado = $this->helper('helper_usuarios')->get_id_empleado();

            $prospecto = $this->model('prospecto');

            $data = array(
                'titulo' => 'Mis prospectos',
                'prospectos' => $prospecto->get_prospectos_por_empleado( $id_empleado ),
                'type'  => 'edit',
                'action_analisis' => PATH . "prospectos/analisis/"
            );
            $this->view( 'prospectos/mis_prospectos', $data);
        }

        public function analisis(){
            
            if( $_POST){
                
                if( isset( $_POST['id_prospecto'] ) ){
                    $_POST['created_at'] = date('Y-m-d');
                    $this->prueba_de_post( $_POST, "analisis", "create");    
                }
                
            }
            header("Location: " . PATH . 'prospectos/mis-prospectos' );
        }

        public function ficha( $id_prospecto ){

            $id_empleado = $this->helper("helper_usuarios")->get_id_empleado();
            $prospecto = $this->model("prospecto");


            if( $prospecto->valido( $id_prospecto, $id_empleado ) ){

                /*Si es prospecto valido obtenemos su pipeline*/
                $pipeline = (Object)$prospecto->get_pipeline( $id_prospecto )[0];
                

                if( $_POST ){

                   if( isset( $_POST["type"] ) ){

                        switch( $_POST["type"] ){

                            case "update_status_pipeline": 

                                $update = array(
                                    "ultima_fase" => $_POST['ultima_fase'],
                                    "id_pipeline" => $_POST['id_pipeline']
                                );

                                $this->prueba_de_post( $update, "pipeline", "update_pipeline_status");
                            break;

                            case "create_note": 
                                $meta = array(
                                    "id_pipeline" => $pipeline->id_pipeline,
                                    "meta_key" => "pipeline_note_" . date("YmdHis"),
                                    "meta_value" => $_POST['editordata']
                                );

                                $this->prueba_de_post( $meta, "pipeline_meta", "create");
                            break;
                        }
                   }
                   header("Location: " . PATH . "prospectos/ficha/" . $id_prospecto);
                }
                
                $pipeline_meta = $this->model("pipeline_meta");

                $info_prospecto = $prospecto->get_prospectos( $id_prospecto )[0];
                $info_meta = $pipeline_meta->get_meta( "pipeline_note_%", $pipeline->id_pipeline);

                $data = array(

                    "info_prospecto" => array(
                        "titulo"    => "Ficha prospecto #" . $id_prospecto,
                        "datos"     => $info_prospecto
                    ),

                    "pipeline" => array(
                        "titulo"    => "Seguimiento a " . $info_prospecto['nombre_empresa'] . " - " . $info_prospecto["dominio"],
                        "action"    => PATH . "prospectos/ficha/" . $id_prospecto,
                        "pipeline_fases" => array(
                            "Prospeccion",
                            "Primer contacto",
                            "Precalificación",
                            "Reunión",
                            "Propuesta",
                            "Negociación"),
                        "pipeline"  => $pipeline
                    ),

                    "notas" => array(
                        "titulo" => "Historial de información",
                        "action" => PATH . "prospectos/ficha/" . $id_prospecto,
                        "meta" => $info_meta
                    )
                );

                $this->view("prospectos/ficha", $data);
            }
            else
                $this->e404();
        }

    }
?>