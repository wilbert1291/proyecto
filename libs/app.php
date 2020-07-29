<?php
class App{
    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url'] : null ;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        
        $tipo_usuario = (isset($_SESSION['tipo_usuario'])) ? $_SESSION['tipo_usuario'] : null;
        
        switch($tipo_usuario){
            case "":
                if(empty($url[0])){
                    $controlador = 'app/controllers/visitor/inicio.php';
                    require_once $controlador;
                    $controller = new inicio();
                    $controller->loadModel('inicio');
                    $controller->index();
                    return false;
                }
                
                $controlador = 'app/controllers/visitor/' . $url[0] . '.php';                
                if(file_exists($controlador)){
                    require_once $controlador;
                    $controller = new $url[0];
                    
                    $controller->loadModel($url[0]);
                    
                    
                    $nparam = sizeof($url);
                    
                    if($nparam > 1){
                        if($nparam > 2){
                            $param = [];
                            for($i = 2; $i<$nparam; $i++){
                                array_push($param, $url[$i]);
                            }
                            $controller->{$url[1]}($param);
                        } else {
                            $controller->{$url[1]}();
                        }
                    } else {
                        $controller->index();
                    }
                } else {
                    require_once 'app/controllers/visitor/page_error.php';
                    $controller = new page_error();
                    $controller-> index();
                }    
                break;
                
            case "admin":
                if($url[0] != "admin"){
                    header("Location: " . constant('URL') . "admin/error");
                }
                
                if(empty($url[1])){
                    $controlador = 'app/controllers/admin/inicio.php';
                    require_once $controlador;
                    $controller = new inicio();
                    $controller->loadModel('admin/inicio');
                    $controller->index();
                    return false;
                }
                
                $controlador = 'app/controllers/' . $url[0] . '/' . $url[1] . '.php';
                
                if(file_exists($controlador)){
                    require_once $controlador;
                    $controller = new $url[1];                
                    $controller->loadModel($url[1]);
                        
                    if(isset($url[2])){
                        $controller->{$url[2]}();
                    } else {
                        $controller->index();
                    }
                } else {
                    require_once 'app/controllers/admin/page_error.php';
                    $controller = new page_error();
                    $controller-> index();
                }                     
                break;
                
            case "institute":
                if($url[0] != "institutes"){
                    header("Location: " . constant('URL') . "institutes/error");
                }
                
                if(empty($url[1])){
                    $controlador = 'app/controllers/institutes/inicio.php';
                    require_once $controlador;
                    $controller = new inicio();
                    $controller->loadModel('institutes/inicio');
                    $controller->index();
                    return false;
                }
                
                $controlador = 'app/controllers/' . $url[0] . '/' . $url[1] . '.php';
                
                if(file_exists($controlador)){
                    require_once $controlador;
                    $controller = new $url[1];                
                    $controller->loadModel($url[1]);
                        
                    if(isset($url[2])){
                        $controller->{$url[2]}();
                    } else {
                        $controller->index();
                    }
                } else {
                    require_once 'app/controllers/institutes/page_error.php';
                    $controller = new page_error();
                    $controller-> index();
                }    
                break;
                
            case "student":
                if($url[0] != "students"){
                    header("Location: " . constant('URL') . "students/error");
                }
                
                if(empty($url[0]) || empty($url[1])){
                    $controlador = 'app/controllers/students/inicio.php';
                    require_once $controlador;
                    $controller = new inicio();
                    $controller->loadModel('students/inicio');
                    $controller->index();
                    return false;
                }
                
                $controlador = 'app/controllers/' . $url[0] . '/' . $url[1] . '.php';
                
                if(file_exists($controlador)){
                    require_once $controlador;
                    $controller = new $url[1];                    
                    $controller->loadModel($url[1]);
                        
                    if(isset($url[2])){
                        $controller->{$url[2]}();
                    } else {
                        $controller->index();
                    }
                } else {
                    require_once 'app/controllers/students/page_error.php';
                    $controller = new page_error();
                    $controller-> index();
                }    
                break;
                
            case "teacher":
                if($url[0] != "teachers"){
                    header("Location: " . constant('URL') . "teachers/error");
                }
                
                if(empty($url[0]) || empty($url[1])){
                    $controlador = 'app/controllers/teachers/inicio.php';
                    require_once $controlador;
                    $controller = new inicio();
                    $controller->loadModel('teachers/inicio');
                    $controller->index();
                    return false;
                }
                
                $controlador = 'app/controllers/' . $url[0] . '/' . $url[1] . '.php';
                
                if(file_exists($controlador)){
                    require_once $controlador;
                    $controller = new $url[1];
                    $controller->loadModel($url[1]);
                        
                    if(isset($url[2])){
                        $controller->{$url[2]}();
                    } else {
                        $controller->index();
                    }
                } else {
                    require_once 'app/controllers/teachers/page_error.php';
                    $controller = new page_error();
                    $controller-> index();
                }  
                break;
        }    
    }
}
    
?>
