<?php
include_once 'app/categorias.php';

class categoriasModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $categorias = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_categorias");
            while($row = $query->fetch()){
                $categoria = new categorias_adapter();                
                $categoria->clave_categoria = $row['int_IdCategoria'];
                $categoria->nombre_categoria = $row['vch_NombreCategoria'];
                $categoria->activo = $row['bit_Activo'];
                $categoria->imagen = $row['vch_Imagen'];
                array_push($categorias, $categoria);
            }
            return $categorias;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function guardar($data){
        if(isset($data['id'])){
            $query = $this->db->prepare("UPDATE tbl_categorias SET vch_NombreCategoria = :nombre, bit_Activo = :activo WHERE int_IdCategoria = :id");    
            $query->execute(['id'=>$data['id'], 'nombre'=>$data['nombre_categoria'], 'activo'=>$data['activo']]);
            
            echo "Datos guardados";
        } else {
            $query = $this->db->prepare("INSERT INTO tbl_categorias (vch_NombreCategoria, bit_Activo, vch_Imagen) VALUES (:nombre, :activo, :imagen)");    
            $query->execute(['nombre'=>$data['nombre_categoria'], "imagen"=>"Sin imagen", 'activo'=>$data['activo']]);
            
            echo "Datos insertados";
        }
        
        
    }
    
    public function eliminar($id){
        $query = $this->db->prepare("DELETE FROM tbl_categorias WHERE int_IdCategoria = :id");    
            $query->execute(['id'=>$id]);
            
            echo "Datos guardados";
    }
}
?>
