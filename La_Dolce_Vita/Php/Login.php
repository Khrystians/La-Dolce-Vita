<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Cristian Román y Coral García -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Login | Inicio de Sesion</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>

        <!-- Font Awesome icons (Version Gratuita)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />

        <!-- Tema CSS (incluye el Bootstrap) -->
        <link href="../Css/Login.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Video de Fondo -->
        <video class="bg-video" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="../Assets/Videos/login_video.mp4" type="video/mp4" /></video>
        
        <!-- FeedBack de Inicio de Sesión -->
        <?php 
            if (isset($_GET['mensaje'])) {
                // Extraemos el mensaje enviado desde el documento de validación
                extract($_GET);

                if ($mensaje == "error") {
                    // Si es un error de inicio de sistema
                    $alertMessage = "Usuario y/o Contraseña Incorrecta";
                }else if ($mensaje == "caducada") {
                    // Si la sesión se ha caducado por tiempo
                    $alertMessage = "Sesión Caducada por Tiempo";
                }else if ($mensaje == "inactividad") {
                    // Si la sesión se ha caducado por inactividad 
                    $alertMessage = "Sesión Caducada por Inactividad";
                }

                // Mostramos el alert
                echo "<script type='text/javascript'>
                        alert('$alertMessage');
                      </script>";
            }
        ?>

        <!-- Login -->
        <div class="masthead">
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">
                    <!-- Titulo -->
                    <h1 class="fst-italic lh-1 mb-4">Bienvenido a La Dolce Vita!</h1>
                    <p class="mb-5">Porfavor introduzca sus credenciales para poder iniciar la sesion.</p>
                    
                    <!-- Formulario de Inicio de Sesion -->
                    <form name="sesiones" id="contactForm" action="Validar_Usuario.php" method="post" enctype="application/x-www-form-urlencoded">
                        <!-- Input de el Usuario -->
                        <div class="row input-group-newsletter">
                            <div class="col"><input name="usuario" class="form-control" id="email" type="email" placeholder="Introduzca su Usuario" aria-label="Introduzca su Usuario" data-sb-validations="required,email"/></div>
                        </div>

                        <!-- Input de la Contraseña -->
                        <div class="row input-group-newsletter mt-3">
                            <div class="col"><input name="pass" class="form-control" id="password" type="password" placeholder="Introduzca su Contraseña" aria-label="Introduzca su Contraseña" data-sb-validations="required,password"/></div>
                            <div class="col-auto"><button name="enviar" class="btn btn-primary" id="submitButton" type="submit">Acceder</button></div>
                        </div>

                        <!-- FeedBack -->
                        <div class="invalid-feedback mt-2" data-sb-feedback="email:required">El usuario es requerido.</div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="email:email">El usuario no es valido.</div>
                        <div class="invalid-feedback mt-2" data-sb-feedback="password:required">La contraseña es requerida.</div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Iconos de Redes Sociales -->
        <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <!-- Dependencias de jQuery y Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>