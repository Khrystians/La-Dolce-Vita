<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú - La Dolce Vita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Css/Administrador-Notificaciones.css">
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    <div class="col-md-2 sidebar d-flex flex-column">
      <!-- Logo y Nombre del Restaurante -->
      <div class="text-center mb-4">
        <img src="../Assets/Images/La Dolce Vita icon.png" alt="Logo" class="img-fluid"  style="width: 20rem;"> <!-- Aumenta el tamaño del logo -->
      </div>

      <!-- Línea de separación -->
      <div class="divider" style="margin-top: -2rem;"></div>

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
        <a class="nav-link" href="Cocina-Pendientes.php"><i class="bi bi-egg-fried"></i> Cocina</a> <!-- Nuevo enlace -->
        <a class="nav-link" href="Administrador-menu.php"><i class="bi bi-list"></i> Menú</a>
        <a class="nav-link" href="Administrador-Añadir.php"><i class="bi bi-plus-circle"></i> Añadir plato</a> <!-- Nuevo enlace -->
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

      <!-- Botón de Deslogearse -->
      <div class="logout-btn text-center">
        <button class="btn btn-danger w-75 mb-3">Deslogearse</button>
      </div>

      <!-- Footer -->
      <div class="footer mt-auto">
        <small>Versión 1.0.0</small>
        <br>
        <small>© 2025 La Dolce Vita</small>
      </div>
      
    </div>

    <!-- Main content -->
    <div class="col-md-10">

      <!-- Top bar -->
      <div class="row top-bar text-white mb-4">
        <?php
          // Calcular ganancias por año, mes, semana y hoy
          $ganancia_ano = 0;
          $ganancia_mes = 0;
          $ganancia_semana = 0;
          $ganancia_hoy = 0;
          try {
            require('Conexion.php');
            if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
              mysqli_query($conexion, "SET NAMES 'UTF8'");
              // Año actual
              $res = mysqli_query($conexion, "SELECT SUM(quantity * price) AS total FROM sales WHERE YEAR(sale_date) = YEAR(CURDATE())");
              if ($row = mysqli_fetch_assoc($res)) $ganancia_ano = floatval($row['total']);
              // Mes actual
              $res = mysqli_query($conexion, "SELECT SUM(quantity * price) AS total FROM sales WHERE YEAR(sale_date) = YEAR(CURDATE()) AND MONTH(sale_date) = MONTH(CURDATE())");
              if ($row = mysqli_fetch_assoc($res)) $ganancia_mes = floatval($row['total']);
              // Semana actual
              $res = mysqli_query($conexion, "SELECT SUM(quantity * price) AS total FROM sales WHERE YEAR(sale_date) = YEAR(CURDATE()) AND WEEK(sale_date, 1) = WEEK(CURDATE(), 1)");
              if ($row = mysqli_fetch_assoc($res)) $ganancia_semana = floatval($row['total']);
              // Hoy
              $res = mysqli_query($conexion, "SELECT SUM(quantity * price) AS total FROM sales WHERE sale_date = CURDATE()");
              if ($row = mysqli_fetch_assoc($res)) $ganancia_hoy = floatval($row['total']);
              mysqli_close($conexion);
            }
          } catch (Throwable $e) {}
        ?>
        <div class="col text-center">
          <img src="../Assets/Images/logos/carrito_de_compra.png" alt="Ventas" style="width: 4rem; height: 3rem; display: block; margin: 0 auto;">
          Ventas en general
        </div>
        <div class="col">Año<br><span><?php echo number_format($ganancia_ano, 2, ',', '.'); ?>€</span></div>
        <div class="col">Mes<br><span><?php echo number_format($ganancia_mes, 2, ',', '.'); ?>€</span></div>
        <div class="col">Semana<br><span><?php echo number_format($ganancia_semana, 2, ',', '.'); ?>€</span></div>
        <div class="col">Hoy<br><span><?php echo number_format($ganancia_hoy, 2, ',', '.'); ?>€</span></div>
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
<!-- Elfsight All-in-One Chat | Untitled All-in-One Chat -->
      <script src="https://static.elfsight.com/platform/platform.js" async></script>
      <div class="elfsight-app-0c3b7783-a3f5-4753-9ffe-587f92446b2d" data-elfsight-app-lazy></div>
</body>
</html>