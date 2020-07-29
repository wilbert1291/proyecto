<?php
include_once 'app/cursos.php';
include_once 'app/categorias.php';

class cursosModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $cursos = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_cursos");
            while($row = $query->fetch()){
                $curso = new cursos_adapter();                
                $curso->clave_curso = $row['int_IdCurso'];
                $curso->clave_categoria = $row['int_IdCategoria'];
                $curso->nombre_curso = $row['vch_NombreCurso'];
                $curso->descripcion = $row['vch_Descripcion'];
                array_push($cursos, $curso);
            }
            return $cursos;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function guardar($data){
        if(isset($data['id'])){
            $query = $this->db->prepare("UPDATE tbl_cursos SET vch_NombreCurso = :nombre, int_IdCategoria = :categoria, vch_Descripcion = :descripcion WHERE int_IdCurso = :id");    
            $query->execute(['id'=>$data['id'], 'nombre'=>$data['nombre'], 'categoria'=>$data['categoria'], 'descripcion'=>$data['descripcion']]);
            
            echo "Datos guardados";
        } else {
            $query = $this->db->prepare("INSERT INTO tbl_cursos (vch_NombreCurso, int_IdCategoria, vch_Descripcion) VALUES (:nombre, :categoria, :descripcion)");    
            $query->execute(['nombre'=>$data['nombre'], 'descripcion'=>$data['descripcion'], 'categoria'=>$data['categoria']]);
            
            echo "Datos insertados";
        }
        
        
    }
    
    public function eliminar($id){
        $query = $this->db->prepare("DELETE FROM tbl_cursos WHERE int_IdCurso = :id");    
            $query->execute(['id'=>$id]);
            
            echo "Datos guardados";
    }
    
    public function categorias(){
        $categorias = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_categorias");
            while($row = $query->fetch()){
                $categoria = new categorias_adapter();                
                $categoria->clave_categoria = $row['int_IdCategoria'];
                $categoria->nombre_categoria = $row['vch_NombreCategoria'];
                array_push($categorias, $categoria);
            }
            return $categorias;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>
