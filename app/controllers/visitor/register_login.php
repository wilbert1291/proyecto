<?php
    class register_login extends Controller{
        function __construct(){
            parent::__construct();
        }
        
        //Registrar institucion
        function registrar_institucion(){
            $clave_institucional = $_POST['clave_institucional'];
            $password = $_POST['password'];
            $nombre = $_POST['nombre'];
            $turno = $_POST['turno'];
            $nivel_escolar = $_POST['nivel_escolar'];
            $estado = $_POST['estado'];
            $municipio = $_POST['municipio'];
            $localidad = $_POST['localidad'];
            $calle = $_POST['calle'];
            $colonia = $_POST['colonia'];
            $codigo_postal = $_POST['codigo_postal'];
            $correo = $_POST['correo'];
            
            
            $this->model->guardar_institucion(['clave_institucional' => $clave_institucional, 'password'=>$password, 'nombre'=>$nombre, 'turno'=>$turno, 'nivel_escolar'=>$nivel_escolar, 'estado'=>$estado, 'municipio'=>$municipio, 'localidad'=>$localidad, 'calle'=>$calle, 'colonia'=>$colonia, 'codigo_postal'=>$codigo_postal, 'correo'=>$correo]);
                        
        }
        
        //Login Usuario
        function logear(){
            $user = $_POST['user'];
            $password = $_POST['password'];
            
            
            $this->model->iniciar_login(['user' => $user, 'password'=>$password]);
        }
    }
?>