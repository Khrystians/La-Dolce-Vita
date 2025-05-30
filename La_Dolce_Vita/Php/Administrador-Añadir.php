<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú - La Dolce Vita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Css/Administrador-Añadir.css">
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
        <a class="nav-link " href="Administrador-Eventos.php"><i class="bi bi-calendar-event"></i> Eventos</a>
        <a class="nav-link" href="Administrador-Equipo.php"><i class="bi bi-people"></i> Equipo</a>
        <a class="nav-link" href="Cocina-Pendientes.php"><i class="bi bi-egg-fried"></i> Cocina</a> <!-- Nuevo enlace -->
        <a class="nav-link" href="Administrador-menu.php"><i class="bi bi-list"></i> Menú</a>
        <a class="nav-link active" href="#"><i class="bi bi-plus-circle"></i> Añadir plato</a> <!-- Nuevo enlace -->
      
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

      <?php
      // --- PROCESAR FORMULARIO DE AÑADIR PLATO ---
      $mensaje = '';
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_plato'])) {
        require('Conexion.php');
        $nombre = trim($_POST['nombre_plato']);
        $descripcion = trim($_POST['descripcion']);
        $precio = floatval($_POST['precio']);
        $categoria = intval($_POST['categoria']);
        $is_active = isset($_POST['is_active']) ? 1 : 0;
        $alergenos = isset($_POST['alergenos']) ? $_POST['alergenos'] : [];
        $image_url = '';

        // Procesar imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
          $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
          $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
          if (in_array($ext, $permitidas)) {
            $nombre_archivo = uniqid('plato_') . '.' . $ext;
            $ruta_destino = '../Assets/Images/Dishes/' . $nombre_archivo;
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
              $image_url = 'img/' . $nombre_archivo;
            }
          }
        }

        // Insertar plato
        if ($nombre && $precio > 0 && $categoria && $image_url) {
          if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
            mysqli_query($conexion, "SET NAMES 'UTF8'");
            $stmt = mysqli_prepare($conexion, "INSERT INTO dishes (name, description, price, image_url, category_id, is_active) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssdssi", $nombre, $descripcion, $precio, $image_url, $categoria, $is_active);
            if (mysqli_stmt_execute($stmt)) {
              $dish_id = mysqli_insert_id($conexion);
              // Insertar alérgenos
              foreach ($alergenos as $aid) {
                $aid = intval($aid);
                mysqli_query($conexion, "INSERT INTO dish_allergens (dish_id, allergen_id) VALUES ($dish_id, $aid)");
              }
              $mensaje = '<div class="alert alert-success mt-3">Plato añadido correctamente.</div>';
            } else {
              $mensaje = '<div class="alert alert-danger mt-3">Error al añadir el plato.</div>';
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
          }
        } else {
          $mensaje = '<div class="alert alert-danger mt-3">Todos los campos son obligatorios y la imagen debe ser válida.</div>';
        }
      }
      ?>

      <!-- FORMULARIO DE AÑADIR PLATO -->
      <div class="container mt-4 mb-5">
        <div class="card shadow-sm" style="width:900px;margin-top:5rem;">
          <div class="card-body">
            <h4 class="card-title mb-3">Añadir nuevo plato</h4>
            <?php echo $mensaje; ?>
            <form method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="nombre_plato" class="form-label">Nombre del plato</label>
                <input type="text" class="form-control" id="nombre_plato" name="nombre_plato" required>
              </div>
              <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required></textarea>
              </div>
              <div class="mb-3">
                <label for="precio" class="form-label">Precio (€)</label>
                <input type="number" step="0.01" min="0" class="form-control" id="precio" name="precio" required>
              </div>
              <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-select" id="categoria" name="categoria" required>
                  <option value="">Seleccione...</option>
                  <?php
                  // Mostrar categorías
                  require('Conexion.php');
                  if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
                    mysqli_query($conexion, "SET NAMES 'UTF8'");
                    $res = mysqli_query($conexion, "SELECT id, name FROM categories ORDER BY name");
                    while ($cat = mysqli_fetch_assoc($res)) {
                      echo '<option value="' . $cat['id'] . '">' . htmlspecialchars($cat['name']) . '</option>';
                    }
                    mysqli_close($conexion);
                  }
                  ?>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Alérgenos</label>
                <div class="row">
                  <?php
                  // Mostrar alérgenos
                  require('Conexion.php');
                  if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
                    mysqli_query($conexion, "SET NAMES 'UTF8'");
                    $res = mysqli_query($conexion, "SELECT id, name FROM allergens ORDER BY name");
                    while ($al = mysqli_fetch_assoc($res)) {
                      echo '<div class="col-6 col-md-4">
                              <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="alergenos[]" value="' . $al['id'] . '" id="alergeno_' . $al['id'] . '">
                                <label class="form-check-label" for="alergeno_' . $al['id'] . '">' . htmlspecialchars($al['name']) . '</label>
                              </div>
                            </div>';
                    }
                    mysqli_close($conexion);
                  }
                  ?>
                </div>
              </div>
              <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del plato</label>
                <input class="form-control" type="file" id="imagen" name="imagen" accept="image/*" required>
                <div class="form-text">Se guardará en <code>Assets/Images/img/</code></div>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" checked>
                <label class="form-check-label" for="is_active">Plato activo</label>
              </div>
              <button type="submit" class="btn btn-success w-100">Añadir plato</button>
            </form>
          </div>
        </div>
      </div>
      <!-- FIN FORMULARIO DE AÑADIR PLATO -->

      <!-- Elfsight All-in-One Chat | Untitled All-in-One Chat -->
      <script src="https://static.elfsight.com/platform/platform.js" async></script>
      <div class="elfsight-app-0c3b7783-a3f5-4753-9ffe-587f92446b2d" data-elfsight-app-lazy></div>
    </div>
  </div>
</div>

</body>
</html>