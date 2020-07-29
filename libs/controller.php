<?php
    class Controller{
        function __construct(){
            $this->view = new View();
        }
        
        function loadModel($model){
            $tipo_usuario = (isset($_SESSION['tipo_usuario'])) ? $_SESSION['tipo_usuario'] : null;
            switch($tipo_usuario){
                case "":
                    $url = 'app/models/visitor/'. $model .'Model.php';
                    break;
                case "admin":
                    $url = 'app/models/admin/'. $model .'Model.php';
                    break;
                case "institute":
                    $url = 'app/models/institutes/'. $model .'Model.php';
                    break;
                case "student":
                    $url = 'app/models/students/'. $model .'Model.php';
                    break;
                case "teacher":
                    $url = 'app/models/teachers/'. $model .'Model.php';
                    break;   
            }        
            
            if(file_exists($url)){
                require $url;
                $modelName = $model.'Model';    
                $this->model = new $modelName;
            }
        }
    }    
?>