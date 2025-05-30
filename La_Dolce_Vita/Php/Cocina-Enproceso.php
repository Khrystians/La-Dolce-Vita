<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Top Bar</title>
  <link rel="stylesheet" href="../Css/Cocina-Enproceso.css">
</head>
<body>
  <div class="top-bar">
    <!-- Logo + Nombre -->
    <div class="logo-section">
       <img src="../Assets/Images/La Dolce Vita icon.png" alt="logo"  />
      <span><strong>LA DOLCE VITA</strong></span>
    </div>

    <!-- Divider -->
    <div class="divider"></div>

    <!-- Mesas Slider -->
    <?php
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "la_dolce_vita");
    if ($conn->connect_error) {
      die("Error de conexión: " . $conn->connect_error);
    }
    // Obtener mesas con pedidos EN COCINA
    $sql_mesas = "SELECT DISTINCT t.number AS mesa_num
                  FROM orders o
                  JOIN tables t ON o.table_id = t.id
                  WHERE o.status = 'en cocina'
                  ORDER BY t.number ASC";
    $result_mesas = $conn->query($sql_mesas);
    ?>
    <button class="slider-btn" id="slider-left"></button>
    <div class="mesa-container" id="mesa-slider">
      <?php
      if ($result_mesas && $result_mesas->num_rows > 0) {
        while ($row = $result_mesas->fetch_assoc()) {
          ?>
          <div class="mesa-box">
            <div class="mesa-title">Mesa</div>
            <div class="mesa-id"><?php echo htmlspecialchars($row['mesa_num']); ?></div>
          </div>
          <?php
        }
      } else {
        echo "<div style='padding:1rem 2rem;color:#888;font-size:1.2rem;'>No hay mesas con pedidos en cocina.</div>";
      }
      ?>
    </div>
    <button class="slider-btn" id="slider-right"></button>
    <?php $conn->close(); ?>

    <!-- Finalizar -->
    <div class="finalizar" onclick="window.location.href='Administrador-menu.php'">
      <img src="../Assets/Images/logos/checking.png" alt="icono salir"/>
      <span>Finalizar</span>
    </div>
  </div>
  <!-- Aquí termina el top-bar -->

  <!-- Carrusel de pedidos -->
  <div style="display: flex; align-items: flex-start; justify-content: center;">
    <button class="carousel-btn" id="carousel-left"></button>
    <div class="container" id="pedido-carousel">
      <?php
      // --- Manejo del cambio de estado a "entregado" ---
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['completar_pedido_id'])) {
        $pedido_id = intval($_POST['completar_pedido_id']);
        $conn = new mysqli("localhost", "root", "", "la_dolce_vita");
        if (!$conn->connect_error) {
          $conn->query("UPDATE orders SET status='entregado' WHERE id=$pedido_id");
          $conn->close();
          // Recargar para reflejar el cambio
          echo "<script>location.href=location.href;</script>";
          exit;
        }
      }
      // --- Fin manejo completar ---

      // Conexión a la base de datos
      $conn = new mysqli("localhost", "root", "", "la_dolce_vita");
      if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
      }

      // Obtener pedidos EN COCINA
      $sql_pedidos = "SELECT o.id, o.table_id, o.name, t.number as mesa_num
                      FROM orders o
                      JOIN tables t ON o.table_id = t.id
                      WHERE o.status = 'en cocina'
                      ORDER BY o.created_at ASC";
      $result_pedidos = $conn->query($sql_pedidos);

      // Obtener categorías
      $categorias = [];
      $sql_categorias = "SELECT id, name FROM categories";
      $result_categorias = $conn->query($sql_categorias);
      while ($row = $result_categorias->fetch_assoc()) {
        $categorias[$row['id']] = $row['name'];
      }

      // Mostrar cada pedido
      if ($result_pedidos && $result_pedidos->num_rows > 0) {
        while ($pedido = $result_pedidos->fetch_assoc()) {
          $pedido_id = $pedido['id'];
          $mesa_num = $pedido['mesa_num'];
          $nombre_pedido = $pedido['name'] ? htmlspecialchars($pedido['name']) : "Pedido sin nombre";

          // Obtener platos del pedido agrupados por categoría
          $sql_platos = "SELECT od.quantity, d.name as plato, d.category_id, c.name as categoria
                         FROM order_dishes od
                         JOIN dishes d ON od.dish_id = d.id
                         JOIN categories c ON d.category_id = c.id
                         WHERE od.order_id = $pedido_id
                         ORDER BY d.category_id, d.name";
          $result_platos = $conn->query($sql_platos);

          // Agrupar platos por categoría
          $platos_por_categoria = [];
          if ($result_platos) {
            while ($row = $result_platos->fetch_assoc()) {
              $cat = $row['categoria'];
              if (!isset($platos_por_categoria[$cat])) $platos_por_categoria[$cat] = [];
              $platos_por_categoria[$cat][] = [
                'nombre' => $row['plato'],
                'cantidad' => $row['quantity']
              ];
            }
          }
          ?>
          <div class="mesa-card">
            <div class="mesa-header">Mesa <?php echo htmlspecialchars($mesa_num); ?></div>
            <div class="pedido-subtitle"><?php echo $nombre_pedido; ?></div>
            <?php foreach ($categorias as $cat_id => $cat_nombre): ?>
              <?php if (!empty($platos_por_categoria[$cat_nombre])): ?>
                <div class="accordion">
                  <div class="accordion-header"><?php echo htmlspecialchars($cat_nombre); ?></div>
                  <div class="accordion-content">
                    <?php foreach ($platos_por_categoria[$cat_nombre] as $plato): ?>
                      <div class="plato-item">
                        <span><?php echo htmlspecialchars($plato['nombre']); ?></span>
                        <span><?php echo intval($plato['cantidad']); ?></span>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
            <div class="footer-bar">
              <form method="post" style="display:inline;">
                <input type="hidden" name="completar_pedido_id" value="<?php echo $pedido_id; ?>">
                <button class="btn-preparar" type="submit">Completar</button>
              </form>
            </div>
          </div>
          <?php
        }
      } else {
        echo "<div style='padding:2rem;font-size:1.3rem;color:#888;'>No hay pedidos en cocina.</div>";
      }
      $conn->close();
      ?>
    </div>
    <button class="carousel-btn" id="carousel-right"></button>
  </div>
  <!-- Fin carrusel de pedidos -->

  <!-- Botonera -->
  <style>
    .botonera {
      display: flex;
      gap: 30px;
      justify-content: center;
      left: 0;
      right: 0;
      bottom: 0;
      margin: 0;
      background: #fff;
      border-radius: 0;
      box-shadow: 0 -2px 10px rgba(0,0,0,0.06);
      padding: 18px 0;
      z-index: 100;
    }

    .botonera button {
      padding: 20px 45px;
      font-size: 1.5rem;
      font-weight: bold;
      border: 1px solid #333;
      border-radius: 6px;
      background-color: white;
      color: black;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .botonera button:hover {
      background-color: #eee;
    }

    .botonera .activo {
      background-color: #c54646;
      color: white;
      border: none;
    }
  </style>

  <div class="botonera">
    <button onclick="window.location.href='Cocina-Pendientes.php'">PEDIDOS EN PENDIENTES</button>
    <button class="activo">PEDIDOS EN PROCESO</button>
    <button onclick="window.location.href='Cocina-Completados.php'">PEDIDOS COMPLETADOS</button>
  </div>
  <!-- Fin botonera -->

  <!-- Script para manejo de acordeones y carruseles -->
  <script>
    // Manejo del acordeón
    document.querySelectorAll('.accordion-header').forEach(header => {
      header.addEventListener('click', () => {
        const accordion = header.parentElement;
        accordion.classList.toggle('active');
      });
    });

    // Abrir siempre las 3 primeras categorías por tarjeta al cargar la página
    document.querySelectorAll('.mesa-card').forEach(card => {
      const accordions = card.querySelectorAll('.accordion');
      for (let i = 0; i < accordions.length && i < 3; i++) {
        accordions[i].classList.add('active');
      }
    });

    // Carrusel horizontal para pedidos
    const pedidoCarousel = document.getElementById('pedido-carousel');
    document.getElementById('carousel-left').onclick = () => {
      pedidoCarousel.scrollBy({ left: -300, behavior: 'smooth' });
    };
    document.getElementById('carousel-right').onclick = () => {
      pedidoCarousel.scrollBy({ left: 300, behavior: 'smooth' });
    };

    // Slider horizontal para mesas
    const slider = document.getElementById('mesa-slider');
    document.getElementById('slider-left').onclick = () => {
      slider.scrollBy({ left: -200, behavior: 'smooth' });
    };
    document.getElementById('slider-right').onclick = () => {
      slider.scrollBy({ left: 200, behavior: 'smooth' });
    };
  </script>
</body>
</html>