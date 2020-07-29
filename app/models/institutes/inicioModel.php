<?php
include_once 'app/alumnos.php';
include_once 'app/profesores.php';
include_once 'app/pagos.php';
class inicioModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function alumnos(){
        $alumnos = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_alumnos WHERE int_IdInstitucion = " . $_SESSION['id']);
            while($row = $query->fetch()){
                $alumno = new alumnos_adapter();
                $alumno->clave_alumno = $row['int_IdAlumno'];
                $alumno->clave_usuario = $row['int_IdUsuario'];
                $alumno->clave_institucion = $row['int_IdInstitucion'];
                $alumno->clave_profesor = $row['int_IdProfesor'];
                $alumno->grupo = $row['chr_Grupo'];
                $alumno->semestre = $row['chr_Semestre'];
                array_push($alumnos, $alumno);
            }
            return $alumnos;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function profesores(){
        $profesores = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_profesores WHERE int_IdInstitucion = " . $_SESSION['id']);
            while($row = $query->fetch()){
                $profesor = new profesores_adapter();
                $profesor->clave_profesor = $row['int_IdProfesor'];
                $profesor->clave_usuario = $row['int_IdUsuario'];
                $profesor->clave_institucion = $row['int_IdInstitucion'];
                array_push($profesores, $profesor);
            }
            return $profesores;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function suscripcion(){
        $suscripciones = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_pagos WHERE int_IdInstitucion = " . $_SESSION['id']);
            while($row = $query->fetch()){
                $suscripcion = new pagos_adapter();
                $suscripcion->clave_pago = $row['int_IdPago'];
                $suscripcion->clave_institucion = $row['int_IdInstitucion'];
                $suscripcion->clave_paquete = $row['int_IdPaquete'];
                $suscripcion->metodo_pago = $row['int_IdMetodoPago'];
                $suscripcion->fecha_inicio = $row['dt_FechaInicio'];
                $suscripcion->fecha_final = $row['dt_FechaFinal'];
                array_push($suscripciones, $suscripcion);
            }
                                     
            foreach($suscripciones as $tiempo_restante){
                $res = new pagos_adapter();
                $res = $tiempo_restante;
                                
                $date = explode('-', $res->fecha_final);
                $mes = ""; 
                
                switch($date[1]){
                    case "01":
                        $mes = "enero"; 
                        break;
                    case "02":
                        $mes = "febrero"; 
                        break;
                    case "03":
                        $mes = "marzo"; 
                        break;
                    case "04":
                        $mes = "abril"; 
                        break;
                    case "05":
                        $mes = "mayo"; 
                        break;
                    case "06":
                        $mes = "junio"; 
                        break;
                    case "07":
                        $mes = "julio"; 
                        break;
                    case "08":
                        $mes = "agosto"; 
                        break;
                    case "09":
                        $mes = "septiembre"; 
                        break;
                    case "10":
                        $mes = "octubre"; 
                        break;
                    case "11":
                        $mes = "noviembre"; 
                        break;
                    case "12":
                        $mes = "diciembre"; 
                        break;
                }
                         
                
                if($res->fecha_final == date("Y-m-d")){
                    return "Su suscripcion vence hoy.";
                } else if ($res->fecha_final < date("Y-m-d")) {
                    return "Su suscripcion ha vencido.";
                } 
                
                return $date[2] . " de " . $mes . " del " . $date[0];
            }
            
            return "No cuenta con una suscripcion activa";
        }catch(PDOException $e){
            return "No cuenta con una suscripcion activa";
        }
    }
}
?>