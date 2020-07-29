<?php    
    class activar_cuenta extends Model {
        
        public function __construct(){
            parent::__construct();
        }
        
        public function activar_account($codigo){
            $query = $this->db->query("SELECT * FROM tbl_activador WHERE codigo = '$codigo' AND usado = 0");
            if($query->rowCount()){
                $id_institucion = $query->fetch();
                $this->db->query("UPDATE tbl_instituciones SET bit_Activo = 1 WHERE int_IdInstitucion = " . $id_institucion['int_IdInstitucion']);
                $query = $this->db->query("UPDATE tbl_activador SET usado = 1 WHERE codigo = '$codigo'");
                return "<h1 class='h2 text-success'>Cuenta activada correctamente</h1>";
            } else {
                return "<h1 class='h2 text-danger'>Oh oh, este codigo ha expirado</h1>";
            }
        }
    }
?>