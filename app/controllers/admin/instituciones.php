<?php
    include_once 'app/models/admin/estadosModel.php';
    include_once 'app/models/admin/municipiosModel.php';
    include_once 'app/models/admin/localidadesModel.php';
    include_once 'app/models/admin/turnosModel.php';
    include_once 'app/models/admin/niveles_escolaresModel.php';
    class instituciones extends Controller{
        
        function __construct(){
            parent::__construct();   
            $this->view->estados = [];
            $this->view->municipios = [];
            $this->view->localidades = [];
            $this->view->turnos = [];
            $this->view->nivel_escolar = [];  
        }
        
        function index(){
            //Carga variable para combo de estados
            $estadosModel = new estadosModel();
            $estados = $estadosModel->get();
            $this->view->estados = $estados;
            //Carga variable para combo de turnos
            $turnosModel = new turnosModel();
            $turnos = $turnosModel->get();
            $this->view->turnos = $turnos;
            //Carga variable para combo de niveles escolares
            $nivel_escolarModel = new niveles_escolaresModel();
            $nivelescolar = $nivel_escolarModel->get();
            $this->view->nivel_escolar = $nivelescolar;
            
            $this->view->render('admin/instituciones');
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
        
        
        function cargar_tabla(){
            $alumnos = $this->model->get();
            $data_array = array();
            foreach($alumnos as $row){
                $data_array['data'][] = $row;
            }            
            echo json_encode($data_array);
        }
                
        function modificar(){
            $id = $_POST['id'];
            $usuario = $_POST['usuario'];
            $contrasenia = $_POST['contrasenia'];
            $nombre = $_POST['nombre'];
            $turno = $_POST['turno'];
            $nivel_escolar = $_POST['nivel_escolar'];
            $estado = $_POST['estado'];
            $municipio = $_POST['municipio'];
            $localidad = $_POST['localidad'];
            $calle = $_POST['calle'];
            $colonia = $_POST['colonia'];
            $codigo_postal = $_POST['codigo_postal'];
            $acceso = $_POST['acceso'];
            $fecha_registro = $_POST['fecha_registro'];
            $correo = $_POST['correo'];
            
            $this->model->guardar(['id'=>$id, 'usuario'=>$usuario, 'contrasenia'=>$contrasenia, 'nombre'=>$nombre, 'turno'=>$turno, 'nivel_escolar'=>$nivel_escolar, 'estado'=>$estado, 'municipio'=>$municipio, 'localidad'=>$localidad, 'calle'=>$calle, 'colonia'=>$colonia, 'codigo_postal'=>$codigo_postal, 'acceso'=>$acceso, 'fecha_registro'=>$fecha_registro, 'correo'=>$correo]);
        }
        
        function eliminar(){
            $id = $_POST['id'];
            $this->model->eliminar($id);
        }
    }
?>