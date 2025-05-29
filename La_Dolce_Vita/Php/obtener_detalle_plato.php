<?php
if (!isset($_GET['nombre']) || !isset($_GET['categoria'])) {
  http_response_code(400);
  echo json_encode(['error' => 'Faltan parámetros']);
  exit;
}
$nombre = $_GET['nombre'];
$categoria = $_GET['categoria'];
require('Conexion.php');
$result = [
  'nombre' => '',
  'descripcion' => '',
  'imagen' => '',
  'categoria' => '',
  'alergenos' => [],
  'precio' => ''
];
if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
  mysqli_query($conexion, "SET NAMES 'UTF8'");
  // Buscar el plato por nombre y categoría
  $stmt = mysqli_prepare($conexion, "SELECT d.id, d.name, d.description, d.price, d.image_url, c.name as categoria FROM dishes d JOIN categories c ON d.category_id = c.id WHERE d.name = ? AND c.name = ? LIMIT 1");
  mysqli_stmt_bind_param($stmt, "ss", $nombre, $categoria);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);
  if ($row = mysqli_fetch_assoc($res)) {
    $result['nombre'] = $row['name'];
    $result['descripcion'] = $row['description'];
    $result['imagen'] = $row['image_url'];
    $result['categoria'] = $row['categoria'];
    $result['precio'] = $row['price'];
    // Obtener alérgenos
    $dish_id = intval($row['id']);
    $resAll = mysqli_query($conexion, "SELECT a.name FROM dish_allergens da JOIN allergens a ON da.allergen_id = a.id WHERE da.dish_id = $dish_id");
    while ($a = mysqli_fetch_assoc($resAll)) {
      $result['alergenos'][] = $a['name'];
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conexion);
}
header('Content-Type: application/json');
echo json_encode($result);
