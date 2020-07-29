<?php

    class inicio extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->estados = [];
            $this->view->municipios = [];
            $this->view->localidades = [];
            $this->view->turnos = [];
            $this->view->nivel_escolar = [];  
            $this->view->noticias = [];
            $this->view->paquetes = [];
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
            $paquetes = $this->model->paquetes_empleados();
            $this->view->paquetes = $paquetes;
                        
            //Carga la vista
            $this->view->render('visitor/inicio');
        }
        
        function combo_municipios(){
            include_once 'app/models/visitor/inicioModel.php';
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
            include_once 'app/models/visitor/inicioModel.php';
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
        
        function activar_cuenta($param = null){
            include_once 'app/models/visitor/activar_cuenta.php';
            $model_activar = new activar_cuenta();
            $mensaje = $model_activar->activar_account($param[0]);
            $this->view->mensaje = $mensaje;
            $this->view->parametros = $param;
            $this->view->render('visitor/activar_cuenta');
        }
    }
?>