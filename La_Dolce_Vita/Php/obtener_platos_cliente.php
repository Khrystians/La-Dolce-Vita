<?php
if (!isset($_GET['category_id'])) {
  exit;
}
$cat_id = intval($_GET['category_id']);
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
?>
