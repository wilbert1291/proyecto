<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo constant('URL');?>public/assets/images/logo.png">
    <title>Activar cuenta</title>
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap/bootstrap.min.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="<?php echo constant('URL');?>inicio">EDUTEC</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarCollapse" style="">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL');?>inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL');?>conocenos">Conocenos</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <?php                     
                        if($this->parametros != null){
                            echo $this->mensaje;
                        } else {
                            header("Location: " . constant('URL') . "error");
                        }
                    
                    ?>
                    
                </div>
                <div class="col-md-12 text-center">
                    <a class="btn btn-info" href="<?php echo constant('URL'); ?>inicio">Volver a inicio</a>    
                </div>
            </div>
        </div>
    </div>
    <?php 
    include "modal/modal_register.php";
    include "modal/modal_login.php";
    ?>
</body>
<script src="<?php echo constant('URL');?>public/js/jquery/jquery-3.5.1.js"></script>
<script src="<?php echo constant('URL');?>public/js/popper/popper.min.js"></script>
<script src="<?php echo constant('URL');?>public/js/bootstrap/bootstrap.min.js"></script>
<script src="<?php echo constant('URL');?>public/js/visitor/registro_login.js"></script>
<script src="<?php echo constant('URL');?>public/js/sweetalert/sweetalert.min.js"></script>

</html>