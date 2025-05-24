<!DOCTYPE html>
<html lang="es">
<head>
  <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        $mesaAleatoria = "Mesa" . rand(1, 10);
        $_SESSION['usuario'] = strtolower($mesaAleatoria);
    }
    $nombreMesa = isset($_SESSION['usuario']) ? ucfirst($_SESSION['usuario']) : 'Mesa';
  ?>
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
      height: 200vh;
      padding: 0;
      border-right: 1px solid #ddd;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      min-width: 300px;
      max-width: 150vh;
      display: flex;
      flex-direction: column;
      justify-content: stretch;
    }
    .sidebar-content {
      width: 100%;
      height: 100%;
      padding-left: 18px;
      padding-right: 18px;
      display: flex;
      flex-direction: column;
      flex: 1 1 auto;
    }
    .logo {
      text-align: center;
      margin-bottom: 28px;
      margin-top: 38px;
    }
    .logo img {
      width: 120px;
      max-width: 100%;
    }
    .logo h2 {
      margin: 16px 0 0;
      font-size: 16px;
      font-weight: normal;
      letter-spacing: 1px;
    }
    .sidebar-hr {
      border: none;
      border-top: 3px solid #ccc;
      margin: 20px 0;
    }
    .sidebar-title {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 15px;
      padding-left: 4px;
      padding-right: 4px;
    }
    .order-card {
      border: 1px solid #ccc;
      border-left: 5px solid #c0392b;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .order-label {
      background-color: #c0392b;
      color: white;
      font-weight: bold;
      padding: 4px 10px;
      border-radius: 4px;
      font-size: 12px;
      margin-right: 10px;
    }
    .order-info {
      flex: 1;
    }
    .order-info h4 {
      margin: 0;
      font-size: 14px;
      font-weight: normal;
    }
    .order-info small {
      font-size: 12px;
      color: #555;
    }
    .status {
      font-size: 12px;
      font-weight: bold;
      padding: 2px 6px;
      border-radius: 4px;
      text-align: center;
      white-space: nowrap;
    }
    .cocina {
      background-color: #f1c40f;
      color: #333;
    }
    .entregado {
      background-color: #2ecc71;
      color: white;
    }
    .pendiente {
      background-color: #e74c3c;
      color: white;
    }
    .sidebar-total {
      margin-top: 30px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      display: flex;
      justify-content: space-between;
      font-size: 16px;
    }
    .sidebar-total .price {
      color: #2ecc71;
      font-weight: bold;
    }
    .payment-methods {
      display: flex;
      justify-content: space-around;
      margin: 20px 0;
    }
    .payment-method {
      text-align: center;
      font-size: 12px;
    }
    .payment-method img {
      width: 30px;
      height: 30px;
      margin-bottom: 5px;
    }
    .finalize-btn {
      background-color: #c0392b;
      color: white;
      border: none;
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .finalize-btn:hover {
      background-color: #a93226;
    }
    .sidebar-date {
      margin-top: 20px;
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
      padding: 14px;
      margin: 0.5rem;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease-in-out;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 8rem;
      height: 9rem;
      text-align: center;
      cursor: pointer;
    }
    .category-item:hover {
      transform: scale(1.12);
      background-color: #c94b4b;
      color: white;
    }
    .category-item img {
      width: 3.5rem;
      height: 3.5rem;
      margin-bottom: 8px;
    }
    .category-item span {
      font-size: 1.25rem;
      font-family: 'Georgia', serif;
    }
    .category-item .earnings {
      font-size: 1rem;
      color: rgb(31, 198, 70);
      font-weight: bold;
      margin-top: 0.3rem;
    }
    .category-item.active {
      background-color: #c94b4b;
      color: white;
    }
    .categories-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: nowrap;
      overflow-x: auto;
      gap: 0.5rem;
      padding-bottom: 10px;
      scrollbar-width: none;
      -ms-overflow-style: none;
    }
    .categories-container::-webkit-scrollbar {
      display: none;
    }
    .menu-card {
      border-radius: 0;
      overflow: hidden;
      padding: 6px;
      width: 1rem;  /* Más angosto aún */
      margin: 6px auto;
    }
    .menu-card img {
      height: 4rem;
      object-fit: cover;
      margin-bottom: 6px;
      border-radius: 8px;
    }
    .menu-card button {
      font-size: 0.9rem;
      font-weight: normal;
    }
    .menu-card h6 {
      font-size: 0.9rem;
      margin-top: -0.3rem;
    }
    .menu-card .allergens {
      display: flex;
      justify-content: center;
      gap: 4px;
      margin-top: 4px;
    }
    .menu-card .allergens img {
      width: 1rem;
      height: 1rem;
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
    .sidebar-divider-red {
      height: 3rem;
      background: linear-gradient(to bottom, #000 0 0.2rem, #c94b4b 0.2rem calc(100% - 0.2rem), #000 calc(100% - 0.2rem) 100%);
      border: none;
      margin: 22px -18px 22px -18px;
      width: calc(100% + 36px);
      border-radius: 0;
    }

    /* Sidebar derecho nuevo */
    .sidebar-right {
      background-color: white;
      min-height: 100vh;
      width: 320px;
      max-width: 100vw;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      padding: 20px;
      position: relative;
      display: flex;
      flex-direction: column;
    }
    .sidebar-right h2 {
      font-size: 2.1rem;
      margin-bottom: 10px;
    }
    .pedido-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .pedido-header h3 {
      display: none;
    }
    .pedido-header .pedido-input {
      font-weight: bold;
      font-size: 1.5rem;
      color: #333;
      margin: 0;
      border: none;
      background: transparent;
      outline: none;
      width: 100%;
      max-width: 270px;
      padding: 0 4px;
    }
    .edit-icon {
      width: 20px;
      height: 20px;
    }
    .sidebar-right hr {
      border: none;
      border-top: 1px solid #ccc;
      margin: 15px 0;
    }
    .item-card {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      border-radius: 6px;
      padding: 8px;
      margin-bottom: 12px;
    }
    .item-card img {
      width: 50px;
      height: 50px;
      border-radius: 4px;
      margin-right: 10px;
      object-fit: cover;
    }
    .item-details {
      flex: 1;
    }
    .item-title {
      font-weight: bold;
      font-size: 14px;
      margin: 0;
    }
    .item-subtitle {
      font-size: 12px;
      color: gray;
      margin: 0;
    }
    .item-price {
      font-size: 14px;
      color: #27ae60;
      font-weight: bold;
      margin: 0;
    }
    .quantity {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-left: 10px;
    }
    .qty-btn {
      background-color: #e74c3c;
      color: white;
      border: none;
      width: 22px;
      height: 22px;
      border-radius: 50%;
      font-size: 16px;
      cursor: pointer;
      line-height: 1;
    }
    .qty-btn.add {
      background-color: #c0392b;
    }
    .cost-summary {
      margin-top: 30px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      display: flex;
      justify-content: space-between;
      font-size: 15px;
    }
    .cost-summary .price {
      color: #2ecc71;
      font-weight: bold;
    }
    .submit-btn {
      background-color: #c0392b;
      color: white;
      border: none;
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 15px;
    }
    .submit-btn:hover {
      background-color: #a93226;
    }
    .menu-card-cliente {
      border-radius: 0;
      overflow: hidden;
      padding: 18px;
      width: 20rem;
      margin: 16px auto;
    }
    .menu-card-cliente img {
      height: 10rem;
      object-fit: cover;
      margin-bottom: 14px;
      border-radius: 8px;
    }
    .menu-card-cliente button {
      font-size: 1.1rem;
      font-weight: normal;
    }
    .menu-card-cliente h6 {
      font-size: 1.4rem;
      margin-top: -0.3rem;
    }
    .menu-card-cliente .allergens {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 8px;
    }
    .menu-card-cliente .allergens img {
      width: 2rem;
      height: 2rem;
    }
    .menu-card-cliente,
    .item-card {
      /* ...otras reglas... */
      transition: transform 0.3s cubic-bezier(.4,2,.6,1), opacity 0.3s cubic-bezier(.4,2,.6,1);
      opacity: 1;
      transform: scale(1);
    }
    .menu-card-cliente.oculto,
    .item-card.oculto {
      opacity: 0;
      transform: scale(0.95);
      pointer-events: none;
    }
    .menu-card-cliente.animar,
    .item-card.animar {
      animation: fadeInScale 0.4s cubic-bezier(.4,2,.6,1);
    }
    @keyframes fadeInScale {
      0% { opacity: 0; transform: scale(0.95);}
      100% { opacity: 1; transform: scale(1);}
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="d-flex flex-row" style="min-height:100vh;">
    <!-- Sidebar izquierdo (pegado a la izquierda) -->
    <div class="sidebar d-flex flex-column" style="flex:0 0 320px;max-width:350px;margin-left:-12px;">
      <div class="sidebar-content">
        <div class="logo">
          <img src="../Assets/Images/La Dolce Vita icon 1.png" alt="Logo pizza" />
          <h2>LA DOLCE VITA</h2>
        </div>
        <hr class="sidebar-hr" />
        <h3 class="sidebar-title">Estado de sus pedidos</h3>
        <div class="order-card">
          <span class="order-label">P1</span>
          <div class="order-info">
            <h4>"Nombre pedido"</h4>
            <small>2 items</small>
          </div>
          <span class="status cocina">En cocina</span>
        </div>
        <div class="order-card">
          <span class="order-label">P2</span>
          <div class="order-info">
            <h4>"Nombre pedido"</h4>
            <small>4 items</small>
          </div>
          <span class="status entregado">Entregado</span>
        </div>
        <div class="order-card">
          <span class="order-label">P3</span>
          <div class="order-info">
            <h4>"Nombre pedido"</h4>
            <small>1 items</small>
          </div>
          <span class="status pendiente">Pendiente</span>
        </div>
        <div class="sidebar-divider-red"></div>
        <div class="sidebar-total">
          <span>Precio Total:</span>
          <span class="price">$XX,X</span>
        </div>
        <div class="payment-methods">
          <div class="payment-method">
            <img src="https://img.icons8.com/ios-filled/50/000000/cash-in-hand.png" alt="Efectivo" />
            <div>Efectivo</div>
          </div>
          <div class="payment-method">
            <img src="https://img.icons8.com/ios-filled/50/000000/bank-card-back-side.png" alt="Tarjeta" />
            <div>Tarjeta</div>
          </div>
          <div class="payment-method">
            <img src="https://img.icons8.com/ios-filled/50/000000/paypal.png" alt="PayPal" />
            <div>PayPal</div>
          </div>
        </div>
        <button class="finalize-btn">Finalizar</button>
        <!-- Fecha actual -->
        <div class="text-center mb-3 sidebar-date">
          <small class="text-muted"><?php echo date('d/m/Y'); ?></small>
        </div>
      </div>
    </div>

    <!-- Contenido principal (ocupa el espacio restante) -->
    <div class="flex-grow-1" style="min-width:0;">
      <!-- Buscador de platos -->
      <div class="px-4 mb-3 mt-5">
        <input type="text" id="buscador-platos" class="form-control form-control-lg" placeholder="Buscar platos...">
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
      <!-- Platos activos -->
      <div id="menu-items" class="row row-cols-1 row-cols-md-3 g-4 px-4">
        <?php
          // Mostrar los platos activos de la primera categoría por defecto
          $cat_id = isset($categorias[0]['id']) ? $categorias[0]['id'] : 1;
          try {
            require('Conexion.php');
            if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
              mysqli_query($conexion, "SET NAMES 'UTF8'");
              $sql = "SELECT * FROM dishes WHERE category_id = $cat_id AND is_active=1";
              $resDishes = mysqli_query($conexion, $sql);
              while ($dish = mysqli_fetch_assoc($resDishes)) {
                // Obtener alérgenos
                $allergens = [];
                $resAll = mysqli_query($conexion, "SELECT a.name FROM dish_allergens da JOIN allergens a ON da.allergen_id = a.id WHERE da.dish_id = " . intval($dish['id']));
                while ($a = mysqli_fetch_assoc($resAll)) {
                  $allergens[] = $a['name'];
                }
                echo '<div class="col">
                        <div class="card menu-card-cliente shadow-sm" data-precio="' . floatval($dish['price']) . '">
                          <img src="' . htmlspecialchars($dish['image_url']) . '" class="card-img-top" alt="' . htmlspecialchars($dish['name']) . '">
                          <div class="card-body text-center">
                            <h6 class="card-title mb-1">' . htmlspecialchars($dish['name']) . '</h6>
                            <div class="allergens" style="gap: 16px;">';
                foreach ($allergens as $al) {
                  $icon = strtolower($al);
                  echo '<img src="../Assets/Images/logos/' . $icon . '.png" alt="' . htmlspecialchars($al) . '" style="width:2.6rem;height:2.6rem;">';
                }
                echo    '</div>
                            <!-- Precio oculto -->
                            <button class="btn btn-success w-100 mt-2">Añadir</button>
                            <button class="btn btn-outline-primary w-100 mt-2">Detalles</button>
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
        // Manejo de clic en categorías y carga dinámica de platos activos
        document.querySelectorAll('.category-item').forEach(function(cat) {
          cat.addEventListener('click', function() {
            document.querySelectorAll('.category-item').forEach(function(c) { c.classList.remove('active'); });
            cat.classList.add('active');
            var catId = cat.getAttribute('data-category-id');
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'obtener_platos_cliente.php?category_id=' + catId, true);
            xhr.onload = function() {
              if (xhr.status === 200) {
                document.getElementById('menu-items').innerHTML = xhr.responseText;
                attachAddButtons();
                animarPlatos();
              }
            };
            xhr.send();
          });
        });

        // Buscador de platos (filtra por nombre de plato)
        document.getElementById('buscador-platos').addEventListener('input', function() {
          var filtro = this.value.toLowerCase();
          document.querySelectorAll('#menu-items .card.menu-card-cliente').forEach(function(card) {
            var nombre = card.querySelector('.card-title').textContent.toLowerCase();
            card.parentElement.style.display = nombre.includes(filtro) ? '' : 'none';
          });
        });

        // Animación de entrada para los platos
        function animarPlatos() {
          document.querySelectorAll('#menu-items .menu-card-cliente').forEach(function(card, i) {
            card.classList.add('oculto');
            setTimeout(function() {
              card.classList.remove('oculto');
              card.classList.add('animar');
              setTimeout(function() {
                card.classList.remove('animar');
              }, 400);
            }, 60 * i);
          });
        }

        // --- FUNCIONALIDAD AÑADIR AL SIDEBAR DERECHO ---
        function attachAddButtons() {
          document.querySelectorAll('.menu-card-cliente .btn-success').forEach(function(btn) {
            btn.onclick = function() {
              var card = btn.closest('.menu-card-cliente');
              var img = card.querySelector('img.card-img-top').src;
              var nombre = card.querySelector('.card-title').textContent;
              var categoria = document.querySelector('.category-item.active span').textContent;
              var priceAttr = card.getAttribute('data-precio');
              var price = 0;
              if (priceAttr) {
                price = parseFloat(priceAttr);
              } else {
                var priceEl = card.querySelector('.price');
                if (priceEl) {
                  var priceText = priceEl.textContent.replace(/[^\d.,]/g, '').replace(',', '.');
                  price = parseFloat(priceText) || 0;
                }
              }
              var sidebar = document.querySelector('.sidebar-right');
              var items = sidebar.querySelectorAll('.item-card');
              var found = false;
              items.forEach(function(item) {
                var t = item.querySelector('.item-title');
                if (t && t.textContent === nombre) {
                  var qtySpan = item.querySelector('.quantity span');
                  qtySpan.textContent = parseInt(qtySpan.textContent) + 1;
                  found = true;
                  // Animación de "bump" al actualizar cantidad
                  item.classList.add('animar');
                  setTimeout(function(){ item.classList.remove('animar'); }, 400);
                }
              });
              if (!found) {
                var div = document.createElement('div');
                div.className = 'item-card oculto';
                div.setAttribute('data-precio', price);
                div.innerHTML = `
                  <img src="${img}" alt="${nombre}" />
                  <div class="item-details">
                    <p class="item-title">${nombre}</p>
                    <p class="item-subtitle">${categoria}</p>
                    <p class="item-price" style="display:none;">${price.toFixed(2)}</p>
                  </div>
                  <div class="quantity">
                    <button class="qty-btn">-</button>
                    <span>1</span>
                    <button class="qty-btn add">+</button>
                  </div>
                `;
                // Insertar antes del divider rojo
                var divider = sidebar.querySelector('.sidebar-divider-red');
                sidebar.insertBefore(div, divider);
                // Añadir funcionalidad a los botones + y -
                attachQtyButtons(div);
                // Animación de entrada
                setTimeout(function() {
                  div.classList.remove('oculto');
                  div.classList.add('animar');
                  setTimeout(function() {
                    div.classList.remove('animar');
                  }, 400);
                }, 30);
              }
              actualizarTotalPedido();
            };
          });
        }

        function attachQtyButtons(context) {
          var minus = context.querySelector('.qty-btn:not(.add)');
          var plus = context.querySelector('.qty-btn.add');
          var qtySpan = context.querySelector('.quantity span');
          minus.onclick = function() {
            var qty = parseInt(qtySpan.textContent);
            if (qty > 1) {
              qtySpan.textContent = qty - 1;
            } else {
              // Eliminar el producto si la cantidad llega a 0
              context.remove();
            }
            actualizarTotalPedido();
          };
          plus.onclick = function() {
            qtySpan.textContent = parseInt(qtySpan.textContent) + 1;
            actualizarTotalPedido();
          };
        }

        // Actualiza el coste total del pedido en el sidebar derecho
        function actualizarTotalPedido() {
          var total = 0;
          document.querySelectorAll('.sidebar-right .item-card').forEach(function(item) {
            var qty = parseInt(item.querySelector('.quantity span').textContent);
            var price = 0;
            // Obtener el precio del producto
            var priceAttr = item.getAttribute('data-precio');
            if (priceAttr) {
              price = parseFloat(priceAttr);
            } else {
              var priceEl = item.querySelector('.item-price');
              if (priceEl) {
                price = parseFloat(priceEl.textContent.replace(',', '.')) || 0;
              }
            }
            total += qty * price;
          });
          var totalEl = document.querySelector('.cost-summary .price');
          if (totalEl) {
            totalEl.textContent = total > 0 ? '€' + total.toFixed(2) : '€0.00';
          }
        }

        // Inicializar eventos al cargar la página
        attachAddButtons();
        document.querySelectorAll('.sidebar-right .item-card').forEach(attachQtyButtons);
        actualizarTotalPedido();
        animarPlatos();
      </script>
    </div>

    <!-- Sidebar derecho (pegado a la derecha) -->
    <div class="sidebar-right d-flex flex-column" style="flex:0 0 320px;max-width:350px;margin-right:-12px;margin-left:auto;">
      <h2><?php echo htmlspecialchars($nombreMesa); ?></h2>
      <hr style="margin: 0 0 10px 0;"> <!-- Línea divisora entre mesa y pedido -->
      <div class="pedido-header">
        <!-- <h3>Nombre del pedido</h3> -->
        <input type="text" class="pedido-input" value="Nombre del pedido" />
        <img src="https://img.icons8.com/ios-glyphs/30/000000/edit.png" alt="Editar" class="edit-icon"/>
      </div>
      <hr />
      
      <div class="sidebar-divider-red"></div>
      <!-- Total y botón -->
      <div class="cost-summary">
        <span>Costo del pedido :</span>
        <span class="price">$XX,X</span>
      </div>
      <button class="submit-btn">Realizar pedido</button>
      <button class="submit-btn" style="background-color:#f1c40f;color:#333;margin-top:10px;">Notificar al camarero</button>
    </div>
    <!-- Fin sidebar derecho -->
  </div>
</div>

</body>
</html>