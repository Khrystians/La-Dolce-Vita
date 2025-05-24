<?php
if (!isset($_POST['dish_id']) || !isset($_POST['is_active'])) {
  http_response_code(400);
  exit('Parámetros faltantes');
}
$dish_id = intval($_POST['dish_id']);
$is_active = intval($_POST['is_active']);

require('Conexion.php');
if ($conexion = mysqli_connect($servidor, $usuario, $password, $bbdd)) {
  mysqli_query($conexion, "SET NAMES 'UTF8'");
  $sql = "UPDATE dishes SET is_active = $is_active WHERE id = $dish_id";
  mysqli_query($conexion, $sql);
  mysqli_close($conexion);
  echo 'ok';
} else {
  http_response_code(500);
  exit('Error de conexión');
}
?>
