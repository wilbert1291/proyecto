<?php
include_once 'app/alumnos.php';

class inicioModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function cantidad_alumnos(){
        $alumnos = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_alumnos WHERE (SELECT int_IdProfesor FROM tbl_profesores WHERE int_IdUsuario = ". $_SESSION['id'] .") = int_IdProfesor");
            while($row = $query->fetch()){
                $alumno = new alumnos_adapter();
                $alumno->clave_alumno = $row['int_IdAlumno'];
                $alumno->clave_institucion = $row['int_IdInstitucion'];
                $alumno->clave_usuario = $row['int_IdUsuario'];
                $alumno->clave_profesor = $row['int_IdProfesor'];
                $alumno->grupo = $row['chr_Grupo'];
                $alumno->semestre = $row['chr_Semestre'];
                $alumno->activo = $row['bit_Activo'];
                array_push($alumnos, $alumno);
            }
            return $alumnos;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>