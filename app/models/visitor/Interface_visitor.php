<?php
    
    interface interface_visitor {
        function localidades($clv_edo, $clv_mun);
        function estados();
        function municipios($id_estado);
        function niveles_escolares();
        function noticias();
        function paquetes_empleados();
        function turnos();
        
    }

?>