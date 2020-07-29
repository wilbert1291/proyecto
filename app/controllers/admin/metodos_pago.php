<?php
    class metodos_pago extends Controller{
        
        function __construct(){
            parent::__construct();            
        }
        
        function index(){
            $this->view->render('admin/metodos_pago');
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
            
            $this->model->guardar(['nombre'=>$nombre]);
            
        }
        
        function modificar(){
            $id = $_POST['id'];            
            $nombre = $_POST['nombre'];
            
            $this->model->guardar(['id'=>$id, 'nombre'=>$nombre]);
        }
        
        function eliminar(){
            $id = $_POST['id'];
            $this->model->eliminar($id);
        }
    }
?>