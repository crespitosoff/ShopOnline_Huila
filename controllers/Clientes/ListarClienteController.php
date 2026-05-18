<?php
require_once '../../models/Cliente.php';

$objCliente = new Cliente();
$clientes = $objCliente->obtenerTodos();

if ($clientes === false) {
    $_error = "Error al cargar clientes desde la base de datos";
    $clientes = [];
}

// ✅ Backend pasa control a la vista con los datos disponibles
require_once '../../views/clientes/index.php';
?>
