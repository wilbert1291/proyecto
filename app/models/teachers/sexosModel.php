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
    }
?>