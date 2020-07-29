<?php
include_once 'app/historial_pagos.php';

class historial_pagosModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $historiales = [];
        try{
            $query = $this->db->query("SELECT hp.int_IdHistorialPago, i.vch_NombreInstitucion, mp.vch_MetodoPago, p.vch_NombrePaquete, hp.dt_FechaPago, hp.dt_FechaExpiracion from tbl_instituciones i, tbl_metodos_pago mp, tbl_paquetes p, tbl_historial_pagos hp where i.`int_IdInstitucion` = hp.`int_IdInstitucion` and mp.`int_IdMetodoPago` = hp.`int_IdMetodoPago` and p.`int_IdPaquete` = hp.`int_IdPaquete`");
            while($row = $query->fetch()){
                $historial = new historial_pagos_adapter();                
                $historial->clave_historial = $row['int_IdHistorialPago'];
                $historial->clave_metodo_pago = $row['vch_MetodoPago'];
                $historial->clave_institucion = $row['vch_NombreInstitucion'];
                $historial->clave_paquete = $row['vch_NombrePaquete'];
                $historial->fecha_pago = $row['dt_FechaPago'];
                $historial->fecha_vencimiento = $row['dt_FechaExpiracion'];
                array_push($historiales, $historial);
            }
            return $historiales;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>