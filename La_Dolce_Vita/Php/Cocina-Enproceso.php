<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Top Bar</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      padding: 0;
    }

    .top-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px 20px;
      border-bottom: 1px solid #ccc;
      background-color: #fff;
      margin: 0; /* Sin margen, pegado al borde superior */
      box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }

    .logo-section {
      display: flex;
      align-items: center;
    }

    .logo-section img {
      height: 5rem;
      margin-right: 1rem;
    }

    .logo-section span {
      font-size: 2rem;
      font-style: italic; /* En cursiva */
    }

    .divider {
      width: 1px;
      height: 60px;
      background-color: #ccc;
      margin: 0 20px;
    }

    .mesa-container {
      display: flex;
      flex-wrap: nowrap;
      gap: 16px;
      padding: 16px;
      background-color: #fff; /* Cambiado de #f7f7f7 a blanco */
      border-radius: 6px;
      max-width: 900px;
      overflow-x: auto;
      scroll-behavior: smooth;
    }

    .mesa-box {
      border: 2px solid #333;
      padding: 18px 28px;
      border-radius: 12px;
      text-align: center;
      cursor: pointer;
      background: linear-gradient(135deg, #fff 70%, #ffe5b4 100%);
      box-shadow: 0 4px 18px rgba(0,0,0,0.18), 0 1.5px 4px rgba(0,0,0,0.13); /* Sombra oscura */
      transition: transform 0.15s, box-shadow 0.15s, border-color 0.15s;
      min-width: 90px;
      min-height: 70px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      flex: 0 0 auto;
    }

    .mesa-box:hover {
      background: linear-gradient(135deg, #fffbe6 70%, #ffd6a0 100%);
      transform: translateY(-4px) scale(1.04);
      box-shadow: 0 8px 32px rgba(0,0,0,0.25), 0 2px 8px rgba(0,0,0,0.18); /* Sombra oscura al hacer hover */
      border-color: #c0392b;
    }

    .mesa-title {
      font-size: 15px;
      color: #555;
      margin-bottom: 4px;
      letter-spacing: 1px;
    }

    .mesa-id {
      font-size: 22px;
      font-weight: bold;
      color: #c0392b; /* Cambiado a rojo */
      letter-spacing: 2px;
    }

    .finalizar {
      display: flex;
      align-items: center;
      color: #c0392b;
      font-weight: 700;
      cursor: pointer;
      font-size: 2rem; /* Más grande */
      padding: 0.5rem 1.2rem;
      gap: 0.7rem;
      letter-spacing: 1px;
      transition: font-size 0.2s;
    }

    .finalizar img {
      height: 4rem;
      margin-right: 10px;
    }

    .slider-btn {
      width: 4rem;
      height: 4rem;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      margin: 0 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.07);
      user-select: none;
      position: relative;
      top: 50%;
      transform: translateY(0%);
      z-index: 2;
      font-size: 0;
      padding: 0;
      background: #fff;
      border: none;
      outline: none;
    }
    #slider-left {
      background-image: url('../Assets/Images/logos/arrow-izquierda.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 2rem 2rem;
      transition: background-size 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #slider-right {
      background-image: url('../Assets/Images/logos/arrow-derecha.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 2rem 2rem;
      transition: background-size 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #slider-left:hover,
    #slider-right:hover {
      background-size: 2.7rem 2.7rem;
    }
    #slider-left::before,
    #slider-right::before {
      content: none !important;
    }
    #slider-left:after,
    #slider-right:after {
      content: none !important;
    }
    .slider-btn:hover {
     
      color: #fff;
    }

    /* Aquí comienzan los estilos de las tarjetas */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f2f2;
      padding: 0px;
    }

    .container {
      display: flex;
      gap: 28px;
      flex-wrap: nowrap;
      justify-content: flex-start;
      margin-top: 2rem;
      overflow-x: auto;
      scroll-behavior: smooth;
      max-width: 100vw;
      /* Mostrar solo 5 tarjetas a la vez */
      width: calc(340px * 5 + 28px * 4); /* 5 tarjetas + 4 gaps */
    }
    .carousel-btn {
      width: 4rem;
      height: 4rem;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      margin: 0 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.07);
      user-select: none;
      position: relative;
      top: 50%;
      transform: translateY(550%);
      z-index: 2;
      font-size: 0;
      padding: 0;
      background: #fff;
      border: none;
      outline: none;
    }
    #carousel-left {
      background-image: url('../Assets/Images/logos/arrow-izquierda.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 2rem 2rem;
      transition: background-size 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #carousel-right {
      background-image: url('../Assets/Images/logos/arrow-derecha.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: 2rem 2rem;
      transition: background-size 0.4s cubic-bezier(0.4,0,0.2,1);
    }
    #carousel-left:hover,
    #carousel-right:hover {
      background-size: 2.7rem 2.7rem;
    }
    #carousel-left::before,
    #carousel-right::before {
      content: none !important;
    }
    #carousel-left:after,
    #carousel-right:after {
      content: none !important;
    }
    .carousel-btn:hover {

    }

    /* Aquí terminan los estilos de las tarjetas */
    @media (max-width: 900px) {
      .container {
        max-width: 100vw;
      }
    }

    .mesa-card {
      width: 340px;
      min-width: 340px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 8px rgba(0,0,0,0.13);
      overflow: hidden;
      flex: 0 0 auto;
      margin: 15px 14px;
      display: flex;
      flex-direction: column;
      height: 100%;
    }

    .mesa-header {
      text-align: center;
      padding: 15px 0 5px;
      font-size: 27px;
      font-weight: bold;
    }

    .pedido-subtitle {
      text-align: center;
      font-size: 16px;
      color: #555;
      border-bottom: 1px solid #ccc;
      margin: 0 10px 10px;
      padding-bottom: 10px;
      position: relative;
    }

    .pedido-subtitle::after {
      content: "";
      position: absolute;
      bottom: -1px;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 2px;
      background-color: #c0392b;
    }

    .accordion {
      border-top: 1px solid #ccc;
    }

    .accordion-header {
      background-color: #ccc;
      padding: 10px 15px;
      cursor: pointer;
      font-weight: 300;
      border-top: 2px solid #222;
      border-bottom: 2px solid #222;
      text-align: center;
      justify-content: center;
      display: flex;
      font-size: 17px;
    }

    .accordion-content {
      display: block;
      max-height: 0;
      overflow: hidden;
      background-color: #fff;
      transition: max-height 0.35s cubic-bezier(0.4,0,0.2,1), padding 0.35s;
      padding: 0 15px;
    }

    .accordion.active .accordion-content {
      display: block;
      max-height: 500px;
      padding: 10px 15px;
      /* Ajusta max-height si tus contenidos pueden ser más grandes */
    }

    .plato-item {
      display: flex;
      justify-content: space-between;
      padding: 13px 18px;
      border-bottom: 1px solid #eee;
      font-size: 16px;
    }

    .plato-item:last-child {
      border-bottom: none;
    }

    .footer-bar {
      background-color: #c0392b;
      height: 4rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 18px;
      padding: 1rem 1rem;
      margin-top: auto;
    }

    .footer-bar button {
      padding: 0.6rem 1.5rem; /* Más grande */
      border-radius: 8px;
      border: 1px solid #111; /* Borde negro delgado */
      font-size: 20px; /* Más grande */
      font-family: 'Montserrat', Arial, sans-serif; /* Cambia tipografía */
      font-weight: 100; /* Más grueso */
      cursor: pointer;
      transition: background 0.2s, color 0.2s;
      margin: 5rem 6px;
      letter-spacing: 1px;
      color: #111; /* Letras negras */
      position: relative;
      overflow: hidden;
      padding-left: 1.5rem; /* Espacio mínimo para el icono */
      text-align: center;   /* Centrado por defecto */
    }
    .footer-bar button:hover {
      padding-left: 2.1rem;
      text-align: left;
      transition: padding-left 0.7s cubic-bezier(0.4,0,0.2,1), text-align 0.7s cubic-bezier(0.4,0,0.2,1);
    }
    .footer-bar .btn-preparar::after,
    .footer-bar .btn-eliminar::after {
      content: '';
      display: inline-block;
      position: absolute;
      left: 8px;
      top: 50%;
      transform: translateY(-50%) scale(0.6);
      opacity: 0;
      width: 22px;
      height: 22px;
      background: none;
      transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1);
      pointer-events: none;
    /* Check icon SVG en verde */
      background-image: url('data:image/svg+xml;utf8,<svg fill="%2327ae60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><polyline points="20 6 10 18 4 12" style="fill:none;stroke:%2327ae60;stroke-width:3"/></svg>');
      background-repeat: no-repeat;
      background-size: 22px 22px;
    }
    .footer-bar .btn-preparar:hover::after {
      opacity: 1;
      transform: translateY(-50%) scale(1);
    }
    .footer-bar .btn-eliminar::after {
      content: '';
      display: inline-block;
      position: absolute;
      left: 8px;
      top: 50%;
      transform: translateY(-50%) scale(0.6);
      opacity: 0;
      width: 22px;
      height: 22px;
      background: none;
      transition: opacity 0.7s cubic-bezier(0.4,0,0.2,1), transform 0.7s cubic-bezier(0.4,0,0.2,1);
      pointer-events: none;
    /* X icon SVG en rojo */
      background-image: url('data:image/svg+xml;utf8,<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><line x1="6" y1="6" x2="18" y2="18" stroke="%23e74c3c" stroke-width="2"/><line x1="18" y1="6" x2="6" y2="18" stroke="%23e74c3c" stroke-width="2"/></svg>');
      background-repeat: no-repeat;
      background-size: 22px 22px;
    }
    .footer-bar .btn-eliminar:hover::after {
      opacity: 1;
      transform: translateY(-50%) scale(1);
    }

    /* Estilos para abrir los acordeones */
    .accordion.active .accordion-content {
      display: block;
    }
  </style>
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