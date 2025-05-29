<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú - La Dolce Vita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Css/Administrador-Equipo.css">
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
        <a class="nav-link active" href="Administrador-Equipo.php"><i class="bi bi-people"></i> Equipo</a>
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
        <a class="nav-link" href="Administrador-Notificaciones.php"><i class="bi bi-bell"></i> Notificaciones <span class="badge bg-danger"><?php echo $notificaciones; ?></span></a> <!-- Notificaciones -->
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

      <!-- Equipo -->
      <div class="container mt-5">
        <h2 class="text-center mt-5" style="font-size: 3rem; font-family: 'Georgia', serif; font-weight: bold; letter-spacing: 2px;">
          Equipo de La Dolce Vita
        </h2>

        <div class="grid row row-cols-1 row-cols-md-3 g-4 mt-3">
          <?php
            try {
              require('Conexion.php');
            } catch (Throwable $t) {
              echo "<p>Mensaje: " . $t->getMessage() . "</p>";
              exit();
            }
            try {
              if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
                mysqli_query($conexion, "SET NAMES 'UTF8'");
                if (mysqli_select_db($conexion, $bbdd)) {
                  $consulta = "SELECT * FROM equipo ORDER BY nombre;";
                  $resultado = mysqli_query($conexion, $consulta);
                  if (mysqli_errno($conexion) != 0) {
                    exit();
                  } else {
                    while ($fila = mysqli_fetch_array($resultado)) {
                      // Si tienes fotos personalizadas, usa la ruta de la base de datos, si no, usa un avatar por defecto
                      $foto = isset($fila['foto']) && $fila['foto'] ? "../Assets/Images/Equipo/{$fila['foto']}" : "https://randomuser.me/api/portraits/men/31.jpg";
                      echo "<div class='col'>
                              <div class='card text-center shadow-sm'>
                                <img src='$foto' alt='" . htmlspecialchars($fila['nombre']) . "' class='card-img-top rounded-circle mx-auto' style='width: 160px; height: 160px;'>
                                <div class='card-body'>
                                  <h4 class='card-title'><strong>" . htmlspecialchars($fila['nombre']) . "</strong></h4>
                                  <p class='card-text text-muted'>" . htmlspecialchars($fila['rol']) . "</p>
                                  <hr style='border: 1px solid #c94b4b;'>
                                  <p class='card-text'><strong>Rol:</strong> " . htmlspecialchars($fila['descripcion_rol']) . "</p>
                                  <p class='card-text'><strong>Horario:</strong> " . htmlspecialchars($fila['horario']) . "</p>
                                  <a href='tel:" . htmlspecialchars($fila['telefono']) . "' class='d-block'>" . htmlspecialchars($fila['telefono']) . "</a>
                                  <a href='mailto:" . htmlspecialchars($fila['correo_electronico']) . "' class='d-block'>" . htmlspecialchars($fila['correo_electronico']) . "</a>
                                </div>
                              </div>
                            </div>";
                    }
                  }
                }
                mysqli_close($conexion);
              } else {
                throw new mysqli_sql_exception(mysqli_connect_error(), mysqli_connect_errno());
              }
            } catch (mysqli_sql_exception $e) {
              echo "<p>Nº error: " . $e->getCode() . "</p>";
              echo "<p>Mensaje: " . $e->getMessage() . "</p>";
              exit();
            }
          ?>
        </div>

        <!-- Elfsight All-in-One Chat | Untitled All-in-One Chat -->
      <script src="https://static.elfsight.com/platform/platform.js" async></script>
      <div class="elfsight-app-0c3b7783-a3f5-4753-9ffe-587f92446b2d" data-elfsight-app-lazy></div>
      </div>
    </div>
  </div>
</div>

</body>
</html>