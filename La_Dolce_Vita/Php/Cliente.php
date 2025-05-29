<?php
// Nuevo script PHP para procesar la petición AJAX del botón "Finalizar"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalizar_pedidos'])) {
  session_start();
  $mesa = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
  $mesa_num = intval(preg_replace('/\D/', '', $mesa));
  $success = false;
  try {
    require('Conexion.php');
    if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
      mysqli_query($conexion, "SET NAMES 'UTF8'");
      // Buscar id de la mesa
      $resMesa = mysqli_query($conexion, "SELECT id FROM tables WHERE number = $mesa_num LIMIT 1");
      $rowMesa = mysqli_fetch_assoc($resMesa);
      $table_id = $rowMesa ? intval($rowMesa['id']) : 1;
      // Obtener todos los pedidos de la mesa que no estén finalizados (entregados)
      $resPedidos = mysqli_query($conexion, "SELECT * FROM orders WHERE table_id = $table_id");
      while ($pedido = mysqli_fetch_assoc($resPedidos)) {
        $order_id = intval($pedido['id']);
        // Obtener los platos y cantidades de cada pedido
        $resItems = mysqli_query($conexion, "SELECT od.dish_id, od.quantity, d.price FROM order_dishes od JOIN dishes d ON od.dish_id = d.id WHERE od.order_id = $order_id");
        while ($item = mysqli_fetch_assoc($resItems)) {
          $dish_id = intval($item['dish_id']);
          $qty = intval($item['quantity']);
          $price = floatval($item['price']);
          // Insertar en sales
          mysqli_query($conexion, "INSERT INTO sales (table_id, dish_id, quantity, price, sale_date) VALUES ($table_id, $dish_id, $qty, $price, CURDATE())");
        }
        // Eliminar los platos del pedido (por ON DELETE CASCADE, basta con eliminar el pedido)
        // Eliminar el pedido
        mysqli_query($conexion, "DELETE FROM orders WHERE id = $order_id");
      }
      mysqli_close($conexion);
      $success = true;
    }
  } catch (Throwable $e) {
    $success = false;
  }
  header('Content-Type: application/json');
  echo json_encode(['success' => $success]);
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        $mesaAleatoria = "Mesa" . rand(1, 10);
        $_SESSION['usuario'] = strtolower($mesaAleatoria);
    }
    // Insertar un espacio entre el 4º y 5º carácter del nombre de la mesa
    $nombreMesa = isset($_SESSION['usuario']) ? ucfirst(substr($_SESSION['usuario'], 0, 4) . ' ' . substr($_SESSION['usuario'], 4)) : 'Mesa';
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
      /* height: 200vh;  Elimina altura fija */
      padding: 0;
      border-right: 1px solid #ddd;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      min-width: 300px;
      max-width: 150vh;
      display: flex;
      flex-direction: column;
      justify-content: stretch;
      position: sticky;
      top: 0;
      z-index: 100;
      height: 100vh;
      overflow-y: auto;
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
      width: 20rem;
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
      margin-top: -3rem;
      margin-bottom: 2rem;
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
      /* --- transición para animación --- */
      transition: transform 0.3s cubic-bezier(.4,2,.6,1), opacity 0.3s cubic-bezier(.4,2,.6,1);
      opacity: 1;
      transform: scale(1);
      /* Sombra añadida */
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .order-card.oculto {
      opacity: 0;
      transform: scale(0.95);
      pointer-events: none;
    }
    .order-card.animar {
      animation: fadeInScale 0.4s cubic-bezier(.4,2,.6,1);
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
      /* Sombra añadida */
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
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
      box-shadow: 0 4px 12px rgba(0,0,0,0.15); /* Sombra */
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
      position: sticky;
      top: 0;
      z-index: 100;
      display: flex;
      flex-direction: column;
      height: 100vh;
      overflow-y: auto;
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
      /* Sombra añadida */
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
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
      transition: opacity 0.3s cubic-bezier(.4,2,.6,1), transform 0.3s cubic-bezier(.4,2,.6,1);
      opacity: 1;
      transform: scale(1);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15); /* Sombra */
    }
    .submit-btn.oculto {
      opacity: 0;
      transform: scale(0.95);
      pointer-events: none;
    }
    .submit-btn.animar {
      animation: fadeInScale 0.4s cubic-bezier(.4,2,.6,1);
    }
    .menu-card-cliente {
      border-radius: 0;
      overflow: hidden;
      padding: 18px;
      width: 20rem;
      margin: 16px auto;
      /* Sombra añadida */
      box-shadow: 0 4px 12px rgba(0,0,0,0.12);
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
          <img src="../Assets/Images/La Dolce Vita icon.png" alt="Logo pizza" />
        </div>
        <hr class="sidebar-hr" />
        <h3 class="sidebar-title">Estado de sus pedidos</h3>
        <?php
          // Mostrar los pedidos realizados por la mesa actual y calcular el precio total
          $precio_total_pedidos = 0;
          try {
            require('Conexion.php');
            $mesa_num = intval(preg_replace('/\D/', '', $nombreMesa));
            $pedidos = [];
            if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
              mysqli_query($conexion, "SET NAMES 'UTF8'");
              // Buscar id de la mesa
              $resMesa = mysqli_query($conexion, "SELECT id FROM tables WHERE number = $mesa_num LIMIT 1");
              $rowMesa = mysqli_fetch_assoc($resMesa);
              $table_id = $rowMesa ? intval($rowMesa['id']) : 1;
              // Obtener pedidos de la mesa
              $resPedidos = mysqli_query($conexion, "SELECT * FROM orders WHERE table_id = $table_id ORDER BY created_at DESC LIMIT 5");
              while ($pedido = mysqli_fetch_assoc($resPedidos)) {
                // Obtener número de items y calcular el precio de cada pedido
                $resItems = mysqli_query($conexion, "SELECT od.quantity, d.price FROM order_dishes od JOIN dishes d ON od.dish_id = d.id WHERE od.order_id = " . intval($pedido['id']));
                $num_items = 0;
                $precio_pedido = 0;
                while ($rowItem = mysqli_fetch_assoc($resItems)) {
                  $num_items += intval($rowItem['quantity']);
                  $precio_pedido += floatval($rowItem['quantity']) * floatval($rowItem['price']);
                }
                $precio_total_pedidos += $precio_pedido;
                $pedidos[] = [
                  'id' => $pedido['id'],
                  'nombre' => $pedido['name'] ? $pedido['name'] : 'Pedido #' . $pedido['id'],
                  'status' => $pedido['status'],
                  'num_items' => $num_items
                ];
              }
              mysqli_close($conexion);
            }
          } catch (Throwable $e) {
            $pedidos = [];
          }
        ?>
        <?php foreach ($pedidos as $i => $pedido): ?>
          <div class="order-card oculto">
            <span class="order-label">P<?php echo $pedido['id']; ?></span>
            <div class="order-info">
              <h4><?php echo htmlspecialchars($pedido['nombre']); ?></h4>
              <small><?php echo $pedido['num_items']; ?> items</small>
            </div>
            <?php
              $status = strtolower($pedido['status']);
              $status_class = '';
              if ($status === 'en cocina') $status_class = 'cocina';
              elseif ($status === 'entregado') $status_class = 'entregado';
              else $status_class = 'pendiente';
            ?>
            <span class="status <?php echo $status_class; ?>">
              <?php echo ucfirst($pedido['status']); ?>
            </span>
          </div>
        <?php endforeach; ?>
        <div class="sidebar-divider-red"></div>
        <div class="sidebar-total">
          <span>Precio Total:</span>
          <span class="price"><?php echo '€' . number_format($precio_total_pedidos, 2); ?></span>
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
        <button class="finalize-btn" id="btn-finalizar-pedidos">Finalizar</button>
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
        <div class="input-group input-group-lg">
          <input type="text" id="buscador-platos" class="form-control" placeholder="Buscar platos...">
          <span class="input-group-text" style="background:transparent;border-left:0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#888" viewBox="0 0 24 24">
              <path d="M10.5 3a7.5 7.5 0 1 1 0 15 7.5 7.5 0 0 1 0-15zm0 2a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11zm8.03 13.47 2.5 2.5a1 1 0 0 1-1.42 1.42l-2.5-2.5a9 9 0 1 1 1.42-1.42z"/>
            </svg>
          </span>
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
          <?php
            $isActive = ($i === 0);
            $imgBase = strtolower($cat['name']);
            $imgFile = $imgBase . ($isActive ? '_negro' : '') . '.png';
          ?>
          <div class="category-item<?php if ($isActive) echo ' active'; ?>" data-category-id="<?php echo $cat['id']; ?>">
            <img src="../Assets/Images/logos/<?php echo $imgFile; ?>" alt="<?php echo htmlspecialchars($cat['name']); ?>">
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
                          <img src="../Assets/Images/Dishes/' . htmlspecialchars(substr_replace(substr($dish['image_url'], 4), 'png', -3)) . '" class="card-img-top" alt="' . htmlspecialchars($dish['name']) . '">
                          <div class="card-body text-center">
                            <h6 class="card-title mb-1">' . htmlspecialchars($dish['name']) . '</h6>
                            <div class="allergens" style="gap: 16px;">';
                foreach ($allergens as $al) {
                  $icon = strtolower($al);
                  echo '<img src="../Assets/Images/logos/' . $icon . '.png" alt="' . htmlspecialchars($al) . '" style="width:2.6rem;height:2.6rem;">';
                }
                // Línea divisora roja centrada, descripción y precio
                echo    '</div>
                          <hr style="border: none; border-top: 2px solid #c94b4b; width: 60%; margin: 12px auto 8px auto;">
                          <div style="color:#555; font-size:1rem; margin-bottom:4px; min-height:38px;">' . htmlspecialchars($dish['description']) . '</div>
                          <div style="color:#27ae60; font-weight:bold; font-size:1.2rem; margin-bottom:8px;">€' . number_format($dish['price'], 2) . '</div>
                          <button class="btn btn-success w-100 mt-2">Añadir</button>
                        </div>
                      </div>
                    </div>';
              }
              mysqli_close($conexion);
            }
          } catch (Throwable $e) {}
        ?>
      </div>

      <!-- Modal de detalles del plato -->
      <div class="modal fade" id="detallePlatoModal" tabindex="-1" aria-labelledby="detallePlatoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="border-radius:16px;">
            <div class="modal-header" style="border-bottom:1px solid #eee;">
              <h5 class="modal-title" id="detallePlatoLabel"></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
              <img id="detallePlatoImg" src="" alt="" style="width:220px;height:160px;object-fit:cover;border-radius:10px;margin-bottom:12px;">
              <div id="detallePlatoCategoria" style="font-size:1.1rem;color:#c0392b;font-weight:bold;margin-bottom:8px;"></div>
              <div id="detallePlatoAlergenos" style="margin-bottom:10px;display:flex;justify-content:center;gap:10px;"></div>
              <div id="detallePlatoDesc" style="margin-bottom:10px;color:#555;"></div>
              <div id="detallePlatoPrecio" style="font-size:1.3rem;color:#27ae60;font-weight:bold;"></div>
            </div>
          </div>
        </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
      <script>
        // Manejo de clic en categorías y carga dinámica de platos activos
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
            xhr.open('GET', 'obtener_platos_cliente.php?category_id=' + catId, true);
            xhr.onload = function() {
              if (xhr.status === 200) {
                document.getElementById('menu-items').innerHTML = xhr.responseText;
                afterMenuItemsUpdate();
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

        // Animar la aparición de los pedidos en el sidebar izquierdo
        function animarPedidosSidebar() {
          var cards = document.querySelectorAll('.sidebar .order-card');
          cards.forEach(function(card, i) {
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

        // --- REGISTRAR PEDIDO ---
        function registrarPedidoHandler() {
          // Recopilar productos del sidebar derecho
          var productos = [];
          document.querySelectorAll('.sidebar-right .item-card').forEach(function(item) {
            productos.push({
              nombre: item.querySelector('.item-title').textContent,
              cantidad: parseInt(item.querySelector('.quantity span').textContent),
              precio: parseFloat(item.getAttribute('data-precio')) || 0
            });
          });
          if (productos.length === 0) {
            alert('Añade al menos un producto antes de realizar el pedido.');
            return;
          }
          // Recoger nombre del pedido
          var nombrePedido = document.querySelector('.pedido-input').value || '';
          // Recoger mesa (usuario de sesión)
          var mesa = "<?php echo htmlspecialchars($nombreMesa); ?>";
          // Enviar por AJAX
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'registrar_pedido.php', true);
          xhr.setRequestHeader('Content-Type', 'application/json');
          xhr.onload = function() {
            if (xhr.status === 200) {
              try {
                var res = JSON.parse(xhr.responseText);
                if (res.success) {
                  alert('Pedido realizado correctamente');
                  // Limpiar productos del sidebar derecho
                  document.querySelectorAll('.sidebar-right .item-card').forEach(function(item){ item.remove(); });
                  actualizarTotalPedido();
                  location.reload(); // Recargar la página para actualizar el estado de los pedidos
                } else {
                  alert('Error al registrar el pedido');
                }
              } catch(e) {
                alert('Pedido realizado correctamente');
                document.querySelectorAll('.sidebar-right .item-card').forEach(function(item){ item.remove(); });
                actualizarTotalPedido();
                location.reload(); // Recargar la página para actualizar el estado de los pedidos
              }
            } else {
              alert('Error de conexión');
            }
          };
          xhr.send(JSON.stringify({
            mesa: mesa,
            nombre_pedido: nombrePedido,
            productos: productos
          }));
        }

        // MODAL DETALLE PLATO
        function attachDetalleButtons() {
          document.querySelectorAll('.menu-card-cliente .btn-outline-primary').forEach(function(btn) {
            btn.onclick = function() {
              var card = btn.closest('.menu-card-cliente');
              var nombre = card.querySelector('.card-title').textContent;
              var categoria = document.querySelector('.category-item.active span').textContent;
              var xhr = new XMLHttpRequest();
              xhr.open('GET', 'obtener_detalle_plato.php?nombre=' + encodeURIComponent(nombre) + '&categoria=' + encodeURIComponent(categoria), true);
              xhr.onload = function() {
                if (xhr.status === 200) {
                  try {
                    var data = JSON.parse(xhr.responseText);
                    var precio = data.precio ? '€' + parseFloat(data.precio).toFixed(2) : 'Sin precio';
                    var descripcion = data.descripcion || 'Sin descripción';
                    alert('Precio: ' + precio + '\nDescripción: ' + descripcion);
                  } catch(e) {
                    alert('No se pudo cargar el detalle del plato.');
                  }
                } else {
                  alert('No se pudo cargar el detalle del plato.');
                }
              };
              xhr.send();
            };
          });
        }

        // Llamar después de cargar platos dinámicamente
        function afterMenuItemsUpdate() {
          attachAddButtons();
          attachDetalleButtons();
          animarPlatos();
        }

        // Inicializar eventos al cargar la página
        attachAddButtons();
        attachDetalleButtons();
        document.querySelectorAll('.sidebar-right .item-card').forEach(attachQtyButtons);
        actualizarTotalPedido();
        animarPlatos();
        animarPedidosSidebar();

        // Mostrar botón de confirmación antes de enviar el pedido con transición
        document.getElementById('btn-realizar-pedido').addEventListener('click', function() {
          var btnRealizar = this;
          var btnConfirmar = document.getElementById('btn-confirmar-pedido');
          // Ocultar con transición
          btnRealizar.classList.add('oculto');
          setTimeout(function() {
            btnRealizar.style.display = 'none';
            btnConfirmar.style.display = '';
            btnConfirmar.classList.add('oculto');
            // Forzar reflow para que la animación se aplique correctamente
            void btnConfirmar.offsetWidth;
            btnConfirmar.classList.remove('oculto');
            btnConfirmar.classList.add('animar');
            setTimeout(function() {
              btnConfirmar.classList.remove('animar');
            }, 400);
          }, 300);
        });

        document.getElementById('btn-confirmar-pedido').addEventListener('click', registrarPedidoHandler);

        // Evento para finalizar y registrar ganancias
        document.getElementById('btn-finalizar-pedidos').addEventListener('click', function() {
          // Primera confirmación
          if (!confirm('¿Desea finalizar y registrar las ganancias de todos los pedidos de esta mesa?')) return;
          // Segunda confirmación
          if (!confirm('¿Está seguro? Esta acción eliminará todos los pedidos de la mesa.')) return;
          var btn = this;
          btn.disabled = true;
          btn.textContent = 'Procesando...';
          var xhr = new XMLHttpRequest();
          xhr.open('POST', '', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
            btn.disabled = false;
            btn.textContent = 'Finalizar';
            // Recargar la página siempre tras la petición
            location.reload();
          };
          xhr.send('finalizar_pedidos=1');
        });

        // --- NOTIFICAR AL CAMARERO ---
        document.querySelector('.sidebar-right .submit-btn[style*="background-color:#f1c40f"]').addEventListener('click', function() {
          var mesa = "<?php echo htmlspecialchars($nombreMesa); ?>";
          var xhr = new XMLHttpRequest();
          xhr.open('POST', '', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
            if (xhr.status === 200) {
              try {
                var res = JSON.parse(xhr.responseText);
                if (res.notificacion_enviada) {
                  alert('Notificación enviada al camarero.');
                } else {
                  alert('No se pudo enviar la notificación.');
                }
              } catch(e) {
                alert('Notificación enviada al camarero.');
              }
            } else {
              alert('Error de conexión.');
            }
          };
          xhr.send('notificar_camarero=1&mesa=' + encodeURIComponent(mesa));
        });

        // --- NUEVO: Enviar nota al camarero ---
        document.getElementById('btn-enviar-nota').addEventListener('click', function() {
          var nota = document.getElementById('nota-camarero').value.trim();
          var msg = document.getElementById('nota-msg');
          if (!nota) {
            msg.textContent = 'Por favor, escriba una nota antes de enviar.';
            msg.style.color = '#e74c3c';
            return;
          }
          this.disabled = true;
          msg.textContent = 'Enviando...';
          msg.style.color = '#333';
          var xhr = new XMLHttpRequest();
          xhr.open('POST', '', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
            document.getElementById('btn-enviar-nota').disabled = false;
            try {
              var res = JSON.parse(xhr.responseText);
              if (res.nota_enviada) {
                msg.textContent = 'Nota enviada al camarero.';
                msg.style.color = '#27ae60';
                document.getElementById('nota-camarero').value = '';
              } else {
                msg.textContent = 'No se pudo enviar la nota.';
                msg.style.color = '#e74c3c';
              }
            } catch(e) {
              msg.textContent = 'Nota enviada al camarero.';
              msg.style.color = '#27ae60';
              document.getElementById('nota-camarero').value = '';
            }
          };
          xhr.onerror = function() {
            document.getElementById('btn-enviar-nota').disabled = false;
            msg.textContent = 'Error de conexión.';
            msg.style.color = '#e74c3c';
          };
          xhr.send('enviar_nota_camarero=1&nota=' + encodeURIComponent(nota));
        });
      </script>

      <?php
      // --- NUEVO: Procesar notificación al camarero ---
      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notificar_camarero'])) {
        session_start();
        $mesa = isset($_POST['mesa']) ? $_POST['mesa'] : (isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '');
        $mesa_num = intval(preg_replace('/\D/', '', $mesa));
        $notificacion_enviada = false;
        try {
          require('Conexion.php');
          if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
            mysqli_query($conexion, "SET NAMES 'UTF8'");
            // Buscar id de la mesa
            $resMesa = mysqli_query($conexion, "SELECT id FROM tables WHERE number = $mesa_num LIMIT 1");
            $rowMesa = mysqli_fetch_assoc($resMesa);
            $table_id = $rowMesa ? intval($rowMesa['id']) : 1;
            $mensaje = "Mesa $mesa_num solicita atención del camarero";
            $stmt = mysqli_prepare($conexion, "INSERT INTO notifications (message, mesa_id) VALUES (?, ?)");
            mysqli_stmt_bind_param($stmt, "si", $mensaje, $table_id);
            $notificacion_enviada = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($conexion);
          }
        } catch (Throwable $e) {
          $notificacion_enviada = false;
        }
        header('Content-Type: application/json');
        echo json_encode(['notificacion_enviada' => $notificacion_enviada]);
        exit;
      }
      ?>
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
      
      <!-- Separador rojo entre nota y productos -->
      <div class="sidebar-divider-red"></div>
      <!-- Productos añadidos y resto del sidebar derecho -->
      <!-- Total y botón -->

      <!-- NUEVO: Campo de nota para el camarero -->
      <div style="margin-bottom:12px;">
        <label for="nota-camarero" style="font-weight:bold;font-size:15px;">Nota para el camarero:</label>
        <textarea id="nota-camarero" class="form-control" rows="2" maxlength="200" placeholder="Ej: Sin sal, alérgico a frutos secos..."></textarea>
        <button id="btn-enviar-nota" class="btn btn-warning w-100 mt-2" style="color:#333;">Enviar nota</button>
        
        <div id="nota-msg" style="font-size:13px;margin-top:6px;"></div>
        <hr />
      </div>
      <div class="cost-summary" style="margin-top:-1rem;">
        <span>Costo del pedido :</span>
        <span class="price">$XX,X</span>
      </div>
      <button class="submit-btn" id="btn-realizar-pedido">Realizar pedido</button>
      <button class="submit-btn" id="btn-confirmar-pedido" style="display:none;background-color:#27ae60;">Confirmar pedido</button>
      <button class="submit-btn" style="background-color:#f1c40f;color:#333;margin-top:10px;">Notificar al camarero</button>
    </div>
    <!-- Fin sidebar derecho -->
  </div>
</div>

<script>
  // Inicializar eventos al cargar la página
  attachAddButtons();
  attachDetalleButtons();
  document.querySelectorAll('.sidebar-right .item-card').forEach(attachQtyButtons);
  actualizarTotalPedido();
  animarPlatos();
  animarPedidosSidebar();

  // Mostrar botón de confirmación antes de enviar el pedido con transición
  document.getElementById('btn-realizar-pedido').addEventListener('click', function() {
    var btnRealizar = this;
    var btnConfirmar = document.getElementById('btn-confirmar-pedido');
    // Ocultar con transición
    btnRealizar.classList.add('oculto');
    setTimeout(function() {
      btnRealizar.style.display = 'none';
      btnConfirmar.style.display = '';
      btnConfirmar.classList.add('oculto');
      // Forzar reflow para que la animación se aplique correctamente
      void btnConfirmar.offsetWidth;
      btnConfirmar.classList.remove('oculto');
      btnConfirmar.classList.add('animar');
      setTimeout(function() {
        btnConfirmar.classList.remove('animar');
      }, 400);
    }, 300);
  });

  document.getElementById('btn-confirmar-pedido').addEventListener('click', registrarPedidoHandler);

  // Evento para finalizar y registrar ganancias
  document.getElementById('btn-finalizar-pedidos').addEventListener('click', function() {
    // Primera confirmación
    if (!confirm('¿Desea finalizar y registrar las ganancias de todos los pedidos de esta mesa?')) return;
    // Segunda confirmación
    if (!confirm('¿Está seguro? Esta acción eliminará todos los pedidos de la mesa.')) return;
    var btn = this;
    btn.disabled = true;
    btn.textContent = 'Procesando...';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      btn.disabled = false;
      btn.textContent = 'Finalizar';
      // Recargar la página siempre tras la petición
      location.reload();
    };
    xhr.send('finalizar_pedidos=1');
  });

  // --- NOTIFICAR AL CAMARERO ---
  document.querySelector('.sidebar-right .submit-btn[style*="background-color:#f1c40f"]').addEventListener('click', function() {
    var mesa = "<?php echo htmlspecialchars($nombreMesa); ?>";
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      if (xhr.status === 200) {
        try {
          var res = JSON.parse(xhr.responseText);
          if (res.notificacion_enviada) {
            alert('Notificación enviada al camarero.');
          } else {
            alert('No se pudo enviar la notificación.');
          }
        } catch(e) {
          alert('Notificación enviada al camarero.');
        }
      } else {
        alert('Error de conexión.');
      }
    };
    xhr.send('notificar_camarero=1&mesa=' + encodeURIComponent(mesa));
  });

  // --- NUEVO: Enviar nota al camarero ---
  document.getElementById('btn-enviar-nota').addEventListener('click', function() {
    var nota = document.getElementById('nota-camarero').value.trim();
    var msg = document.getElementById('nota-msg');
    if (!nota) {
      msg.textContent = 'Por favor, escriba una nota antes de enviar.';
      msg.style.color = '#e74c3c';
      return;
    }
    this.disabled = true;
    msg.textContent = 'Enviando...';
    msg.style.color = '#333';
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
      document.getElementById('btn-enviar-nota').disabled = false;
      try {
        var res = JSON.parse(xhr.responseText);
        if (res.nota_enviada) {
          msg.textContent = 'Nota enviada al camarero.';
          msg.style.color = '#27ae60';
          document.getElementById('nota-camarero').value = '';
        } else {
          msg.textContent = 'No se pudo enviar la nota.';
          msg.style.color = '#e74c3c';
        }
      } catch(e) {
        msg.textContent = 'Nota enviada al camarero.';
        msg.style.color = '#27ae60';
        document.getElementById('nota-camarero').value = '';
      }
    };
    xhr.onerror = function() {
      document.getElementById('btn-enviar-nota').disabled = false;
      msg.textContent = 'Error de conexión.';
      msg.style.color = '#e74c3c';
    };
    xhr.send('enviar_nota_camarero=1&nota=' + encodeURIComponent(nota));
  });
