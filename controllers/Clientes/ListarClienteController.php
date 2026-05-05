<?php
require_once '../../models/Cliente.php';

$objCliente = new Cliente();
$clientes = $objCliente->obtenerTodos();

if ($clientes === false) {
    http_response_code(500);
    $clientes = [];
} else {
    http_response_code(200);
}
// esto se debe continuar en views