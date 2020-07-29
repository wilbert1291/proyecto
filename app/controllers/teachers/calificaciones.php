<?php
    class calificaciones extends Controller{
        
        function __construct(){
            parent::__construct();
        }
        
        //Cargar vista
        function index(){
            //Carga la vista
            $this->view->render('teachers/calificaciones');
        }
        
        function cargar_tabla(){
            $calificaciones = $this->model->get();
            $data_array = array();
            foreach($calificaciones as $row){
                $data_array['data'][] = $row;
            }            
            echo json_encode($data_array);
        }
    }
?>