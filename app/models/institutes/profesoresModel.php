<?php
include_once 'app/usuarios.php';

class profesoresModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
         $profesores = [];
        try{
            $query = $this->db->query("select * from tbl_usuarios where (select int_IdInstitucion from tbl_profesores where int_IdUsuario = tbl_usuarios.`int_IdUsuario`) = " . $_SESSION['id']);
            while($row = $query->fetch()){
                $profesor = new usuarios_adapter();
                $profesor->clave_usuario = $row['int_IdUsuario'];
                $profesor->clave_estado = $row['int_IdEstado'];
                $profesor->clave_municipio = $row['int_IdMunicipio'];
                $profesor->clave_localidad = $row['int_IdLocalidad'];
                $profesor->clave_tipo_usuario = $row['int_IdTipoUsuario'];
                $profesor->clave_sexo = $row['int_IdSexo'];
                $profesor->nombre = $row['vch_Nombre'];
                $profesor->apellido_paterno = $row['vch_ApellidoPaterno'];
                $profesor->apellido_materno = $row['vch_ApellidoMaterno'];
                $profesor->correo = $row['vch_Correo'];
                $profesor->telefono = $row['vch_Telefono'];
                $profesor->curp = $row['vch_Curp'];
                $profesor->calle = $row['vch_Calle'];
                $profesor->colonia = $row['vch_Colonia'];
                $profesor->codigo_postal = $row['vch_CodigoPostal'];
                $profesor->nombre_usuario = $row['vch_Usuario'];
                $profesor->contrasenia = $row['vch_Contrasenia'];
                $profesor->pregunta_secreta = $row['vch_PreguntaSecreta'];
                $profesor->respuesta_secreta = $row['vch_RespuestaPSecreta'];
                $profesor->acceso = $row['bit_Activo'];
                array_push($profesores, $profesor);
            }
            return $profesores;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function eliminar_profesor($id){
        $query = $this->db->query("DELETE FROM tbl_profesores WHERE int_IdUsuario = " . $id);
        $query = $this->db->query("DELETE FROM tbl_usuarios WHERE int_IdUsuario = " . $id);
        return json_encode(array("error"=>false));
    }
    
    public function guardar($data){
        if(isset($data['id'])){
            $query = $this->db->prepare('UPDATE tbl_usuarios SET int_IdEstado = :id_estado, int_IdMunicipio = :id_municipio, int_IdLocalidad = :id_localidad, int_IdSexo = :id_sexo, vch_Nombre = :nombre, vch_ApellidoPaterno = :AP, vch_ApellidoMaterno = :AM, vch_Correo = :correo, vch_Telefono = :telefono, vch_Curp = :curp, vch_Calle = :calle, vch_Colonia = :colonia, vch_CodigoPostal = :codigo_postal, vch_PreguntaSecreta = :pregunta, vch_RespuestaPSecreta = :respuesta, bit_Activo = :activo WHERE int_IdUsuario = :id');
                        
            $query -> execute(['id'=>$data['id'],'id_estado'=>$data['id_estado'], 'id_municipio'=>$data['id_municipio'], 'id_localidad'=>$data['id_localidad'], 'id_sexo'=>$data['id_sexo'], 'nombre'=>$data['nombre'], 'AP'=>$data['AP'], 'AM'=>$data['AM'], 'correo'=>$data['correo'], 'telefono'=>$data['telefono'], 'curp'=>$data['curp'], 'calle'=>$data['calle'], 'colonia'=>$data['colonia'], 'codigo_postal'=>$data['codigo_postal'], 'pregunta'=>$data['pregunta'], 'respuesta'=>$data['respuesta'], 'activo'=>$data['acceso']]);
            
            echo "Datos guardados";
        } else {
            $query = $this->db->prepare('INSERT INTO tbl_usuarios (int_IdEstado, int_IdMunicipio, int_IdLocalidad, int_IdTipoUsuario, int_IdSexo, vch_Nombre, vch_ApellidoPaterno, vch_ApellidoMaterno, vch_Correo, vch_Telefono, vch_Curp, vch_Calle, vch_Colonia, vch_CodigoPostal, vch_Usuario, vch_Contrasenia, vch_PreguntaSecreta, vch_RespuestaPSecreta, bit_Activo) VALUES (:id_estado, :id_municipio, :id_localidad, :id_tipo_usuario, :id_sexo, :nombre, :AP, :AM, :correo, :telefono, :curp, :calle, :colonia, :codigo_postal, :user, SHA(UPPER(:user :pass)), :pregunta, :respuesta, :activo)');
            
            $query -> execute(['id_estado'=>$data['id_estado'], 'id_municipio'=>$data['id_municipio'], 'id_localidad'=>$data['id_localidad'], 'id_tipo_usuario'=>2, 'id_sexo'=>$data['id_sexo'], 'nombre'=>$data['nombre'], 'AP'=>$data['AP'], 'AM'=>$data['AM'], 'correo'=>$data['correo'], 'telefono'=>$data['telefono'], 'curp'=>$data['curp'], 'calle'=>$data['calle'], 'colonia'=>$data['colonia'], 'codigo_postal'=>$data['codigo_postal'], 'user'=>$data['user'], 'pass'=>$data['pass'], 'pregunta'=>$data['pregunta'], 'respuesta'=>$data['respuesta'], 'activo'=>$data['acceso']]);
            
            
            $lastInsertId = $this->db->lastInsertId();
            
            $query = $this->db->prepare('INSERT INTO tbl_profesores (int_IdInstitucion, int_IdUsuario) VALUES (:institucion, :usuario)');
            $query -> execute(['institucion'=>$_SESSION['id'], 'usuario'=>$lastInsertId]);
            
            echo "Datos insertados";
        }
    }
}
?>
