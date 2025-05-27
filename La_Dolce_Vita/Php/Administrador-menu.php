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
      height: 210vh; /* Ajusta la altura de la barra lateral */
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
      background-color: white;
      border: none;
      padding: 20px;
      margin: 2rem; /* Aumenta la separación entre los divs */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease-in-out; /* Añade transición para la animación */
      display: flex;
      flex-direction: column; /* Coloca el logo encima del texto */
      align-items: center;
      justify-content: center;
      width: 9rem; /* Div cuadrado */
      height: 10rem; /* Ajusta la altura para incluir el texto */
      text-align: center;
      cursor: pointer;
    }
    .category-item:hover {
      transform: scale(1.1); /* Aumenta ligeramente el tamaño al pasar el cursor */
    }
    .category-item img {
      width: 5rem; /* Tamaño del logo */
      height: 5rem;
      margin-bottom: 5px; /* Espacio entre el logo y el texto */
    }
    .category-item span {
      font-size: 1.2rem; /* Aumenta el tamaño del texto */
      font-family: 'Georgia', serif; /* Aplica una tipografía elegante */
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
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">

    <!-- Sidebar -->
    <div class="col-md-2 sidebar d-flex flex-column">
      <!-- Logo y Nombre del Restaurante -->
      <div class="text-center mb-4">
        <img src="../Assets/Images/La Dolce Vita icon 1.png" alt="Logo" class="img-fluid mb-3"  style="width: 11rem;"> <!-- Aumenta el tamaño del logo -->
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
        <a class="nav-link" href="Cocina-Pendientes.php"><i class="bi bi-egg-fried"></i> Cocina</a> <!-- Nuevo enlace -->
        <a class="nav-link active" href="Administrador-menu.php"><i class="bi bi-list"></i> Menú</a>
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
        
        <a class="nav-link" href="Administrador-Notificaciones.php"><i class="bi bi-bell"></i> Notificaciones <span class="badge bg-danger"><?php echo $notificaciones; ?></span></a> <!-- Notificaciones -->
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
                          <img src="' . htmlspecialchars($dish['image_url']) . '" class="card-img-top" alt="' . htmlspecialchars($dish['name']) . '">
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
            document.querySelectorAll('.category-item').forEach(function(c) { c.classList.remove('active'); });
            cat.classList.add('active');
            var catId = cat.getAttribute('data-category-id');
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'obtener_platos_por_categoria.php?category_id=' + catId, true);
            xhr.onload = function() {
              if (xhr.status === 200) {
                document.getElementById('menu-items').innerHTML = xhr.responseText;
              }
            };
            xhr.send();
          });
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
    </div>
  </div>
</div>

</body>
</html>