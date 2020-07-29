<?php
    class page_error extends Controller{
        
        function __construct(){
            parent::__construct();
        }
        
        //Cargar vista
        function index(){
            //Carga la vista
            $this->view->render('institutes/error');
        }
    }
?>