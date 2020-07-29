<?php
    include_once 'app/models/admin/estadosModel.php';
    include_once 'app/models/admin/municipiosModel.php';
    include_once 'app/models/admin/localidadesModel.php';
    include_once 'app/models/admin/sexosModel.php';
    class usuarios extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->estados = [];
            $this->view->sexos = [];
            $this->view->profesores = [];
            $this->view->instituciones = [];
            $this->view->tipo_usuario = [];
        }
        
        function index(){
            //Carga variable para combo de instituciones
            $instituciones = $this->model->instituciones();
            $this->view->instituciones = $instituciones;  
            
            //Carga variable para combo de tipos de usuario
            $tipo_usuario = $this->model->tipo_usuario();
            $this->view->tipo_usuario = $tipo_usuario;  
            //Carga variable para combo de profesores
            $profesores = $this->model->profesores();
            $this->view->profesores = $profesores;   
            //Carga variable para combo de sexos
            $sexosModel = new sexosModel();
            $sexos = $sexosModel->get();
            $this->view->sexos = $sexos;
            //Carga variable para combo de estados
            $estadosModel = new estadosModel();
            $estados = $estadosModel->get();
            $this->view->estados = $estados;   
            
            //Cargar vista
            $this->view->render('admin/usuarios');
        }
        
        function cargar_tabla(){
            $alumnos = $this->model->get();
            $data_array = array();
            foreach($alumnos as $row){
                $data_array['data'][] = $row;
            }            
            echo json_encode($data_array);
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
            $nombre = $_POST['nombre'];
            $AP = $_POST['AP'];
            $AM = $_POST['AM'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $curp = $_POST['curp'];
            $id_sexo = $_POST['id_sexo'];
            $id_estado = $_POST['id_estado'];
            $id_municipio = $_POST['id_municipio'];
            $id_localidad = $_POST['id_localidad'];
            $calle = $_POST['calle'];
            $colonia = $_POST['colonia'];
            $codigo_postal = $_POST['codigo_postal'];
            $tipo_usuario = $_POST['tipo_usuario'];
            $activo = $_POST['acceso'];
            $institucion = $_POST['institucion'];
            $profesor = $_POST['profesor'];
            $grupo = $_POST['grupo'];
            $semestre = $_POST['semestre'];
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $pregunta = $_POST['pregunta'];
            $respuesta = $_POST['respuesta'];
            
            
            $this->model->guardar(["nombre"=>$nombre, "AP"=>$AP, "AM"=>$AM, "correo"=>$correo, "telefono"=>$telefono, "curp"=>$curp, "id_sexo"=>$id_sexo, "id_estado"=>$id_estado, "id_municipio"=>$id_municipio, "id_localidad"=>$id_localidad, "calle"=>$calle, "colonia"=>$colonia, "codigo_postal"=>$codigo_postal, 'tipo_usuario'=>$tipo_usuario, 'activo'=>$activo, 'institucion'=>$institucion, 'profesor'=>$profesor, 'grupo'=>$grupo, 'semestre'=>$semestre, "user"=>$user, "pass"=>$pass, "pregunta"=>$pregunta, "respuesta"=>$respuesta]);
        }
        
        function modificar(){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $AP = $_POST['AP'];
            $AM = $_POST['AM'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $curp = $_POST['curp'];
            $id_sexo = $_POST['id_sexo'];
            $id_estado = $_POST['id_estado'];
            $id_municipio = $_POST['id_municipio'];
            $id_localidad = $_POST['id_localidad'];
            $calle = $_POST['calle'];
            $colonia = $_POST['colonia'];
            $codigo_postal = $_POST['codigo_postal'];
            $tipo_usuario = $_POST['tipo_usuario'];
            $activo = $_POST['acceso'];
            $institucion = $_POST['institucion'];
            $profesor = $_POST['profesor'];
            $grupo = $_POST['grupo'];
            $semestre = $_POST['semestre'];
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $pregunta = $_POST['pregunta'];
            $respuesta = $_POST['respuesta'];
            
            
            $this->model->guardar(['id'=>$id, "nombre"=>$nombre, "AP"=>$AP, "AM"=>$AM, "correo"=>$correo, "telefono"=>$telefono, "curp"=>$curp, "id_sexo"=>$id_sexo, "id_estado"=>$id_estado, "id_municipio"=>$id_municipio, "id_localidad"=>$id_localidad, "calle"=>$calle, "colonia"=>$colonia, "codigo_postal"=>$codigo_postal, 'tipo_usuario'=>$tipo_usuario, 'activo'=>$activo, 'institucion'=>$institucion, 'profesor'=>$profesor, 'grupo'=>$grupo, 'semestre'=>$semestre, "user"=>$user, "pass"=>$pass, "pregunta"=>$pregunta, "respuesta"=>$respuesta]);        
        }
        
        function eliminar(){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $this->model->eliminar_usuario($id);
        }
    }
?>