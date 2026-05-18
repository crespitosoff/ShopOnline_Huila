<?php
require_once '../../models/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;

    if (empty($id)) {
        header("Location: ../../views/clientes_listar.php?error=400");
        exit;
    }

    $objCliente = new Cliente();

    if ($objCliente->eliminar($id)) {
        header("Location: ../../views/clientes_listar.php?success=Eliminado");
    } else {
        header("Location: ../../views/clientes_listar.php?error=no_se_pudo_eliminar");
    }
    exit;
}