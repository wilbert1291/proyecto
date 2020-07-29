<?php
    class cursos extends Controller{
        
        function __construct(){
            parent::__construct();
            $this->view->categorias = [];
        }
        
        function index(){
            $categorias = $this->model->categorias();
            $this->view->categorias = $categorias;
            
            $this->view->render('admin/cursos');
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
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $descripcion = $_POST['descripcion'];
            $this->model->guardar(['nombre'=>$nombre, 'categoria'=>$categoria, 'descripcion'=>$descripcion]);
            
        }
        
        function modificar(){
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $categoria = $_POST['categoria'];
            $descripcion = $_POST['descripcion'];
            $this->model->guardar(['id'=>$id,'nombre'=>$nombre, 'categoria'=>$categoria, 'descripcion'=>$descripcion]);
        }
        
        function eliminar(){
            $id = $_POST['id'];
            $this->model->eliminar($id);
        }
    }
?>