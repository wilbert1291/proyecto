<?php
    class inicio extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->ganancias = 0;
            $this->view->usuarios = 0;
            $this->view->instituciones = 0;
            $this->view->suscripciones = 0;
        }
        
        function index(){
            $ganancias = $this->model->ganancias();
            $this->view->ganancias = $ganancias;
            
            $usuarios = $this->model->usuarios();
            $this->view->usuarios = $usuarios;
            
            $instituciones = $this->model->instituciones();
            $this->view->instituciones = $instituciones;
            
            $suscripciones = $this->model->suscripciones();
            $this->view->suscripciones = $suscripciones;
            
            $this->view->render('admin/inicio');
        }
    }
?>