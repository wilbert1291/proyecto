<?php
include_once 'app/estados.php';

class estadosModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $estados = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_estados");
            while($row = $query->fetch()){
                $estado = new estados_adapter();
                $estado->clave_estado = $row['chrClvEdo'];
                $estado->nombre_estado = $row['vchNomEstado'];
                
                array_push($estados, $estado);
            }
            return $estados;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>