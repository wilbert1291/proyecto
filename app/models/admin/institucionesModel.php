<?php
include_once 'app/instituciones.php';

class institucionesModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $instituciones = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_instituciones");
            while($row = $query->fetch()){
                $institucion = new instituciones_adapter();                
                $institucion->clave_institucion = $row['int_IdInstitucion'];
                $institucion->clave_estado = $row['int_IdEstado'];
                $institucion->clave_municipio = $row['int_IdMunicipio'];
                $institucion->clave_localidad = $row['int_IdLocalidad'];
                $institucion->clave_nivel_escolar = $row['int_IdNivelEscolar'];
                $institucion->clave_turno = $row['int_IdTurno'];
                $institucion->nombre_institucion = $row['vch_NombreInstitucion'];
                $institucion->calle = $row['vch_Calle'];
                $institucion->colonia = $row['vch_Colonia'];
                $institucion->codigo_postal = $row['vch_CodigoPostal'];
                $institucion->fecha_registro = $row['dt_FechaRegistro'];
                $institucion->codigo_institucion = $row['vch_ClaveInstitucional'];
                $institucion->contrasenia = $row['vch_Contrasenia'];
                $institucion->correo = $row['vch_Correo'];
                $institucion->activo = $row['bit_Activo'];
                
                array_push($instituciones, $institucion);
            }
            return $instituciones;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function guardar($data){
        $query = $this->db->prepare('UPDATE tbl_instituciones SET int_IdEstado = :estado, int_IdMunicipio = :municipio, int_IdLocalidad = :localidad, int_IdNivelEscolar = :nivel_escolar, int_IdTurno = :turno, vch_NombreInstitucion = :nombre, vch_Calle = :calle, vch_Colonia = :colonia, vch_CodigoPostal = :codigo_postal, dt_FechaRegistro = :fecha, vch_ClaveInstitucional = :clave_institucional, vch_Contrasenia = :contrasenia, vch_Correo = :correo, bit_Activo = :activo WHERE int_IdInstitucion = :id_institucion');
        
        $query->execute(['estado'=>$data['estado'], 'municipio'=>$data['municipio'], 'localidad'=>$data['localidad'], 'nivel_escolar'=>$data['nivel_escolar'], 'turno'=>$data['turno'], 'nombre'=>$data['nombre'], 'calle'=>$data['calle'], 'colonia'=>$data['colonia'], 'codigo_postal'=>$data['codigo_postal'], 'fecha'=>$data['fecha_registro'], 'clave_institucional'=>$data['usuario'], 'contrasenia'=>$data['contrasenia'], 'correo'=>$data['correo'], 'activo'=>$data['acceso'], 'id_institucion'=>$data['id']]);
        
        echo "Datos guardados";
    }
    
    public function eliminar($id){
        $query = $this->db->query("DELETE FROM tbl_instituciones WHERE int_IdInstitucion = $id");
        return json_encode(array("error"=>false));
    }
}
?>