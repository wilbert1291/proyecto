<?php
    class View{
        function __construct(){
            //
        }
        
        function render($vista){
            require 'resource/views/' . $vista . '.php';
        }
    }
?>
