<?php
include_once 'app/historial_pagos.php';
include_once 'app/pagos.php';
    class suscripcionModel extends Model{
        
        public function __construct(){
            parent::__construct();
        }
        
        public function get(){
            $historial_pagos = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_historial_pagos hp, tbl_metodos_pago mp, tbl_paquetes p WHERE hp.`int_IdMetodoPago` = mp.`int_IdMetodoPago` AND hp.`int_IdPaquete` = p.`int_IdPaquete` AND int_IdInstitucion = " . $_SESSION['id'] . " ORDER BY int_IdHistorialPago DESC");
                while($row = $query->fetch()){
                    $historial = new historial_pagos_adapter();
                    $historial->clave_historial = $row['int_IdHistorialPago'];
                    $historial->clave_metodo_pago = $row['int_IdMetodoPago'];
                    $historial->clave_paquete = $row['int_IdPaquete'];
                    $historial->fecha_pago = $row['dt_FechaPago']; 
                    $historial->fecha_vencimiento = $row['dt_FechaExpiracion'];
                    $historial->nombre_metodo = $row['vch_MetodoPago'];
                    $historial->nombre_paquete = $row['vch_NombrePaquete'];
                
                    array_push($historial_pagos, $historial);
                }
                return $historial_pagos;
            }catch(PDOException $e){
                return [];
            }
        }
        
        public function paquetes(){
            $paquetes = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_paquetes");
                while($row = $query->fetch()){
                    $paquete = new historial_pagos_adapter();
                    $paquete->id_paquete = $row['int_IdPaquete'];
                    $paquete->nombre = $row['vch_NombrePaquete'];
                    $paquete->tiempo = $row['vch_Tiempo'];
                    $paquete->precio = $row['flt_precio']; 
                    $paquete->descuento = $row['int_descuento'];
                
                    array_push($paquetes, $paquete);
                }
                return $paquetes;
            }catch(PDOException $e){
                return [];
            }
        }
        
        public function suscribir($paquete){
            $query= $this->db->query("SELECT * FROM tbl_pagos WHERE int_IdInstitucion = " . $_SESSION['id']);
            $fecha_expiracion = 0;
            
            if($query->rowCount()){
                $pagos = [];
                while($row = $query->fetch()){
                    $pago = new pagos_adapter();
                    $pago->fecha_final = $row['dt_FechaFinal'];
                    array_push($pagos, $pago);
                }     
                $query2= $this->db->prepare("UPDATE tbl_pagos SET dt_FechaFinal = :fecha_expiracion, dt_FechaInicio = :fecha_pago, int_IdMetodoPago = :metodo_pago, int_IdPaquete = :paquete");
                
                
                
                
                foreach($pagos as $row){
                    $pag = new pagos_adapter();
                    $pag = $row;
                    $fecha_exp = $pag->fecha_final;
                    if($fecha_exp>date('Y-m-d')){
                        if($paquete == 1){
                            $fecha_expiracion = date("Y-m-d",strtotime($fecha_exp."+ 3 month"));
                        } else if($paquete == 2){
                            $fecha_expiracion = date("Y-m-d",strtotime($fecha_exp."+ 6 month"));
                        } else if($paquete == 3){
                            $fecha_expiracion = date("Y-m-d",strtotime($fecha_exp."+ 1 year"));
                        }
                    } else {
                        if($paquete == 1){
                            $fecha_expiracion = date("Y-m-d",strtotime(date('Y-m-d')."+ 3 month"));
                        } else if($paquete == 2){
                            $fecha_expiracion = date("Y-m-d",strtotime(date('Y-m-d')."+ 6 month"));
                        } else if($paquete == 3){
                            $fecha_expiracion = date("Y-m-d",strtotime(date('Y-m-d')."+ 1 year"));
                        }
                    }
                }
                $query2->execute(['paquete'=>$paquete, 'metodo_pago'=>1, 'fecha_pago'=>date('Y-m-d'), 'fecha_expiracion'=>$fecha_expiracion]);              
            } else {
                $query = $this->db->prepare("INSERT INTO tbl_pagos (int_IdInstitucion, int_IdMetodoPago, int_IdPaquete, dt_FechaPago, dt_FechaExpiracion) VALUES (:institucion, :metodo_pago, :paquete, :fecha_pago, :fecha_expiracion)");
                if($paquete == 1){
                    $fecha_expiracion = date("Y-m-d",strtotime(date('Y-m-d')."+ 3 month"));
                } else if($paquete == 2){
                    $fecha_expiracion = date("Y-m-d",strtotime(date('Y-m-d')."+ 6 month"));
                } else if($paquete == 3){
                    $fecha_expiracion = date("Y-m-d",strtotime(date('Y-m-d')."+ 1 year"));
                }    
                $query->execute(['institucion'=>$_SESSION['id'], 'metodo_pago'=>'1', 'paquete'=>$paquete, 'fecha_pago'=>date('Y-m-d'), 'fecha_expiracion'=>$fecha_expiracion]);
            }
            
            $query = $this->db->prepare("INSERT INTO tbl_historial_pagos (int_IdInstitucion, int_IdMetodoPago, int_IdPaquete, dt_FechaPago, dt_FechaExpiracion) VALUES (:institucion, :metodo_pago, :paquete, :fecha_pago, :fecha_expiracion)");
            
            $query->execute(['institucion'=>$_SESSION['id'], 'metodo_pago'=>'1', 'paquete'=>$paquete, 'fecha_pago'=>date('Y-m-d'), 'fecha_expiracion'=>$fecha_expiracion]);
            
            echo "Datos insertados";
        }
    }
?>
