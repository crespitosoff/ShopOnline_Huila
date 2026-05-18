<?php
require_once __DIR__ . '/../../models/Cliente.php';

$objCliente = new Cliente();
$clientes = $objCliente->obtenerTodos();

if ($clientes === false) {
    http_response_code(500);
    $_error = "Error al cargar clientes desde la base de datos";
    $clientes = [];
} else {
    http_response_code(200);
}

// ✅ Backend pasa control a la vista con los datos disponibles
require_once '../../views/clientes_listar.php';
?>
