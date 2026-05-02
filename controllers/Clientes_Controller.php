<?php

require_once '../config/conexion.php';
require_once '../models/Cliente.php'; 

// 2. Detectamos qué acción quiere realizar el usuario
$action = $_GET['action'] ?? '';

if ($action === 'crear') {
    // Capturamos los datos del formulario
    $nombre   = $_POST['nombre'] ?? '';
    $email    = $_POST['email'] ?? '';
    $telefono = $_POST['telefono'] ?? '';

    // Validaciones básicas (Requerimiento del Sprint 1)
    if (empty($nombre) || empty($email)) {
        header("Location: ../views/clientes_crear.php?error=campos_vacios");
        exit;
    }

    $objCliente = new Cliente($pdo);

    // 3. Intentamos registrar
    if ($objCliente->registrar($nombre, $email, $telefono)) {
        // Éxito: Redirigimos a la lista (que haremos luego)
        echo "¡Cliente guardado con éxito!";
    } else {
        echo "Error: El correo ya está registrado o hubo un fallo técnico.";
    }
}