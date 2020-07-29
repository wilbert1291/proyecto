<?php
include_once 'app/sexos.php';
    class sexosModel extends Model{
        
        public function __construct(){
            parent::__construct();
        }
        
        public function get(){
            $sexos = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_sexos");
                while($row = $query->fetch()){
                    $sexo = new sexos_adapter();
                    $sexo->clave_sexo = $row['int_IdSexo'];
                    $sexo->nombre_sexo = $row['vch_Sexo'];
                
                    array_push($sexos, $sexo);
                }
                return $sexos;
            }catch(PDOException $e){
                return [];
            }
        }
        
        public function guardar($data){
        if(isset($data['id'])){
            $query = $this->db->prepare("UPDATE tbl_sexos SET vch_Sexo = :nombre WHERE int_IdSexo = :id");    
            $query->execute(['id'=>$data['id'], 'nombre'=>$data['nombre']]);
            
            echo "Datos guardados";
        } else {
            $query = $this->db->prepare("INSERT INTO tbl_sexos (vch_Sexo) VALUES (:nombre)");    
            $query->execute(['nombre'=>$data['nombre']]);
            
            echo "Datos insertados";
        }
        
        
    }
    
    public function eliminar($id){
        $query = $this->db->prepare("DELETE FROM tbl_sexos WHERE int_IdSexo = :id");    
            $query->execute(['id'=>$id]);
            
            echo "Datos guardados";
    }
    }
?>