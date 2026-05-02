<?php

require_once '../config/conexion.php';
require_once '../models/Empleado.php'; 

// 2. Detectamos qué acción quiere realizar el usuario
$action = $_GET['action'] ?? '';

if ($action === 'crear') {
    // Capturamos los datos del formulario
    $nombre        = $_POST['nombre'] ?? '';
    $cargo         = $_POST['cargo'] ?? '';
    $salario       = $_POST['salario'] ?? 0;
    $fecha_ingreso = $_POST['fecha_ingreso'] ?? '';


    // Validaciones básicas (Requerimiento del Sprint 1)
    if (empty($nombre) || empty($cargo)  ||  empty($fecha_ingreso)) {
        header("Location: ../views/empleados_crear.php?error=campos_obligatorios");
        exit;
    }

    if (!is_numeric($salario)  || $salario <= 0){
        header("Location: ../views/empleados_crear.php?error=salario_invalido");
        exit;

    }

    $objEmpleado = new Empleado($pdo);

    // 3. Intentamos registrar
    if ($objEmpleado->registrar($nombre, $cargo, $salario, $fecha_ingreso)) {
        // Éxito: Redirigimos a la lista (que haremos luego)
        echo "¡Empleado " . htmlspecialchars($nombre) .  " guardado con éxito!";
    } else {
        echo "Error: fallo técnico en el registro del empleado.";
    }
}