<!-- Documento donde se valida a las credenciales introducidas en el inicio de sesion -->
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Extraer los valores introducidos en el formulario
        extract($_POST);

        // Lista de usuarios y contraseñas (uno por cada mesa, solo nombre)
        $usuarios = [
            "administracion" => "1234qwerty",
            "mesa1" => "mesa1pass",
            "mesa2" => "mesa2pass",
            "mesa3" => "mesa3pass",
            "mesa4" => "mesa4pass",
            "mesa5" => "mesa5pass",
            "mesa6" => "mesa6pass",
            "mesa7" => "mesa7pass",
            "mesa8" => "mesa8pass",
            "mesa9" => "mesa9pass",
            "mesa10" => "mesa10pass"
        ];

        // Validamos mediante el array de usuarios
        if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $pass) {
            // Si existe el usuario se habre una sesión 
            session_start();

            // Creamos 3 variables de tipo Session que nos serviran a futuro
            $_SESSION['usuario'] = $usuario;
            $_SESSION['estaLogueado'] = true;
            $_SESSION['hora'] = time(); // ==> Guardamos la hora a la que se inicio la sesión 
            
            // Redireccionamos a la pagina principal
            if ($usuario === "administracion") {
                // Si el usuario es administrador redireccionamos a la pagina de administracion
                header("location:Administrador-menu.php");
            } else if (strpos($usuario, "mesa") === 0) {
                header("location:cliente.php");
            } else {
                header("location:Login.php?mensaje=error");
            }
        } else {
            // Si no existe el usuario redireccionamos a la pagina de inicio de sesion con un mensaje de error
            header("location:Login.php?mensaje=error");
        }
    } else {
        header("location:Login.php");
    }
?>