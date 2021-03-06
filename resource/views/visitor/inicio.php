<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo constant('URL');?>public/assets/images/logo.png">
    <title>Inicio</title>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo constant('URL');?>inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo constant('URL');?>conocenos">Conocenos</a>
                    </li>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <button type="button" id="abrir_login" class="btn btn-info" data-toggle="modal" data-target="#modal_login">Iniciar sesión</button>
                    <button type="button" id="abrir_registro" class="btn btn-light" data-toggle="modal" data-target="#modal_register">Registrarse</button>
                </form>
            </div>
        </nav>
    </header>
    <main role="main">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                for($i=0;$i<count($this->noticias);$i++){
                    if($i == 0){
                    ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
                <?php    
                    } else {
                    ?>
                <li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" class=""></li>
                <?php
                    }                
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                include_once 'app/noticias.php';
                $act = 0;
                foreach($this->noticias as $row){
                    $not = new noticias_adapter();
                    $not = $row;
                    
                    if($act == 0){
                        ?>
                <div class="carousel-item active">
                    <?php
                    }else {
                       ?>
                    <div class="carousel-item">
                        <?php 
                    }
                ?>
                        <svg class="bd-placeholder-img" width="100%" height="350px" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#235390"></rect>
                        </svg>
                        <div class="container">
                            <div class="carousel-caption">
                                <h1><?php echo $not->titulo ?></h1>
                                <p>
                                <?php echo $not->contenido ?> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                    $act = $act + 1;
                }
                ?>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
        <div class="container marketing">
            <hr>
            <div class="card-deck mb-3 text-center">
                <?php
                    include_once 'app/paquetes.php';        
                    foreach($this->paquetes as $row){
                        $paq = new paquetes_adapter();
                        $paq = $row;
                    ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal"><?php echo $paq->nombre ?></h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>
                            <img src="<?php echo constant('URL');?>/public/assets/images/paquetes/<?php echo $paq->imagen; ?>" width="35%" dy=".3em">
                            </li>
                            <li>
                                <p>Costo: $<?php echo $paq->precio ?></p>
                            </li>
                        </ul>
                        <button class="btn btn-lg btn-block btn-outline-secondary" onclick="ir_a('<?php echo $paq->nombre ?>')">Ver paquete
                        </button>
                    </div>                        
                    
                </div>
                <?php
                    }
                ?>
            </div>
            <hr class="featurette-divider">


            <?php
                    include_once 'app/paquetes.php';        
                    foreach($this->paquetes as $row){
                        $paq = new paquetes_adapter();
                        $paq = $row;
                    ?>
            <div id="<?php echo $paq->nombre ?>">
                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading"><?php echo $paq->nombre ?></h2>
                        <p class="lead"><?php echo $paq->descripcion ?></p>
                    </div>
                    <div class="col-md-5">
                        <center>
                            <img src="<?php echo constant('URL');?>/public/assets/images/paquetes/<?php echo $paq->imagen; ?>" width="75%" dy=".3em">
                        </center>
                    </div>
                </div>
            </div>
            <hr class="featurette-divider">
            <?php
                    }
                ?>
            <hr class="featurette-divider">
        </div>
        <footer class="container">
            <p class="float-right"><a href="#" id="top">Regresar arriba</a></p>
            <p>© 2020-2021 EDUTEC, Inc. · <a href="#">Policitas de privacidad</a> y <a href="#">Terminos de uso</a></p>
        </footer>
    </main>
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
