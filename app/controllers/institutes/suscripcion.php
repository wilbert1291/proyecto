<?php
    class suscripcion extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->paquetes = [];
        }
        
        //Cargar vista
        function index(){
            //Carga variable para combo de paquetes
            $paquetes = $this->model->paquetes();
            $this->view->paquetes = $paquetes; 
            //Carga la vista
            $this->view->render('institutes/suscripcion');
        }
        
        function insertar(){
            $paquete = $_POST['paquete'];
            $this->model->suscribir($paquete);
        }
        
        function cargar_tabla(){
            $historial = $this->model->get();
            $data_array = array();
            foreach($historial as $row){
                $data_array['data'][] = $row;
            }            
            echo json_encode($data_array);
        }
    }
?>