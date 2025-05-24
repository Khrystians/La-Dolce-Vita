<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú - La Dolce Vita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f6f6f6;
    }
    .sidebar {
      background-color: white;
      height: 145vh; /* Ajusta la altura de la barra lateral */
      padding: 20px;
      border-right: 1px solid #ddd;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Añade sombra al sidebar */
    }
    .sidebar .user-info {
      text-align: center;
      margin-bottom: 20px;
    }
    .sidebar .user-info img {
      width: 100px; /* Aumenta el tamaño de la imagen */
      height: 100px;
      border-radius: 50%;
      margin-bottom: 10px;
    }
    .sidebar .user-info h6 {
      font-size: 1.2rem;
      margin: 0;
    }
    .sidebar .divider {
      border-top: 1px solid #ddd;
      margin: 15px 0;
    }
    .nav-link {
      font-size: 1.5rem; /* Aumenta aún más el tamaño del texto */
      color: #6c757d; /* Cambia el color a gris */
      transition: color 0.2s ease-in-out; /* Transición suave para el color */
      display: flex;
      align-items: center;
      gap: 10px; /* Espaciado entre el ícono y el texto */
    }
    .nav-link:hover {
      color: #343a40; /* Cambia el color al pasar el cursor */
    }
    .nav-link.active {
      color: #000; /* Cambia el color del link seleccionado a negro */
      font-weight: bold; /* Resalta el link seleccionado */
    }
    .logout-btn {
      margin-top: auto;
      text-align: center;
    }
    .logout-btn button {
      font-size: 1rem;
      color: white;
      background-color: #c94b4b;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    .logout-btn button:hover {
      background-color: #a33a3a;
    }
    .top-bar {
      background-color: #c94b4b;
      color: white;
      padding: 10px 0;
      display: flex;
      align-items: center; /* Centra verticalmente */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Añade sombra al topbar */
    }
    .top-bar .col {
      text-align: center;
      border-right: 1px solid white;
      font-size: 1.2rem; /* Aumenta el tamaño del texto */
      display: flex;
      flex-direction: column;
      justify-content: center; /* Centra horizontalmente */
    }
    .top-bar .col:last-child {
      border-right: none;
    }
    .top-bar .col span {
      color:rgb(31, 198, 70); /* Muestra el dinero ganado en verde */
      font-weight: bold;
      /* border: 1px solid white;  Añade un ligero borde blanco */
      padding: 2px 5px; /* Espaciado interno */
      border-radius: 5px; /* Bordes redondeados */
    }
    .category-item {
      background-color: white; /* Color blanco para todas las categorías */
      border: none;
      padding: 20px;
      margin: 3rem; /* Incrementa la separación entre los divs */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease-in-out; /* Añade transición para la animación */
      display: flex;
      flex-direction: column; /* Coloca el logo encima del texto */
      align-items: center;
      justify-content: center;
      width: 18rem; /* Incrementa aún más el ancho del div */
      height: 19rem; /* Incrementa aún más la altura del div */
      text-align: center;
      cursor: pointer;
    }
    .category-item:hover {
      transform: scale(1.1); /* Aumenta ligeramente el tamaño al pasar el cursor */
      background-color: #c94b4b; /* Cambia el color a rojo al pasar el cursor */
      color: white; /* Cambia el texto a blanco */
    }
    .category-item img {
      width: 12rem; /* Incrementa aún más el tamaño del logo */
      height: 12rem;
      margin-bottom: 5px; /* Espacio entre el logo y el texto */
    }
    .category-item span {
      font-size: 2.5rem; /* Incrementa aún más el tamaño del texto */
      font-family: 'Georgia', serif; /* Aplica una tipografía elegante */
    }
    .category-item .earnings {
      font-size: 1.2rem; /* Tamaño del texto de las ganancias */
      color: rgb(31, 198, 70); /* Color verde */
      font-weight: bold;
      margin-top: 0.5rem; /* Espaciado superior */
    }
    .category-item.active {
      background-color: #c94b4b;
      color: white;
    }
    .categories-container {
      display: flex;
      justify-content: center; /* Centra los divs horizontalmente */
      flex-wrap: wrap; /* Permite que los divs se ajusten en varias filas */
    }
    .menu-card {
      border-radius: 0; /* Elimina los bordes redondeados */
      overflow: hidden; /* Asegura que el contenido no se desborde */
      padding: 20px; /* Añade más espacio interno */
      width: 300px; /* Reduce el ancho de las tarjetas */
      margin: auto; /* Centra las tarjetas dentro de su columna */
    }
    .menu-card img {
      height: 13rem;
      object-fit: cover;
      margin-bottom: 20px; /* Aumenta el espacio entre la imagen y el contenido */
      border-radius: 8px; /* Redondea ligeramente los bordes de la imagen */
    }
    .menu-card button {
      font-size: 1.2rem; /* Aumenta el tamaño del texto de los botones */
      /* font-family: 'Georgia', serif;  Aplica la fuente Georgia */
      font-weight: normal; /* Sin negrita */
    }
    .menu-card h6 {
      font-size: 1.5rem; /* Aumenta el tamaño del título */
      margin-top: -1rem; /* Reduce el espacio entre el título y la imagen */
    }
    .menu-card .allergens {
      display: flex;
      justify-content: center;
      gap: 10px; /* Espaciado entre los iconos */
      margin-top: 10px; /* Espacio entre el contenido y los iconos */
    }
    .menu-card .allergens img {
      width: 2.7rem; /* Aumenta el tamaño de los iconos */
      height: 2.7rem;
    }
    .footer {
      background-color: #c94b4b; /* Mismo color que el topbar */
      color: white;
      padding: 10px 0;
      text-align: center;
    }
    .section-title {
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 1rem;
      position: relative;
      color: #6c757d; /* Color gris inicial */
      text-decoration: none; /* Quita el subrayado */
      color: inherit; /* Mantiene el color del texto */
    }
    .section-title:hover {
      text-decoration: none; /* Asegura que no se subraye al pasar el cursor */
    }
    .section-title:not(.active) {
      color: #a0a0a0; /* Hace que los links no activos sean más grises */
    }
    .section-title.active {
      color:rgb(0, 0, 0); /* Hace que el link activo sea más gris */
    }
    .section-title::after {
      content: '';
      display: block;
      width: 90%; /* Incrementa el ancho de la línea roja */
      height: 2px;
      background-color: #c94b4b; /* Línea roja */
      margin: 0.5rem auto 0;
    }
    .section-titles-container {
      display: flex;
      justify-content: center;
      gap: 20rem; /* Incrementa el espaciado entre los títulos */
      margin-bottom: 2rem; /* Espaciado inferior */
      margin-top: 4rem; /* Espaciado inferior */
    }
    .card {
      background-color: white;
      border: none;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 350px; /* Reduce el ancho de las tarjetas */
      margin: 20px; /* Incrementa la separación entre las tarjetas */
      transition: transform 0.2s ease-in-out;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .title {
      font-size: 2rem; /* Incrementa el tamaño del título */
      font-weight: bold;
      margin-bottom: 1rem;
      text-align: center;
      font-family: 'Georgia', serif; /* Aplica la fuente Georgia */
    }
    .item {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #ddd;
    }
    .item:last-child {
      border-bottom: none;
    }
    .price {
      font-weight: bold;
      color: rgb(31, 198, 70);
    }
    .total {
      font-size: 1.2rem;
      font-weight: bold;
      margin-top: 10px;
      text-align: center;
    }
    .divider {
      height: 1px;
      background-color: #c94b4b; /* Cambia el color del divisor a rojo */
      margin: 10px 0;
    }
    .hidden {
      display: none; /* Oculta el contenido */
    }

    /* Estilos para el equipo */
    .filters {
      margin-bottom: 2rem;
    }
    .filter-btn {
      background-color: #c94b4b;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.2s ease-in-out;
    }
    .filter-btn:hover {
      background-color: #a33a3a;
    }
    .filter-btn.active {
      background-color: #a33a3a;
    }
    .card {
      transition: transform 0.2s ease-in-out;
    }
    .card:hover {
      transform: translateY(-5px);
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    <div class="col-md-2 sidebar d-flex flex-column">
      <!-- Logo y Nombre del Restaurante -->
      <div class="text-center mb-4">
        <img src="../Assets/Images/La Dolce Vita icon 1.png" alt="Logo" class="img-fluid mb-3" style="width: 11rem;"> <!-- Incrementa el tamaño del logo -->
        <h4 style="font-size: 1.8rem; margin-top: -1rem;">LA DOLCE VITA</h4> <!-- Aumenta el tamaño del texto -->
      </div>

      <!-- Línea de separación -->
      <div class="divider"></div>

      <!-- Fecha actual -->
      <div class="text-center mb-3">
        <small class="text-muted"><?php echo date('d/m/Y'); ?></small> <!-- Muestra la fecha actual -->
      </div>

      <!-- User Info -->
      <div class="user-info">
        <img src="https://thumbs.dreamstime.com/b/usuario-del-miembro-perfil-icono-hombre-vector-s%C3%ADmbolo-de-perconal-en-el-fondo-aislado-blanco-141728154.jpg" alt="Usuario">
        <h6>Administrador</h6>
      </div>

      <!-- Línea de separación -->
      <div class="divider"></div>

      <!-- Navigation Links -->
      <nav class="nav flex-column mt-4">
        <a class="nav-link" href="Administrador-Finanzas-Categorias.php"><i class="bi bi-bar-chart"></i> Finanzas</a>
        <a class="nav-link" href="Administrador-Calendario.php"><i class="bi bi-calendar"></i> Calendario</a>
        <a class="nav-link" href="Administrador-Eventos.php"><i class="bi bi-calendar-event"></i> Eventos</a>
        <a class="nav-link" href="Administrador-Equipo.php"><i class="bi bi-people"></i> Equipo</a>
        <a class="nav-link" href="#"><i class="bi bi-egg-fried"></i> Cocina</a> <!-- Nuevo enlace -->
        <a class="nav-link" href="Administrador-menu.php"><i class="bi bi-list"></i> Menú</a>
        <a class="nav-link" href="#"><i class="bi bi-plus-circle"></i> Añadir plato</a> <!-- Nuevo enlace -->
        <a class="nav-link" href="#"><i class="bi bi-info-circle"></i> Información General</a> <!-- Nuevo enlace -->
        <?php
          // Obtener el número de notificaciones no leídas
          $notificaciones = 0;
          try {
            require('Conexion.php');
            if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
              mysqli_query($conexion, "SET NAMES 'UTF8'");
              $sqlNotif = "SELECT COUNT(*) as total FROM notifications WHERE is_read = 0";
              $resNotif = mysqli_query($conexion, $sqlNotif);
              if ($filaNotif = mysqli_fetch_assoc($resNotif)) {
                $notificaciones = $filaNotif['total'];
              }
              mysqli_close($conexion);
            }
          } catch (Throwable $e) {
            $notificaciones = 0;
          }
        ?>
        
        <a class="nav-link active" href="Administrador-Notificaciones.php"><i class="bi bi-bell"></i> Notificaciones <span class="badge bg-danger"><?php echo $notificaciones; ?></span></a> <!-- Notificaciones -->
      </nav>

      <!-- Línea de separación -->
      <div class="divider mt-5"></div>

      <!-- Botón de Redes Sociales -->
      <div class="social-btn mb-3 text-center">
        <button class="btn btn-success w-75">Redes Sociales</button> <!-- Cambiado a verde -->
      </div>

      <!-- Botón de Deslogearse -->
      <div class="logout-btn text-center">
        <button class="btn btn-danger w-75 mb-3">Deslogearse</button>
      </div>

      <!-- Footer -->
      <div class="footer mt-auto">
        <small>Versión 1.0.0</small>
        <br>
        <small>© 2023 La Dolce Vita</small>
      </div>
      
    </div>

    <!-- Main content -->
    <div class="col-md-10">

      <!-- Top bar -->
      <div class="row top-bar text-white mb-4">
        <div class="col text-center">
          <img src="../Assets/Images/logos/carrito_de_compra.png" alt="Ventas" style="width: 4rem; height: 3rem; display: block; margin: 0 auto;">
          Ventas en general
        </div>
        <div class="col">Año<br><span>2024,47€</span></div>
        <div class="col">Mes<br><span>2024,47€</span></div>
        <div class="col">Semana<br><span>2024,47€</span></div>
        <div class="col">Hoy<br><span>2024,47€</span></div>
        <div class="col text-center">
          <img src="../Assets/Images/logos/dinero.png" alt="Dinero" style="width: 4rem; height: 3rem; display: block; margin: 0 auto;">
        </div>
      </div>

      <!-- Notificaciones -->
      <div class="container mt-5">
        <h2 class="text-center mt-5" style="font-size: 3rem; font-family: 'Georgia', serif; font-weight: bold; letter-spacing: 2px;">
          Notificaciones
        </h2>

        <div class="row justify-content-center mt-4 g-3" style="row-gap: 1.5rem;">
          <?php
            // Silenciar warnings y notices
            error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
            try {
              require('Conexion.php');
            } catch (Throwable $t) {
              //echo "<p>Mensaje: " . $t->getMessage() . "</p>";
              exit();
            }
            try {
              if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
                mysqli_query($conexion, "SET NAMES 'UTF8'");
                if (mysqli_select_db($conexion, $bbdd)) {
                  $consulta = "SELECT *, mesa_id FROM notifications ORDER BY created_at DESC;";
                  $resultado = mysqli_query($conexion, $consulta);
                  if (mysqli_errno($conexion) != 0) {
                    exit();
                  } else {
                    if (mysqli_num_rows($resultado) == 0) {
                      echo "<div class='col-12'><div class='alert alert-info text-center'>No hay notificaciones.</div></div>";
                    }
                    // Cambia a tarjetas más compactas y en grid
                    while ($fila = mysqli_fetch_array($resultado)) {
                      $leida = $fila['is_read'] ? 'border-secondary' : 'border-danger border-3';
                      $icono = $fila['is_read'] ? 'bi bi-bell' : 'bi bi-bell-fill text-danger';
                      $fecha = date('d/m/Y H:i', strtotime($fila['created_at']));
                      $mesa = isset($fila['mesa_id']) && $fila['mesa_id'] ? "<span class='badge bg-secondary ms-2'>Mesa: " . htmlspecialchars($fila['mesa_id']) . "</span>" : "";
                      echo "
                        <div class='col-12 col-sm-6 col-lg-4'>
                          <div class='card $leida shadow-sm h-100 d-flex flex-column justify-content-between' style='border-left: 6px solid #c94b4b; min-height: 110px;'>
                            <div class='card-body d-flex flex-column align-items-start gap-2 p-2'>
                              <div class='d-flex align-items-center w-100 mb-1'>
                                <i class='$icono' style='font-size:1.5rem;'></i>
                                <div class='fw-bold ms-2' style='font-size:1rem; color:#c94b4b;'>$fecha $mesa</div>";
                      if (!$fila['is_read']) {
                        echo "<span class='badge bg-danger ms-auto'>Nueva</span>";
                      }
                      echo "</div>
                              <div style='font-size:0.95rem; font-family:Georgia,serif; width:100%;'>" . htmlspecialchars($fila['message']) . "</div>
                              <div class='d-flex gap-2 mt-2 w-100'>
                                <form method='post' action='' class='d-inline'>
                                  <input type='hidden' name='delete_notification_id' value='" . intval($fila['id']) . "'>
                                  <button type='submit' class='btn btn-outline-danger btn-sm w-100' title='Borrar notificación'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                      <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5.5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6zm2 .5a.5.5 0 0 1 .5-.5.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6z'/>
                                      <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3a1 1 0 0 1 1 1zm-11-1a.5.5 0 0 0-.5.5V4h11V2.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v.5h-2v-.5a.5.5 0 0 0-.5-.5h-3z'/>
                                    </svg>
                                  </button>
                                </form>";
                      if (!$fila['is_read']) {
                        echo "
                                <form method='post' action='' class='d-inline'>
                                  <input type='hidden' name='mark_read_notification_id' value='" . intval($fila['id']) . "'>
                                  <button type='submit' class='btn btn-outline-success btn-sm w-100' title='Marcar como leído'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' fill='currentColor' class='bi bi-check2-circle' viewBox='0 0 16 16'>
                                      <path d='M2.5 8a5.5 5.5 0 1 1 11 0 5.5 5.5 0 0 1-11 0zm5.5-6a6 6 0 1 0 0 12A6 6 0 0 0 8 2z'/>
                                      <path d='M10.97 6.97a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 0 1-1.06 0l-1.5-1.5a.75.75 0 1 1 1.06-1.06l.97.97 2.47-2.47a.75.75 0 0 1 1.06 0z'/>
                                    </svg>
                                  </button>
                                </form>";
                      }
                      echo "
                              </div>
                            </div>
                          </div>
                        </div>
                      ";
                    }
                  }
                }
                mysqli_close($conexion);
              } else {
                throw new mysqli_sql_exception(mysqli_connect_error(), mysqli_connect_errno());
              }
            } catch (mysqli_sql_exception $e) {
              //echo "<p>Nº error: " . $e->getCode() . "</p>";
              //echo "<p>Mensaje: " . $e->getMessage() . "</p>";
              exit();
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Manejo de borrado y marcar como leído de notificación (al principio del archivo, antes de mostrar las notificaciones) -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    require('Conexion.php');
    if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
      mysqli_query($conexion, "SET NAMES 'UTF8'");
      if (isset($_POST['delete_notification_id'])) {
        $id = intval($_POST['delete_notification_id']);
        mysqli_query($conexion, "DELETE FROM notifications WHERE id = $id");
      }
      if (isset($_POST['mark_read_notification_id'])) {
        $id = intval($_POST['mark_read_notification_id']);
        mysqli_query($conexion, "UPDATE notifications SET is_read = 1 WHERE id = $id");
      }
      mysqli_close($conexion);
      // Redirigir para evitar reenvío de formulario
      header("Location: " . $_SERVER['PHP_SELF']);
      exit();
    }
  } catch (Throwable $e) {
    // Silenciar error
  }
}
?>

</body>
</html>