<?php
include_once 'app/calificaciones.php';

class calificacionesModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $calificaciones = [];
        try{
            $query = $this->db->query("SELECT ca.`int_IdCalificacion`, cu.`vch_NombreCurso`, u.`vch_Nombre`, ca.`flt_Calificacion`, ca.`int_Aciertos`, ca.`int_Errores` FROM tbl_calificaciones ca, tbl_cursos cu, tbl_alumnos a, tbl_usuarios u where ca.`int_IdCurso` = cu.`int_IdCurso` and ca.`int_IdAlumno` = a.`int_IdAlumno` and u.`int_IdUsuario` = a.`int_IdUsuario`");
            while($row = $query->fetch()){
                $calificacion = new calificaciones_adapter();
                $calificacion->clave_calificacion = $row['int_IdCalificacion'];
                $calificacion->clave_curso = $row['vch_NombreCurso'];
                $calificacion->clave_alumno = $row['vch_Nombre'];
                $calificacion->calificacion = $row['flt_Calificacion'];
                $calificacion->aciertos = $row['int_Aciertos'];
                $calificacion->errores = $row['int_Errores'];
                array_push($calificaciones, $calificacion);
            }
            return $calificaciones;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>