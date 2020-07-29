<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Profesores: Alumnos</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/bootstrap/dashboard.css">
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/datatable/jquery.dataTables.min.css">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="<?php echo constant('URL'); ?>institutes/inicio">EduTec</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="<?php echo constant('URL');?>logout.php">Cerrar sesión</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="">
                <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo constant('URL');?>teachers/inicio">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                Inicio <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?php echo constant('URL');?>teachers/alumnos">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                Alumnos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo constant('URL');?>teachers/calificaciones">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                                    <line x1="18" y1="20" x2="18" y2="10"></line>
                                    <line x1="12" y1="20" x2="12" y2="4"></line>
                                    <line x1="6" y1="20" x2="6" y2="14"></line>
                                </svg>
                                Calificaciones
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                    </div>
                    <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                    </div>
                </div>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Alumnos</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_alumnos" id="nuevo_alumno">Agregar nuevo alumno</button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="tabla_alumnos">
                        <thead class="thead-dark">
                            <tr>
                                <th>
                                    Id
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                    Municipio
                                </th>
                                <th>
                                    Localidad
                                </th>
                                <th>
                                    Tipo usuario
                                </th>
                                <th>
                                    Sexo
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Apellido Paterno
                                </th>
                                <th>
                                    Apellido Materno
                                </th>
                                <th>
                                    Correo
                                </th>
                                <th>
                                    Telefono
                                </th>
                                <th>
                                    Curp
                                </th>
                                <th>
                                    Calle
                                </th>
                                <th>
                                    Colonia
                                </th>
                                <th>
                                    Codigo postal
                                </th>
                                <th>
                                    Grupo
                                </th>
                                <th>
                                    Semestre
                                </th>
                                <th>
                                    ¿Dar acceso?
                                </th>
                                <th>
                                    Usuario
                                </th>
                                <th>
                                    Contraseña
                                </th>
                                <th>
                                    Pregunta secreta
                                </th>
                                <th>
                                    Respuesta
                                </th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </main>
            <?php include_once 'resource/views/teachers/modal/alumnosModal.php'; ?>
        </div>
    </div>
    <script src="<?php echo constant('URL');?>public/js/jquery/jquery-3.5.1.js"></script>
    <script src="<?php echo constant('URL');?>public/js/popper/popper.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/bootstrap/bootstrap.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/teachers/alumnos.js"></script>
    <script src="<?php echo constant('URL');?>public/js/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo constant('URL');?>public/js/font-awesome/icons.js"></script>
    
    
</body>

</html>