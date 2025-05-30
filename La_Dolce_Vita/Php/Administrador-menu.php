<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Menú - La Dolce Vita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Css/Administrador-menu.css">
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
        <a class="nav-link active" href="Administrador-menu.php"><i class="bi bi-list"></i> Menú</a>
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

      <!-- Categorías -->
      <div class="categories-container px-4 mb-4">
        <?php
          // Obtener categorías de la base de datos
          $categorias = [];
          try {
            require('Conexion.php');
            if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
              mysqli_query($conexion, "SET NAMES 'UTF8'");
              $resCat = mysqli_query($conexion, "SELECT * FROM categories ORDER BY id");
              while ($cat = mysqli_fetch_assoc($resCat)) {
                $categorias[] = $cat;
              }
              mysqli_close($conexion);
            }
          } catch (Throwable $e) {}
        ?>
        <?php foreach ($categorias as $i => $cat): ?>
          <div class="category-item<?php if ($i === 0) echo ' active'; ?>" data-category-id="<?php echo $cat['id']; ?>">
            <img src="../Assets/Images/logos/<?php echo strtolower($cat['name']); ?>.png" alt="<?php echo htmlspecialchars($cat['name']); ?>">
            <span><?php echo htmlspecialchars($cat['name']); ?></span>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Menú items -->
      <div id="menu-items" class="row row-cols-1 row-cols-md-4 g-4 px-4">
        <?php
          // Mostrar los platos de la primera categoría por defecto
          $cat_id = isset($categorias[0]['id']) ? $categorias[0]['id'] : 1;
          try {
            require('Conexion.php');
            if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
              mysqli_query($conexion, "SET NAMES 'UTF8'");
              $sql = "SELECT * FROM dishes WHERE category_id = $cat_id";
              $resDishes = mysqli_query($conexion, $sql);
              while ($dish = mysqli_fetch_assoc($resDishes)) {
                // Obtener alérgenos
                $allergens = [];
                $resAll = mysqli_query($conexion, "SELECT a.name FROM dish_allergens da JOIN allergens a ON da.allergen_id = a.id WHERE da.dish_id = " . intval($dish['id']));
                while ($a = mysqli_fetch_assoc($resAll)) {
                  $allergens[] = $a['name'];
                }
                echo '<div class="col">
                        <div class="card menu-card shadow-sm">
                          <img src="../Assets/Images/Dishes/' . htmlspecialchars(substr_replace(substr($dish['image_url'], 4), 'png', -3)) . '" class="card-img-top" alt="' . htmlspecialchars($dish['name']) . '">
                          <div class="card-body text-center">
                            <h6 class="card-title mb-1">' . htmlspecialchars($dish['name']) . '</h6>
                            <div class="allergens">';
                foreach ($allergens as $al) {
                  $icon = strtolower($al);
                  echo '<img src="../Assets/Images/logos/' . $icon . '.png" alt="' . htmlspecialchars($al) . '">';
                }
                echo    '</div>
                            <button class="btn btn-secondary btn-sm mb-2 w-100">Editar</button>';
                // Botón activar/desactivar según is_active
                if ($dish['is_active']) {
                  echo '<button class="btn btn-warning btn-sm w-100 toggle-active-btn" data-dish-id="' . $dish['id'] . '" data-active="1">Desactivar</button>';
                } else {
                  echo '<button class="btn btn-success btn-sm w-100 toggle-active-btn" data-dish-id="' . $dish['id'] . '" data-active="0">Activar</button>';
                }
                echo    '
                          </div>
                        </div>
                      </div>';
              }
              mysqli_close($conexion);
            }
          } catch (Throwable $e) {}
        ?>
      </div>

      <script>
        // Manejo de clic en categorías y carga dinámica de platos
        document.querySelectorAll('.category-item').forEach(function(cat) {
          cat.addEventListener('click', function() {
            document.querySelectorAll('.category-item').forEach(function(c) {
              c.classList.remove('active');
              // Restaurar logo normal
              var img = c.querySelector('img');
              var base = img.getAttribute('alt').toLowerCase();
              img.src = "../Assets/Images/logos/" + base + ".png";
            });
            cat.classList.add('active');
            // Cambiar logo a _negro
            var img = cat.querySelector('img');
            var base = img.getAttribute('alt').toLowerCase();
            img.src = "../Assets/Images/logos/" + base + "_negro.png";
            var catId = cat.getAttribute('data-category-id');
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'obtener_platos_por_categoria.php?category_id=' + catId, true);
            xhr.onload = function() {
              if (xhr.status === 200) {
                document.getElementById('menu-items').innerHTML = xhr.responseText;
                animarPlatos();
              }
            };
            xhr.send();
          });
        });

        // Animación de entrada para los platos
        function animarPlatos() {
          var cards = document.querySelectorAll('#menu-items .menu-card');
          cards.forEach(function(card, i) {
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
            setTimeout(function() {
              card.style.transition = 'opacity 0.4s cubic-bezier(.4,2,.6,1), transform 0.4s cubic-bezier(.4,2,.6,1)';
              card.style.opacity = '1';
              card.style.transform = 'scale(1)';
            }, 60 * i);
          });
        }

        // Llama a la animación al cargar la página por primera vez
        document.addEventListener('DOMContentLoaded', function() {
          animarPlatos();
        });

        // Delegación de eventos para los botones activar/desactivar
        document.addEventListener('click', function(e) {
          if (e.target.classList.contains('toggle-active-btn')) {
            var btn = e.target;
            var dishId = btn.getAttribute('data-dish-id');
            var isActive = btn.getAttribute('data-active');
            var newActive = isActive === "1" ? 0 : 1;
            var catActive = document.querySelector('.category-item.active');
            var catId = catActive ? catActive.getAttribute('data-category-id') : '';
            btn.disabled = true;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'actualizar_estado_plato.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
              btn.disabled = false;
              if (xhr.status === 200) {
                // Recargar los platos de la categoría actual
                var xhr2 = new XMLHttpRequest();
                xhr2.open('GET', 'obtener_platos_por_categoria.php?category_id=' + catId, true);
                xhr2.onload = function() {
                  if (xhr2.status === 200) {
                    document.getElementById('menu-items').innerHTML = xhr2.responseText;
                  }
                };
                xhr2.send();
              }
            };
            xhr.send('dish_id=' + encodeURIComponent(dishId) + '&is_active=' + encodeURIComponent(newActive));
          }
        });
      </script>

      <!-- Elfsight All-in-One Chat | Untitled All-in-One Chat -->
      <script src="https://static.elfsight.com/platform/platform.js" async></script>
      <div class="elfsight-app-0c3b7783-a3f5-4753-9ffe-587f92446b2d" data-elfsight-app-lazy></div>
    </div>
  </div>
</div>

</body>
</html>