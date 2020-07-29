<?php
    class historial_pagos extends Controller{
        
        function __construct(){
            parent::__construct();            
        }
        
        function index(){
            $this->view->render('admin/historial_pagos');
        }
        
        function cargar_tabla(){
            $alumnos = $this->model->get();
            $data_array = array();
            foreach($alumnos as $row){
                $data_array['data'][] = $row;
            }            
            echo json_encode($data_array);
        }
        
    }
?>