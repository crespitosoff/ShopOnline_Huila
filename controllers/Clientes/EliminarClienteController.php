<?php
require_once __DIR__ . '/../../models/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;

    if (empty($id)) {
header("Location: /ShopOnline_Huila/views/clientes/?error=400");
        exit;
    }

    $objCliente = new Cliente();

    if ($objCliente->eliminar($id)) {
header("Location: /ShopOnline_Huila/views/clientes/?success=Eliminado");
    } else {
header("Location: /ShopOnline_Huila/views/clientes/?error=no_se_pudo_eliminar");
    }
    exit;
}