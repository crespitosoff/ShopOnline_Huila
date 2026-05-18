<?php
require_once __DIR__ . '/../../models/Cliente.php';

$id = $_GET['id'] ?? 0;

if (empty($id)) {
header("Location: /ShopOnline_Huila/views/clientes/?error=id_requerido");
    exit;
}

$objCliente = new Cliente();
$cliente = $objCliente->obtenerPorId($id);

if (!$cliente) {
header("Location: /ShopOnline_Huila/views/clientes/?error=no_encontrado");
    exit;
}
