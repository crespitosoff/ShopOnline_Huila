<?php
require_once '../../models/Cliente.php';

$id = $_GET['id'] ?? 0;

if (empty($id)) {
    http_response_code(400);
    header("Location: ../../views/clientes_listar.php?error=400");
    exit;
}

$objCliente = new Cliente();
$cliente = $objCliente->obtenerPorId($id);

if (!$cliente) {
    http_response_code(404);
    header("Location: ../../views/clientes_listar.php?error=no_encontrado");
    exit;
}

http_response_code(200);