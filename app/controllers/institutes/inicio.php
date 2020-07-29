<?php
    class inicio extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->alumnos = [];
            $this->view->profesores = [];
            $this->view->fecha = "";
        }
        
        //Cargar vista
        function index(){
            //Carga cantidad de alumnos
            $alumnos = $this->model->alumnos();
            $this->view->alumnos = $alumnos; 
            //Carga cantidad de profesores
            $profesores = $this->model->profesores();
            $this->view->profesores = $profesores; 
            //Carga fecha que termina la suscripcion
            $fecha = $this->model->suscripcion();
            $this->view->fecha = $fecha; 
            
            //Carga la vista
            $this->view->render('institutes/inicio');
        }
    }
?>