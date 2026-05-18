<?php
// 1. Ajustamos la ruta al modelo (retrocedemos dos carpetas)
require_once __DIR__ . '/../../models/Cliente.php';

// Opcional pero recomendado: asegurar que solo se acceda por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $telefono = trim($_POST['telefono'] ?? '');

    // Validaciones básicas
    if (empty($nombre) || empty($email) || empty($telefono) || empty($password)) {
// 2. Ajustamos la ruta de redirección a la vista
        header("Location: /ShopOnline_Huila/views/clientes/?error=campos_obligatorios");
        exit;
    }

    $objCliente = new Cliente();

    if ($objCliente->registrar($nombre, $email, $password, $telefono)) {
header("Location: /ShopOnline_Huila/views/clientes/?success=1");
        exit; // Siempre pon exit después de un header Location
    } else {
header("Location: /ShopOnline_Huila/views/clientes/?error=error_tecnico");
        exit;
    }
}