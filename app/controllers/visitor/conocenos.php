<?php
    class conocenos extends Controller{
        
        function __construct(){    
            parent::__construct();
            $this->view->estados = [];
            $this->view->municipios = [];
            $this->view->localidades = [];
            $this->view->turnos = [];
            $this->view->nivel_escolar = [];  
            $this->view->noticias = [];
            $this->view->empleados = [];
        }
        
        function index(){
            //Carga variable para combo de estados
            $estados = $this->model->estados();
            $this->view->estados = $estados;
            //Carga variable para combo de turnos
            $turnos = $this->model->turnos();
            $this->view->turnos = $turnos;
            //Carga variable para combo de niveles escolares
            $nivelescolar = $this->model->niveles_escolares();
            $this->view->nivel_escolar = $nivelescolar;
            //Carga noticias
            $noticias = $this->model->noticias();
            $this->view->noticias = $noticias;
            //Carga paquetes
            $empleados = $this->model->paquetes_empleados();
            $this->view->empleados = $empleados;
            
            $this->view->render('visitor/conocenos');
        }
        
        function combo_municipios(){
            include_once 'app/models/visitor/conocenosModel.php';
            $id_estado = $_POST['id_estado'];
            $municipiosModel = new inicioModel();
            $municipios = $municipiosModel->municipios($id_estado);
            require_once 'app/municipios.php';
            foreach($municipios as $row){
                $mun = new municipios_adapter();
                $mun = $row;
                echo "<option value=" . $mun->clave_municipio . ">" . $mun->nombre_municipio . "</option>";
            }
        }
        
        function combo_localidades(){
            include_once 'app/models/visitor/conocenosModel.php';
            $id_estado = $_POST['id_estado'];
            $id_municipio = $_POST['id_municipio'];
            $localidadesModel = new inicioModel();
            $localidades = $localidadesModel->localidades($id_estado, $id_municipio);
            require_once 'app/localidades.php';
            foreach($localidades as $row){
                $loc = new localidades_adapter();
                $loc = $row;
                echo "<option value=" . $loc->clave_localidad . ">" . $loc->nombre_localidad . "</option>";
            }
        }
    }
?>