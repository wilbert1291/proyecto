<?php
    class inicio extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->alumnos = [];
        }
        
        //Cargar vista
        function index(){
            $alumnos = $this->model->cantidad_alumnos();
            $this->view->alumnos = $alumnos;
            //Carga la vista
            $this->view->render('teachers/inicio');
        }
    }
?>