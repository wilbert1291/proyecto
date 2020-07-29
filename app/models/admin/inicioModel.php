<?php
class inicioModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function ganancias(){
        $ganancias = 0;
        try{
            $query = $this->db->query("select sum(((select count(*) from tbl_historial_pagos where int_IdPaquete = 1)*600) + ((select count(*) from tbl_historial_pagos where int_IdPaquete = 2)*800) + ((select count(*) from tbl_historial_pagos where int_IdPaquete = 3) * 1200)) as total");
            while($row = $query->fetch()){
                $ganancia = $row;
                
                
                $ganancias = $ganancia['total'];
                
            }
            return $ganancias;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function usuarios(){
        $counter = [];
        try{
            $query = $this->db->query("SELECT count(*) as total FROM tbl_usuarios");
            while($row = $query->fetch()){
                $count = $row;                
                $counter = $count['total'];
            }
            return $counter;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function instituciones(){
        $counter = [];
        try{
            $query = $this->db->query("SELECT count(*) as total FROM tbl_instituciones");
            while($row = $query->fetch()){
                $count = $row;                
                $counter = $count['total'];
            }
            return $counter;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function suscripciones(){
        $counter = [];
        try{
            $query = $this->db->query("SELECT count(*) as total FROM tbl_historial_pagos WHERE dt_FechaPago = '" . date('Y-m-d') . "'");
            while($row = $query->fetch()){
                $count = $row;                
                $counter = $count['total'];
            }
            return $counter;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>