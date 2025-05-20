<!-- Documento donde se valida a las credenciales introducidas en el inicio de sesion -->
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Extraer los valores introducidos en el formulario
        extract($_POST);

        // Validamos mediante el codigo 
        if ($usuario == "cristian@gmail.com" && $pass == "1234qwerty") {
            // Si existe el usuario se habre una sesión 
            session_start();

            // Creamos 3 variables de tipo Session que nos serviran a futuro
            $_SESSION['usuario'] = $usuario;
            $_SESSION['estaLogueado'] = true;
            $_SESSION['hora'] = time(); // ==> Guardamos la hora a la que se inicio la sesión 
            
            // Redireccionamos a la pagina principal
            header("location:Administrador-menu.php");
        } else {
            // Si no existe el usuario redireccionamos a la pagina de inicio de sesion con un mensaje de error
            header("location:Login.php?mensaje=error");
        }
    } else {
        header("location:Login.php");
    }
?>