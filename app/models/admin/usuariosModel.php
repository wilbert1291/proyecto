<?php
include_once 'app/usuarios.php';
include_once 'app/tipo_usuarios.php';
include_once 'app/instituciones.php';

class usuariosModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $usuarios = [];
        try{
            $query = $this->db->query("select * from tbl_usuarios u, tbl_profesores p where u.`int_IdUsuario` = p.`int_IdUsuario`");
            while($row = $query->fetch()){
                $usuario = new usuarios_adapter();                
                $usuario->clave_usuario = $row['int_IdUsuario'];
                $usuario->clave_estado = $row['int_IdEstado'];
                $usuario->clave_municipio = $row['int_IdMunicipio'];
                $usuario->clave_localidad = $row['int_IdLocalidad'];
                $usuario->clave_tipo_usuario = $row['int_IdTipoUsuario'];
                $usuario->clave_sexo = $row['int_IdSexo'];
                $usuario->nombre = $row['vch_Nombre'];
                $usuario->apellido_paterno = $row['vch_ApellidoPaterno'];
                $usuario->apellido_materno = $row['vch_ApellidoMaterno'];
                $usuario->correo = $row['vch_Correo'];
                $usuario->telefono = $row['vch_Telefono'];
                $usuario->curp = $row['vch_Curp'];
                $usuario->calle = $row['vch_Calle'];
                $usuario->colonia = $row['vch_Colonia'];
                $usuario->codigo_postal = $row['vch_CodigoPostal'];
                $usuario->nombre_usuario = $row['vch_Usuario'];
                $usuario->contrasenia = $row['vch_Contrasenia'];
                $usuario->pregunta_secreta = $row['vch_PreguntaSecreta'];
                $usuario->respuesta_secreta = $row['vch_RespuestaPSecreta'];
                $usuario->acceso = $row['bit_Activo'];
                $usuario->clave_institucion = $row['int_IdInstitucion'];           
                array_push($usuarios, $usuario);
            }
            
            $query = $this->db->query("SELECT * FROM tbl_usuarios u, tbl_alumnos a WHERE u.`int_IdUsuario` = a.`int_IdUsuario`");
            while($row = $query->fetch()){
                $usuario = new usuarios_adapter();                
                $usuario->clave_usuario = $row['int_IdUsuario'];
                $usuario->clave_estado = $row['int_IdEstado'];
                $usuario->clave_municipio = $row['int_IdMunicipio'];
                $usuario->clave_localidad = $row['int_IdLocalidad'];
                $usuario->clave_tipo_usuario = $row['int_IdTipoUsuario'];
                $usuario->clave_sexo = $row['int_IdSexo'];
                $usuario->nombre = $row['vch_Nombre'];
                $usuario->apellido_paterno = $row['vch_ApellidoPaterno'];
                $usuario->apellido_materno = $row['vch_ApellidoMaterno'];
                $usuario->correo = $row['vch_Correo'];
                $usuario->telefono = $row['vch_Telefono'];
                $usuario->curp = $row['vch_Curp'];
                $usuario->calle = $row['vch_Calle'];
                $usuario->colonia = $row['vch_Colonia'];
                $usuario->codigo_postal = $row['vch_CodigoPostal'];
                $usuario->nombre_usuario = $row['vch_Usuario'];
                $usuario->contrasenia = $row['vch_Contrasenia'];
                $usuario->pregunta_secreta = $row['vch_PreguntaSecreta'];
                $usuario->respuesta_secreta = $row['vch_RespuestaPSecreta'];
                $usuario->acceso = $row['bit_Activo'];
                $usuario->clave_institucion = $row['int_IdInstitucion'];
                $usuario->profesor = $row['int_IdProfesor'];
                $usuario->grupo = $row['chr_Grupo'];
                $usuario->semestre = $row['chr_Semestre'];
                array_push($usuarios, $usuario);
            }
                        
            return $usuarios;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function profesores(){
        $profesores = [];
        try{
            $query = $this->db->query("select u.`vch_Nombre`, u.`vch_ApellidoMaterno`, u.`vch_ApellidoPaterno`, p.`int_IdProfesor` from tbl_usuarios u, tbl_profesores p where u.`int_IdUsuario` = p.`int_IdUsuario`");
            while($row = $query->fetch()){
                $profesor = new usuarios_adapter();
                $profesor->clave_usuario = $row['int_IdProfesor'];
                $profesor->nombre = $row['vch_Nombre'];
                $profesor->apellido_paterno = $row['vch_ApellidoPaterno'];
                $profesor->apellido_materno = $row['vch_ApellidoMaterno'];
                array_push($profesores, $profesor);
            }
            return $profesores;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function tipo_usuario(){
        $tipo_usuarios = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_tipo_usuarios WHERE int_IdTipoUsuario != 1");
            while($row = $query->fetch()){
                $tipo_usuario = new tipo_usuarios_adapter();
                $tipo_usuario->clave_tipo_usuario = $row['int_IdTipoUsuario'];
                $tipo_usuario->nombre_tipo_usuario = $row['vch_TipoUsuario'];
                array_push($tipo_usuarios, $tipo_usuario);
            }
            return $tipo_usuarios;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function instituciones(){
        $instituciones = [];
        try{
            $query = $this->db->query("SELECT * FROM tbl_instituciones");
            while($row = $query->fetch()){
                $institucion = new instituciones_adapter();
                $institucion->clave_institucion = $row['int_IdInstitucion'];
                $institucion->nombre_institucion = $row['vch_NombreInstitucion'];
                array_push($instituciones, $institucion);
            }
            return $instituciones;
        }catch(PDOException $e){
            return [];
        }
    }
    
    public function guardar($data){
        if(isset($data['id'])){           
            if($data['tipo_usuario'] == 2){
                $query = $this->db->query('DELETE FROM tbl_alumnos WHERE int_IdUsuario = ' . $data['id']);
                $query = $this->db->prepare('INSERT INTO tbl_profesores (int_IdInstitucion, int_IdUsuario) VALUES (:institucion, :id)');
                $query -> execute(['id'=>$data['id'], 'institucion'=>$data['institucion']]);
            } else {
                $exist = $this->db->query('SELECT * FROM tbl_alumnos WHERE (SELECT int_IdProfesor FROM tbl_profesores WHERE int_IdUsuario = '. $data['id'] .') = int_IdProfesor');                
                
                if($exist->rowCount()){
                    echo "No puedes modificar a este profesor, tiene alumnos asignados";
                    return false;
                }
                $query = $this->db->query('DELETE FROM tbl_profesores WHERE int_IdUsuario = ' . $data['id']);                
                $query = $this->db->prepare('INSERT INTO tbl_alumnos (int_IdInstitucion, int_IdUsuario, int_IdProfesor, chr_Grupo, chr_Semestre) VALUES (:institucion, :id, :profesor, :grupo, :semestre)');
                $query -> execute(['id'=>$data['id'], 'profesor'=>$data['profesor'], 'grupo'=>$data['grupo'], 'semestre'=>$data['semestre'], 'institucion'=>$data['institucion']]);
            }
            
            $query = $this->db->prepare('UPDATE tbl_usuarios SET int_IdEstado = :id_estado, int_IdMunicipio = :id_municipio, int_IdLocalidad = :id_localidad, int_IdSexo = :id_sexo, int_IdTipoUsuario = :id_tipo_usuario, vch_Nombre = :nombre, vch_ApellidoPaterno = :AP, vch_ApellidoMaterno = :AM, vch_Correo = :correo, vch_Telefono = :telefono, vch_Curp = :curp, vch_Calle = :calle, vch_Colonia = :colonia, vch_CodigoPostal = :codigo_postal, vch_PreguntaSecreta = :pregunta, vch_RespuestaPSecreta = :respuesta, bit_Activo = :activo WHERE int_IdUsuario = :id');
            
            $query -> execute(['id'=>$data['id'],'id_estado'=>$data['id_estado'], 'id_municipio'=>$data['id_municipio'], 'id_localidad'=>$data['id_localidad'], 'id_tipo_usuario'=>$data['tipo_usuario'], 'id_sexo'=>$data['id_sexo'], 'nombre'=>$data['nombre'], 'AP'=>$data['AP'], 'AM'=>$data['AM'], 'correo'=>$data['correo'], 'telefono'=>$data['telefono'], 'curp'=>$data['curp'], 'calle'=>$data['calle'], 'colonia'=>$data['colonia'], 'codigo_postal'=>$data['codigo_postal'], 'pregunta'=>$data['pregunta'], 'respuesta'=>$data['respuesta'], 'activo'=>$data['activo']]);
                        
            echo "Datos guardados";
        } else {
            $query = $this->db->prepare('INSERT INTO tbl_usuarios (int_IdEstado, int_IdMunicipio, int_IdLocalidad, int_IdTipoUsuario, int_IdSexo, vch_Nombre, vch_ApellidoPaterno, vch_ApellidoMaterno, vch_Correo, vch_Telefono, vch_Curp, vch_Calle, vch_Colonia, vch_CodigoPostal, vch_Usuario, vch_Contrasenia, vch_PreguntaSecreta, vch_RespuestaPSecreta, bit_Activo) VALUES (:id_estado, :id_municipio, :id_localidad, :id_tipo_usuario, :id_sexo, :nombre, :AP, :AM, :correo, :telefono, :curp, :calle, :colonia, :codigo_postal, :user, SHA(UPPER(:user :pass)), :pregunta, :respuesta, :activo)');
            
            $query -> execute(['id_estado'=>$data['id_estado'], 'id_municipio'=>$data['id_municipio'], 'id_localidad'=>$data['id_localidad'], 'id_tipo_usuario'=>$data['tipo_usuario'], 'id_sexo'=>$data['id_sexo'], 'nombre'=>$data['nombre'], 'AP'=>$data['AP'], 'AM'=>$data['AM'], 'correo'=>$data['correo'], 'telefono'=>$data['telefono'], 'curp'=>$data['curp'], 'calle'=>$data['calle'], 'colonia'=>$data['colonia'], 'codigo_postal'=>$data['codigo_postal'], 'user'=>$data['user'], 'pass'=>$data['pass'], 'pregunta'=>$data['pregunta'], 'respuesta'=>$data['respuesta'], 'activo'=>$data['activo']]);
            
            
            $lastInsertId = $this->db->lastInsertId();
            
            if($data['tipo_usuario'] == 2){
                $query = $this->db->prepare('INSERT INTO tbl_profesores (int_IdInstitucion, int_IdUsuario) VALUES (:institucion, :usuario)');
                $query -> execute(['institucion'=>$data['institucion'], 'usuario'=>$lastInsertId]);
            } else {
                $query = $this->db->prepare('INSERT INTO tbl_alumnos (int_IdInstitucion, int_IdUsuario, int_IdProfesor, chr_Grupo, chr_Semestre) VALUES (:institucion, :usuario, :profesor, :grupo, :semestre)');
                $query -> execute(['institucion'=>$data['institucion'], 'usuario'=>$lastInsertId, 'profesor'=>$data['profesor'], 'grupo'=>$data['grupo'], 'semestre'=>$data['semestre']]);
            }
                        
            echo "Datos insertados";
        }
    }
    
    public function eliminar_usuario($id){
        $query = $this->db->query('DELETE FROM tbl_profesores WHERE int_IdUsuario = ' . $id);
        $query = $this->db->query('DELETE FROM tbl_alumnos WHERE int_IdUsuario = ' . $id);
        $query = $this->db->query('DELETE FROM tbl_usuarios WHERE int_IdUsuario = ' . $id);
        return json_encode(array("error"=>false));
    }
}
?>
