<?php
require_once '../../models/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_cliente'] ?? 0;
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    if (empty($id) || empty($nombre) || empty($email) || empty($telefono)) {
        http_response_code(400);
        header("Location: ../../views/clientes_editar.php?id=$id&error=campos_obligatorios");
        exit;
    }

    $objCliente = new Cliente();
    if ($objCliente->actualizar($id, $nombre, $email, $telefono)) {
        http_response_code(200);
        header("Location: ../../views/clientes_listar.php?success=update");
    } else {
        http_response_code(500);
        header("Location: ../../views/clientes_editar.php?id=$id&error=fallo_update");
    }
    exit;
}