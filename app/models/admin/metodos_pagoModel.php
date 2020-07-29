<?php
include_once 'app/metodos_pago.php';

class metodos_pagoModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $metodos_pago = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_metodos_pago");
            while($row = $query->fetch()){
                $metodo = new metodos_pago_adapter();                
                $metodo->clave_metodo_pago = $row['int_IdMetodoPago'];
                $metodo->nombre_metodo_pago = $row['vch_MetodoPago'];
                array_push($metodos_pago, $metodo);
            }
            return $metodos_pago;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function guardar($data){
        if(isset($data['id'])){
            $query = $this->db->prepare("UPDATE tbl_metodos_pago SET vch_MetodoPago = :nombre WHERE int_IdMetodoPago = :id");    
            $query->execute(['id'=>$data['id'], 'nombre'=>$data['nombre']]);
            
            echo "Datos guardados";
        } else {
            $query = $this->db->prepare("INSERT INTO tbl_metodos_pago (vch_MetodoPago) VALUES (:nombre)");    
            $query->execute(['nombre'=>$data['nombre']]);
            
            echo "Datos insertados";
        }
        
        
    }
    
    public function eliminar($id){
        $query = $this->db->prepare("DELETE FROM tbl_metodos_pago WHERE int_IdMetodoPago = :id");    
            $query->execute(['id'=>$id]);
            
            echo "Datos guardados";
    }
}
?>