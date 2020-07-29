<?php
include_once 'app/municipios.php';
    class municipiosModel extends Model{
        
        public function __construct(){
            parent::__construct();
        }
        
        public function get($id_estado){
            $municipios = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_municipios where chrClvEdo ='" . $id_estado . "'");
                while($row = $query->fetch()){
                    $municipio = new municipios_adapter();
                    $municipio->clave_municipio = $row['chrNumMunicipio'];
                    $municipio->clave_estado = $row['chrClvEdo'];
                    $municipio->nombre_municipio = $row['vchNomMunicipio'];
                
                    array_push($municipios, $municipio);
                }
                return $municipios;
            }catch(PDOException $e){
                return [];
            }
        }
    }
?>