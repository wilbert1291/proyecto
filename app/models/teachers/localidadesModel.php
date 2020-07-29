<?php
include_once 'app/localidades.php';

    class localidadesModel extends Model{
        
        public function __construct(){
            parent::__construct();
        }
        
        public function get($id_municipio, $id_estado){
            $localidades = [];
            try{
                $query = $this->db->query("select * from tbl_localidades where chrClvEdo = '". $id_estado ."' AND chrClvMunicipio = '" . $id_municipio . "'");
                while($row = $query->fetch()){
                    $localidad = new localidades_adapter();
                    $localidad->clave_estado = $row['chrClvEdo'];
                    $localidad->clave_municipio = $row['chrClvMunicipio'];
                    $localidad->clave_localidad = $row['chrClvLocalidad'];
                    $localidad->nombre_localidad = $row['vchNomLocalidad'];
                    array_push($localidades, $localidad);
                }
                return $localidades;
            }catch(PDOException $e){
                return [];
            }
        }
    }
?>