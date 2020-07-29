<?php
include_once 'app/empleados.php';
include_once 'app/usuarios.php';

class empleadosModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function get(){
        $usuarios = [];
        try{
            $query = $this->db->query("select * from tbl_usuarios u, tbl_empleados e where u.`int_IdUsuario` = e.`int_IdUsuario`");
                while($row = $query->fetch()){
                    $usuario = new usuarios_adapter();                
                    $usuario->clave_usuario = $row['int_IdUsuario'];
                    $usuario->clave_estado = $row['int_IdEstado'];
                    $usuario->clave_municipio = $row['int_IdMunicipio'];
                    $usuario->clave_localidad = $row['int_IdLocalidad'];
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
                    $usuario->fotografia = $row['vch_fotografia'];
                    $usuario->descripcion = $row['vch_descripcion'];
                           
                    array_push($usuarios, $usuario);
                }
            return $usuarios;
        }catch(PDOException $e){
            return [];
        }
    }
    
    
    public function guardar($data){
        if(isset($data['id'])){                       
            $query = $this->db->prepare('UPDATE tbl_usuarios SET int_IdEstado = :id_estado, int_IdMunicipio = :id_municipio, int_IdLocalidad = :id_localidad, int_IdSexo = :id_sexo, vch_Nombre = :nombre, vch_ApellidoPaterno = :AP, vch_ApellidoMaterno = :AM, vch_Correo = :correo, vch_Telefono = :telefono, vch_Curp = :curp, vch_Calle = :calle, vch_Colonia = :colonia, vch_CodigoPostal = :codigo_postal, vch_PreguntaSecreta = :pregunta, vch_RespuestaPSecreta = :respuesta, bit_Activo = :activo WHERE int_IdUsuario = :id');
            
            $query -> execute(['id'=>$data['id'],'id_estado'=>$data['id_estado'], 'id_municipio'=>$data['id_municipio'], 'id_localidad'=>$data['id_localidad'], 'id_sexo'=>$data['id_sexo'], 'nombre'=>$data['nombre'], 'AP'=>$data['AP'], 'AM'=>$data['AM'], 'correo'=>$data['correo'], 'telefono'=>$data['telefono'], 'curp'=>$data['curp'], 'calle'=>$data['calle'], 'colonia'=>$data['colonia'], 'codigo_postal'=>$data['codigo_postal'], 'pregunta'=>$data['pregunta'], 'respuesta'=>$data['respuesta'], 'activo'=>$data['activo']]);
            
            $query = $this->db->prepare('UPDATE tbl_empleados SET vch_Descripcion = :descripcion WHERE int_IdUsuario = :id');
            $query -> execute(['descripcion'=>$data['descripcion'], 'id'=>$data['id']]);
            echo "Datos guardados";
        } else {
            $query = $this->db->prepare('INSERT INTO tbl_usuarios (int_IdEstado, int_IdMunicipio, int_IdLocalidad, int_IdTipoUsuario, int_IdSexo, vch_Nombre, vch_ApellidoPaterno, vch_ApellidoMaterno, vch_Correo, vch_Telefono, vch_Curp, vch_Calle, vch_Colonia, vch_CodigoPostal, vch_Usuario, vch_Contrasenia, vch_PreguntaSecreta, vch_RespuestaPSecreta, bit_Activo) VALUES (:id_estado, :id_municipio, :id_localidad, :id_tipo_usuario, :id_sexo, :nombre, :AP, :AM, :correo, :telefono, :curp, :calle, :colonia, :codigo_postal, :user, SHA(UPPER(:user :pass)), :pregunta, :respuesta, :activo)');
            
            $query -> execute(['id_estado'=>$data['id_estado'], 'id_municipio'=>$data['id_municipio'], 'id_localidad'=>$data['id_localidad'], 'id_tipo_usuario'=>1, 'id_sexo'=>$data['id_sexo'], 'nombre'=>$data['nombre'], 'AP'=>$data['AP'], 'AM'=>$data['AM'], 'correo'=>$data['correo'], 'telefono'=>$data['telefono'], 'curp'=>$data['curp'], 'calle'=>$data['calle'], 'colonia'=>$data['colonia'], 'codigo_postal'=>$data['codigo_postal'], 'user'=>$data['user'], 'pass'=>$data['pass'], 'pregunta'=>$data['pregunta'], 'respuesta'=>$data['respuesta'], 'activo'=>$data['activo']]);
            
            
            $lastInsertId = $this->db->lastInsertId();
            
            
            $query = $this->db->prepare('INSERT INTO tbl_empleados (vch_fotografia, int_IdUsuario, vch_Descripcion) VALUES (:fotografia, :usuario, :descripcion)');
            $query -> execute(['fotografia'=>'Sin_Foto.jpg', 'usuario'=>$lastInsertId, 'descripcion'=>$data['descripcion']]);
           
                        
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
