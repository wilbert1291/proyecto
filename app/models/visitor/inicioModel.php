<?php
    include_once 'app/models/visitor/Interface_visitor.php';
    include_once 'app/estados.php';
    include_once 'app/turnos.php';
    include_once 'app/niveles_escolares.php';
    include_once 'app/noticias.php';
    include_once 'app/paquetes.php';
    include_once 'app/municipios.php';
    include_once 'app/localidades.php';
    
    class inicioModel extends Model implements interface_visitor{
        
        public function __construct(){
            parent::__construct();
        }
        
        function localidades($clv_edo, $clv_mun){
            $localidades = [];
            try{
                $query = $this->db->query("select * from tbl_localidades where chrClvEdo = '$clv_edo' and chrClvMunicipio = '$clv_mun'");
                while($row = $query->fetch()){
                    $localidad = new localidades_adapter();
                    $localidad->clave_estado = $row['chrClvEdo'];
                    $localidad->clave_municipio = $row['chrClvMunicipio'];
                    $localidad->clave_localidad = $row['chrClvLocalidad'];
                    $localidad->nombre_localidad = $row['vchNomLocalidad'];
                    array_push($localidades, $localidad);
                }
                return $localidades;
            }catch(PDOException $e){
                return [];
            }
        }
        
        function estados(){
            $estados = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_estados");
                while($row = $query->fetch()){
                    $estado = new estados_adapter();
                    $estado->clave_estado = $row['chrClvEdo'];
                    $estado->nombre_estado = $row['vchNomEstado'];
                
                    array_push($estados, $estado);
                }
                return $estados;
            }catch(PDOException $e){
                return [];
            }
        }
        
        function municipios($id_estado){
            $municipios = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_municipios WHERE chrClvEdo = '$id_estado'");
                while($row = $query->fetch()){
                    $municipio = new municipios_adapter();
                    $municipio->clave_municipio = $row['chrNumMunicipio'];
                    $municipio->clave_estado = $row['chrClvEdo'];
                    $municipio->nombre_municipio = $row['vchNomMunicipio'];
                
                    array_push($municipios, $municipio);
                }
                return $municipios;
            }catch(PDOException $e){
                return [];
            }
        }
        
        function niveles_escolares(){
            $niveles = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_niveles_escolares where bit_activo = 1");
                while($row = $query->fetch()){
                    $nivel = new niveles_escolares_adapter();
                    $nivel->id_nivel_escolar = $row['int_IdNivelEscolar'];
                    $nivel->nombre_nivel_escolar = $row['vch_NombreNivelEscolar'];
                    array_push($niveles, $nivel);
                }
                return $niveles;
            }catch(PDOException $e){
                return [];
            }
        }
        
        function noticias(){
            $noticias = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_noticias");
                while($row = $query->fetch()){
                    $noticia = new noticias_adapter();
                    $noticia->id_noticia = $row['int_IdNoticia'];
                    $noticia->titulo = $row['vch_Titulo'];
                    $noticia->contenido = $row['vch_Contenido'];
                    $noticia->imagen = $row['vch_Imagen'];
                    array_push($noticias, $noticia);
                }
                return $noticias;
            }catch(PDOException $e){
                return [];
            }
        }
        
        function paquetes_empleados(){
            $paquetes = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_paquetes");
                while($row = $query->fetch()){
                    $paquete = new paquetes_adapter();
                    $paquete->id_paquete = $row['int_IdPaquete'];
                    $paquete->nombre = $row['vch_NombrePaquete'];
                    $paquete->descripcion = $row['vch_Descripcion'];
                    $paquete->tiempo = $row['vch_Tiempo'];
                    $paquete->precio = $row['flt_precio'];
                    $paquete->descuento = $row['int_descuento'];
                    $paquete->imagen = $row['vch_imagen'];
                    array_push($paquetes, $paquete);
                }
                return $paquetes;
            }catch(PDOException $e){
                return [];
            }
        }
                
        function turnos(){
            $turnos = [];
            try{
                $query = $this->db->query("SELECT * FROM tbl_turnos");
                while($row = $query->fetch()){
                    $turno = new turnos_adapter();
                    $turno->id_turno = $row['int_IdTurno'];
                    $turno->nombre_turno = $row['vch_Turno'];
                    array_push($turnos, $turno);
                }
                return $turnos;
            }catch(PDOException $e){
                return [];
            }
        }
    }
?>