</script>

<?php
// --- NUEVO: Procesar notificación al camarero ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notificar_camarero'])) {
  session_start();
  $mesa = isset($_POST['mesa']) ? $_POST['mesa'] : (isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '');
  $mesa_num = intval(preg_replace('/\D/', '', $mesa));
  $notificacion_enviada = false;
  try {
    require('Conexion.php');
    if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
      mysqli_query($conexion, "SET NAMES 'UTF8'");
      // Buscar id de la mesa
      $resMesa = mysqli_query($conexion, "SELECT id FROM tables WHERE number = $mesa_num LIMIT 1");
      $rowMesa = mysqli_fetch_assoc($resMesa);
      $table_id = $rowMesa ? intval($rowMesa['id']) : 1;
      $mensaje = "Mesa $mesa_num solicita atención del camarero";
      $stmt = mysqli_prepare($conexion, "INSERT INTO notifications (message, mesa_id) VALUES (?, ?)");
      mysqli_stmt_bind_param($stmt, "si", $mensaje, $table_id);
      $notificacion_enviada = mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
      mysqli_close($conexion);
    }
  } catch (Throwable $e) {
    $notificacion_enviada = false;
  }
  header('Content-Type: application/json');
  echo json_encode(['notificacion_enviada' => $notificacion_enviada]);
  exit;
}

// --- NUEVO: Procesar nota para el camarero ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_nota_camarero'])) {
  session_start();
  $mesa = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : '';
  $mesa_num = intval(preg_replace('/\D/', '', $mesa));
  $nota = isset($_POST['nota']) ? trim($_POST['nota']) : '';
  $nota_enviada = false;
  if ($nota !== '') {
    try {
      require('Conexion.php');
      if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
        mysqli_query($conexion, "SET NAMES 'UTF8'");
        // Buscar id de la mesa
        $resMesa = mysqli_query($conexion, "SELECT id FROM tables WHERE number = $mesa_num LIMIT 1");
        $rowMesa = mysqli_fetch_assoc($resMesa);
        $table_id = $rowMesa ? intval($rowMesa['id']) : 1;
        $mensaje = "Nota de la mesa $mesa_num: $nota";
        $stmt = mysqli_prepare($conexion, "INSERT INTO notifications (message, mesa_id) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "si", $mensaje, $table_id);
        $nota_enviada = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
      }
    } catch (Throwable $e) {
      $nota_enviada = false;
    }
  }
  header('Content-Type: application/json');
  echo json_encode(['nota_enviada' => $nota_enviada]);
  exit;
}


?>
</body>
</html>