<?php
require_once '../../models/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_cliente'] ?? 0;
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    if (empty($id) || empty($nombre) || empty($email) || empty($telefono)) {
        header("Location: /ShopOnline_Huila/views/clientes/form.php?id=$id&error=campos_obligatorios");
        exit;
    }

    $objCliente = new Cliente();
    if ($objCliente->actualizar($id, $nombre, $email, $telefono)) {
        header("Location: /ShopOnline_Huila/views/clientes/index.php?success=update");
    } else {
        header("Location: /ShopOnline_Huila/views/clientes/form.php?id=$id&error=fallo_update");
    }
    exit;
}
