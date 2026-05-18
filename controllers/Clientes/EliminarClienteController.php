<?php
require_once __DIR__ . '/../../models/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;

    if (empty($id)) {
        http_response_code(400);
        header("Location: ../../views/clientes_listar.php?error=400");
        exit;
    }

    $objCliente = new Cliente();

    if ($objCliente->eliminar($id)) {
        http_response_code(200);
        header("Location: ../../views/clientes_listar.php?success=Eliminado");
    } else {
        http_response_code(500);
        header("Location: ../../views/clientes_listar.php?error=no_se_pudo_eliminar");
    }
    exit;
}