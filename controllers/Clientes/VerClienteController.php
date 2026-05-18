<?php
require_once '../../models/Cliente.php';

$id = $_GET['id'] ?? 0;

if (empty($id)) {
    header("Location: ../../views/clientes_listar.php?error=id_requerido");
    exit;
}

$objCliente = new Cliente();
$cliente = $objCliente->obtenerPorId($id);

if (!$cliente) {
    header("Location: ../../views/clientes_listar.php?error=no_encontrado");
    exit;
}

http_response_code(200);