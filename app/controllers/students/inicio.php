<?php
    class inicio extends Controller{
        
        function __construct(){
            parent::__construct();
        }
        
        //Cargar vista
        function index(){            
            //Carga la vista
            $this->view->render('students/inicio');
        }
    }
?>