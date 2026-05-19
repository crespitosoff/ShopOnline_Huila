<?php
require_once __DIR__ . '/../../models/Cliente.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_cliente'] ?? 0;
    $primer_nombre = trim($_POST['primer_nombre'] ?? '');
    $segundo_nombre = trim($_POST['segundo_nombre'] ?? '');
    $primer_apellido = trim($_POST['primer_apellido'] ?? '');
    $segundo_apellido = trim($_POST['segundo_apellido'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    if (empty($id) || empty($primer_nombre) || empty($primer_apellido) || empty($email) || empty($telefono)) {
header("Location: /ShopOnline_Huila/views/clientes/editar.php?id=$id&error=campos_obligatorios");
        exit;
    }

    $objCliente = new Cliente();
    if ($objCliente->actualizar($id, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $email, $telefono)) {
header("Location: /ShopOnline_Huila/views/clientes/?success=update");
    } else {
header("Location: /ShopOnline_Huila/views/clientes/editar.php?id=$id&error=fallo_update");
    }
    exit;
}