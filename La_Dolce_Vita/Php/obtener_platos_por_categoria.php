<?php
if (!isset($_GET['category_id'])) {
  exit;
}
$cat_id = intval($_GET['category_id']);
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
?>
