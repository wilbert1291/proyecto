<?php
include_once 'app/niveles_escolares.php';
    class niveles_escolaresModel extends Model{
        
        public function __construct(){
            parent::__construct();
        }
        
        public function get(){
            $niveles = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_niveles_escolares where bit_activo = 1");
                while($row = $query->fetch()){
                    $nivel = new niveles_escolares_adapter();
                    $nivel->id_nivel_escolar = $row['int_IdNivelEscolar'];
                    $nivel->nombre_nivel_escolar = $row['vch_NombreNivelEscolar'];
                    array_push($niveles, $nivel);
                }
                return $niveles;
            }catch(PDOException $e){
                return [];
            }
        }
    }
?>