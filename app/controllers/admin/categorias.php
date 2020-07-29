<?php
    class categorias extends Controller{
        
        function __construct(){
            parent::__construct();            
        }
        
        function index(){
            $this->view->render('admin/categorias');
        }
        
        function cargar_tabla(){
            $alumnos = $this->model->get();
            $data_array = array();
            foreach($alumnos as $row){
                $data_array['data'][] = $row;
            }            
            echo json_encode($data_array);
        }
        
        function insertar(){
            $nombre_categoria = $_POST['nombre_categoria'];
            $activo = $_POST['activo'];
            
            $this->model->guardar(['nombre_categoria'=>$nombre_categoria, 'activo'=>$activo]);
            
        }
        
        function modificar(){
            $id = $_POST['id'];            
            $nombre_categoria = $_POST['nombre_categoria'];
            $activo = $_POST['activo'];
            
            $this->model->guardar(['id'=>$id, 'nombre_categoria'=>$nombre_categoria, 'activo'=>$activo]);
        }
        
        function eliminar(){
            $id = $_POST['id'];
            $this->model->eliminar($id);
        }
    }
?>