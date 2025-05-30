<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú - La Dolce Vita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Css/Administrador-Finanzas-Mesas.css">
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
        <a class="nav-link active" href="#"><i class="bi bi-bar-chart"></i> Finanzas</a>
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

      <!-- Títulos de sección uno al lado del otro -->
      <div class="section-titles-container">
        <a href="Administrador-Finanzas-Categorias.php" class="section-title">Ventas por categoría</a>
        <a href="Administrador-Finanzas-Mesas.php" class="section-title active">Ventas por Mesa</a>
      </div>

      <!-- Contenido de mesas -->
      <div id="tables-view" class="d-flex justify-content-center gap-4 flex-wrap" style="display: none;">
        <?php
        // Obtener categorías para los títulos de cada item
        $categorias = [];
        try {
          require('Conexion.php');
          if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
            mysqli_query($conexion, "SET NAMES 'UTF8'");
            $resCat = mysqli_query($conexion, "SELECT id, name FROM categories ORDER BY id");
            while ($cat = mysqli_fetch_assoc($resCat)) {
              $categorias[] = $cat;
            }
            // Obtener todas las mesas
            $resMesas = mysqli_query($conexion, "SELECT id, number FROM tables ORDER BY number");
            while ($mesa = mysqli_fetch_assoc($resMesas)) {
              $mesa_id = intval($mesa['id']);
              $mesa_num = intval($mesa['number']);
              $totales_categoria = [];
              $total_mesa = 0;
              // Para cada categoría, sumar ventas de todos los platos de esa categoría para esta mesa
              foreach ($categorias as $cat) {
                $cat_id = intval($cat['id']);
                $sql = "
                  SELECT SUM(s.quantity * s.price) AS total
                  FROM sales s
                  JOIN dishes d ON s.dish_id = d.id
                  WHERE s.table_id = $mesa_id AND d.category_id = $cat_id
                ";
                $res = mysqli_query($conexion, $sql);
                $total_cat = 0;
                if ($row = mysqli_fetch_assoc($res)) {
                  $total_cat = floatval($row['total']);
                }
                $totales_categoria[$cat['name']] = $total_cat;
                $total_mesa += $total_cat;
              }
              // Renderizar la tarjeta de la mesa
              echo '<div class="card">';
              echo '<div class="title">Mesa ' . $mesa_num . '</div>';
              foreach ($categorias as $cat) {
                echo '<div class="item"><span>' . htmlspecialchars($cat['name']) . '</span><span class="price">+ ' . number_format($totales_categoria[$cat['name']], 2, ',', '.') . '€</span></div>';
              }
              echo '<div class="divider"></div>';
              echo '<div class="total">+ ' . number_format($total_mesa, 2, ',', '.') . '€</div>';
              echo '</div>';
            }
            mysqli_close($conexion);
          }
        } catch (Throwable $e) {
          echo '<div class="text-danger">No se pudieron cargar las ganancias de las mesas.</div>';
        }
        ?>
      </div>

      <!-- Elfsight All-in-One Chat | Untitled All-in-One Chat -->
      <script src="https://static.elfsight.com/platform/platform.js" async></script>
      <div class="elfsight-app-0c3b7783-a3f5-4753-9ffe-587f92446b2d" data-elfsight-app-lazy></div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const tablesView = document.getElementById('tables-view');
    // Agregar la clase 'show' después de un pequeño retraso para activar la transición
    setTimeout(() => {
      tablesView.classList.add('show');
    }, 100);
  });
</script>
</body>
</html>