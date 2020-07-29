<?php
    include_once 'app/models/institutes/estadosModel.php';
    include_once 'app/models/institutes/municipiosModel.php';
    include_once 'app/models/institutes/localidadesModel.php';
    include_once 'app/models/institutes/sexosModel.php';
    
    class profesores extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->estados = [];
            $this->view->sexos = [];
        }
        
        //Cargar vista
        function index(){
            //Carga variable para combo de sexos
            $sexosModel = new sexosModel();
            $sexos = $sexosModel->get();
            $this->view->sexos = $sexos;   
            //Carga variable para combo de estados
            $estadosModel = new estadosModel();
            $estados = $estadosModel->get();
            $this->view->estados = $estados;   
            
            
            //Carga la vista
            $this->view->render('institutes/profesores');
        }
        
        function combo_municipios(){
            $id_estado = $_POST['id_estado'];
            $id_municipio = $_POST['id_municipio'];
            $municipiosModel = new municipiosModel();
            $municipios = $municipiosModel->get($id_estado);
            require_once 'app/municipios.php';
            foreach($municipios as $row){
                $mun = new municipios_adapter();
                $mun = $row;
                if($id_municipio == $mun->clave_municipio){
                    echo "<option value=" . $mun->clave_municipio . " selected>" . $mun->nombre_municipio . "</option>";    
                } else {
                    echo "<option value=" . $mun->clave_municipio . ">" . $mun->nombre_municipio . "</option>";        
                }
            }
        }
        
        function combo_localidades(){
            $id_localidad = $_POST['id_localidad'];
            $id_municipio = $_POST['id_municipio'];
            $id_estado = $_POST['id_estado'];
            $localidadesModel = new localidadesModel();
            $localidades = $localidadesModel->get($id_municipio, $id_estado);
            require_once 'app/localidades.php';
            foreach($localidades as $row){
                $loc = new localidades_adapter();
                $loc = $row;
                if($id_localidad == $loc->clave_localidad){
                    echo "<option value=" . $loc->clave_localidad . " selected>" . $loc->nombre_localidad . "</option>";
                } else {
                    echo "<option value=" . $loc->clave_localidad . ">" . $loc->nombre_localidad . "</option>";    
                }
            }
        }
        
        function insertar(){
            $id_estado = $_POST['id_estado'];
            $id_municipio = $_POST['id_municipio'];
            $id_localidad = $_POST['id_localidad'];
            $id_sexo = $_POST['id_sexo'];
            $nombre = $_POST['nombre'];
            $AP = $_POST['AP'];
            $AM = $_POST['AM'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $curp = $_POST['curp'];
            $calle = $_POST['calle'];
            $colonia = $_POST['colonia'];
            $codigo_postal = $_POST['codigo_postal'];
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $pregunta = $_POST['pregunta'];
            $respuesta = $_POST['respuesta'];
            $acceso = $_POST['acceso'];
            
            $this->model->guardar(["id_estado"=>$id_estado, "id_municipio"=>$id_municipio, "id_localidad"=>$id_localidad, "id_sexo"=>$id_sexo, "nombre"=>$nombre, "AP"=>$AP, "AM"=>$AM, "correo"=>$correo, "telefono"=>$telefono, "curp"=>$curp, "calle"=>$calle, "colonia"=>$colonia, "codigo_postal"=>$codigo_postal, "user"=>$user, "pass"=>$pass, "pregunta"=>$pregunta, "respuesta"=>$respuesta, 'acceso'=>$acceso]);
        }
        
        function modificar(){
            $id = $_POST['id'];
            $id_estado = $_POST['id_estado'];
            $id_municipio = $_POST['id_municipio'];
            $id_localidad = $_POST['id_localidad'];
            $id_sexo = $_POST['id_sexo'];
            $nombre = $_POST['nombre'];
            $AP = $_POST['AP'];
            $AM = $_POST['AM'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $curp = $_POST['curp'];
            $calle = $_POST['calle'];
            $colonia = $_POST['colonia'];
            $codigo_postal = $_POST['codigo_postal'];
            $pregunta = $_POST['pregunta'];
            $respuesta = $_POST['respuesta'];
            $acceso = $_POST['acceso'];
            
            $this->model->guardar(["id"=>$id, "id_estado"=>$id_estado, "id_municipio"=>$id_municipio, "id_localidad"=>$id_localidad, "id_sexo"=>$id_sexo, "nombre"=>$nombre, "AP"=>$AP, "AM"=>$AM, "correo"=>$correo, "telefono"=>$telefono, "curp"=>$curp, "calle"=>$calle, "colonia"=>$colonia, "codigo_postal"=>$codigo_postal, "pregunta"=>$pregunta, "respuesta"=>$respuesta, 'acceso'=>$acceso]);            
        }
        
        function eliminar(){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $this->model->eliminar_profesor($id);
        }
        
        function cargar_tabla(){
            $profesores = $this->model->get();
            $data_array = array();
            foreach($profesores as $row){
                $data_array['data'][] = $row;
            }            
            echo json_encode($data_array);
        }
    }
?>