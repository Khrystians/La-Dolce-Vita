<?php
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!$data || !isset($data['mesa']) || !isset($data['productos']) || !is_array($data['productos'])) {
    echo json_encode(['success' => false, 'error' => 'Datos incompletos']);
    exit;
}

require('Conexion.php');
$mesa = $data['mesa'];
$nombre_pedido = isset($data['nombre_pedido']) ? $data['nombre_pedido'] : '';
$productos = $data['productos'];

try {
    $conexion = mysqli_connect($servidor, $usuario, $password, $bbdd);
    if (!$conexion) throw new Exception('No se pudo conectar a la base de datos');

    mysqli_query($conexion, "SET NAMES 'UTF8'");

    // Buscar el id de la mesa
    $mesa_num = intval(preg_replace('/\D/', '', $mesa));
    $resMesa = mysqli_query($conexion, "SELECT id FROM tables WHERE number = $mesa_num LIMIT 1");
    $rowMesa = mysqli_fetch_assoc($resMesa);
    $table_id = $rowMesa ? intval($rowMesa['id']) : 1;

    // Insertar pedido
    $stmt = mysqli_prepare($conexion, "INSERT INTO orders (table_id, name, status) VALUES (?, ?, 'pendiente')");
    mysqli_stmt_bind_param($stmt, "is", $table_id, $nombre_pedido);
    mysqli_stmt_execute($stmt);
    $order_id = mysqli_insert_id($conexion);
    mysqli_stmt_close($stmt);

    // Insertar productos
    foreach ($productos as $prod) {
        $nombre = mysqli_real_escape_string($conexion, $prod['nombre']);
        $cantidad = intval($prod['cantidad']);
        // Buscar el id del plato por nombre
        $resPlato = mysqli_query($conexion, "SELECT id FROM dishes WHERE name = '$nombre' LIMIT 1");
        $rowPlato = mysqli_fetch_assoc($resPlato);
        if ($rowPlato) {
            $dish_id = intval($rowPlato['id']);
            $stmt2 = mysqli_prepare($conexion, "INSERT INTO order_dishes (order_id, dish_id, quantity) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt2, "iii", $order_id, $dish_id, $cantidad);
            mysqli_stmt_execute($stmt2);
            mysqli_stmt_close($stmt2);
        }
    }

    mysqli_close($conexion);
    echo json_encode(['success' => true]);
} catch (Throwable $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
