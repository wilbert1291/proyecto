<?php
include_once 'app/turnos.php';
    class turnosModel extends Model{
        
        public function __construct(){
            parent::__construct();
        }
        
        public function get(){
            $turnos = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_turnos");
                while($row = $query->fetch()){
                    $turno = new turnos_adapter();
                    $turno->id_turno = $row['int_IdTurno'];
                    $turno->nombre_turno = $row['vch_Turno'];
                    array_push($turnos, $turno);
                }
                return $turnos;
            }catch(PDOException $e){
                return [];
            }
        }
    }
?>