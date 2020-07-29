<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PhpMailer/Exception.php';
require 'vendor/PhpMailer/PHPMailer.php';
require 'vendor/PhpMailer/SMTP.php';





class register_loginModel extends Model{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function guardar_institucion($data){
            
        
        
        
        
            $exist = $this->db->prepare("SELECT * FROM tbl_instituciones WHERE vch_ClaveInstitucional = :clave_institucional");
            $exist -> execute(['clave_institucional' => $data['clave_institucional']]);
            $row = $exist->rowCount();
            if($row == 0){
                $exist = $this->db->prepare("SELECT * FROM tbl_usuarios WHERE vch_Usuario = :clave_institucional");
                $exist -> execute(['clave_institucional' => $data['clave_institucional']]);
                $row = $exist->rowCount();
                if($row == 0){
                    // Instantiation and passing `true` enables exceptions
                    $mail = new PHPMailer(true);
                    
                    try {
                        $mail->SMTPDebug = 0;                      
                        $mail->isSMTP();          
                        $mail->CharSet    = 'UTF-8';
                        $mail->Host       = 'smtp.gmail.com';                    
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = 'wilbert1291@gmail.com';                     
                        $mail->Password   = 'wilbert131099';                               
                        $mail->SMTPSecure = 'tls';         
                        $mail->Port       = 587;                                    
                        
                        $mail->setFrom('wilbert1291@gmail.com', 'EduTec');
                        $mail->addAddress($data['correo']);     

                        
                        $mail->isHTML(true);                                  
                        $mail->Subject = 'Activa tu cuenta ahora!';
                        $cuerpo = '<html lang="es">
                                    </head>
                                        <meta charset="utf-8">
                                        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                                        <title>Activacion de cuenta</title>
                                    </head>
                                    <body>
                                        <p>Bienvenido a EduTec, para poder activar tu cuenta copia y pega el siguiente enlace: </p>
                                        <p>Su usuario es: '. $data['clave_institucional'] .' </p>
                                        <p>Su contraseña es: '. $data['password'] .' </p>
                                        <p>Copia el siguiente enlace para poder activar tu cuenta</p>
                                        localhost/proyecto/inicio/activar_cuenta/'. md5($data['clave_institucional']) .'
                                    </body>
                                    </html>';                        
                        $mail->Body    = $cuerpo;
                        

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }

                    
                    $query = $this->db->prepare('INSERT INTO tbl_instituciones(int_IdEstado, int_IdMunicipio, int_IdLocalidad, int_IdNivelEscolar, int_IdTurno, vch_ClaveInstitucional, vch_NombreInstitucion, vch_Calle, vch_Colonia, vch_CodigoPostal, dt_FechaRegistro, vch_Contrasenia, bit_Activo, vch_Correo) VALUES (:id_estado, :id_municipio, :id_localidad, :id_nivelescolar, :id_turno, :clave_institucional, :nombre, :calle, :colonia, :codigo_postal, :fecha_registro, SHA(UPPER(:clave_institucional :contrasenia)), :activo, :correo)');
                    $query -> execute(['id_estado'=> $data['estado'], 'id_municipio'=>$data['municipio'], 'id_localidad'=>$data['localidad'], 'id_nivelescolar' => $data['nivel_escolar'], 'id_turno'=> $data['turno'], 'clave_institucional'=>$data['clave_institucional'], 'nombre' => $data['nombre'], 'calle' => $data['calle'], 'colonia'=>$data['colonia'], 'codigo_postal' => $data['codigo_postal'], 'fecha_registro'=>date("Y-m-d"), 'contrasenia' => $data['password'], 'activo' => 0, 'correo' => $data['correo']]);
                    
                    $lastInsertId = $this->db->lastInsertId();
                    
                    $this->db->query('INSERT INTO tbl_activador (codigo, usado, int_IdInstitucion) VALUES ("'. md5($data['clave_institucional']) .'",0,'. $lastInsertId.')');
                    
                    
                    echo "Datos insertados";
                } else {
                    echo "Favor de ingresar una clave institucional valida";
                }
            } else {
                echo "La clave institucional ya esta en uso.\n La clave debe pertener a la institución que deseas registrar.";   
            }
        }
        
    public function iniciar_login($data){
            $institucion = $this->db->prepare('SELECT * FROM tbl_instituciones WHERE vch_ClaveInstitucional = :clave_institucional AND vch_Contrasenia = SHA(UPPER(:clave_institucional :contrasenia))');
            $institucion -> execute(['clave_institucional' => $data['user'], 'contrasenia' => $data['password']]);
            $row = $institucion->rowCount();
            if($row == 0) {
                $usuario = $this->db->prepare('SELECT * FROM tbl_usuarios WHERE vch_Usuario = :usuario AND vch_Contrasenia = SHA(UPPER(:usuario :contrasenia))');
                $usuario -> execute(['usuario' => $data['user'], 'contrasenia' => $data['password']]);
                $row = $usuario->rowCount();
                if($row == 0){
                    echo json_encode(array("mensaje"=>"Sus datos de acceso son incorrectos, vuelva a intentarlo", "error"=>true));
                } else {
                    $datos_usuario = $usuario->fetch();
                    if($datos_usuario['bit_Activo'] == 1) {
                        $_SESSION['id'] = $datos_usuario['int_IdUsuario'];
                        $_SESSION['nombre'] = $datos_usuario['vch_Nombre'] . " " . $datos_usuario['vch_ApellidoPaterno'] . " " . $datos_usuario['vch_ApellidoMaterno'];
                        if($datos_usuario['int_IdTipoUsuario'] == 1){
                            $_SESSION['tipo_usuario'] = 'admin';
                            echo json_encode(array("usuario"=>'admin', "error"=>false));
                        } else if($datos_usuario['int_IdTipoUsuario'] == 2){
                            $_SESSION['tipo_usuario'] = 'teacher';
                            echo json_encode(array("usuario"=>'teachers', "error"=>false));
                        } else if($datos_usuario['int_IdTipoUsuario'] == 3){
                            $_SESSION['tipo_usuario'] = 'student';
                            echo json_encode(array("usuario"=>'students', "error"=>false));
                        } 
                    } else {
                        echo json_encode(array("mensaje"=>"Su cuenta temporalmente no tiene acceso al sistema, lamentamos los inconvenientes", "error"=>true));
                    }
                }
            } else {
                $datos_instituto = $institucion->fetch();
                if($datos_instituto['bit_Activo'] == 1){
                    $_SESSION['tipo_usuario'] = "institute";
                    $_SESSION['id'] = $datos_instituto['int_IdInstitucion'];
                    $_SESSION['nombre'] = $datos_instituto['vch_NombreInstitucion'];
                    echo json_encode(array("usuario"=>"institute", "error"=>false));
                } else {
                    echo json_encode(array("mensaje"=>"Su cuenta temporalmente no tiene acceso al sistema, lamentamos los inconvenientes", "error"=>true));
                }   
            }
        }
}
?>
