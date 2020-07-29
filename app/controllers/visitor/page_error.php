<?php
    class page_error extends Controller{
        
        function __construct(){
            
            parent::__construct();            
        }
        
        function index(){
            $this->view->render('visitor/error');
        }
    }
?>