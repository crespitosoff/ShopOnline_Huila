<?php
// 1. Ajustamos la ruta al modelo (retrocedemos dos carpetas)
require_once '../../models/Cliente.php';

// Opcional pero recomendado: asegurar que solo se acceda por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');

    // Validaciones básicas
    if (empty($nombre) || empty($email) || empty($telefono)) {
        header("Location: ../../views/clientes/form.php?error=campos_obligatorios");
        exit;
    }

    $objCliente = new Cliente();

    if ($objCliente->registrar($nombre, $email, $telefono)) {
        header("Location: ../../views/clientes/index.php?success=1");
        exit;
    } else {
        header("Location: ../../views/clientes/form.php?error=error_tecnico");
        exit;
    }
}