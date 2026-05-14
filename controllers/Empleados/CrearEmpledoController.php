<?php
require_once '../../models/Empleado.php';

$id_cargo = $_POST['id_cargo'] ?? '';
$nombre = trim($_POST['nombre'] ?? '');
$salario = (float) ($_POST['salario'] ?? 0);
$fecha_ingreso = trim($_POST['fecha_ingreso'] ?? '');


// Validaciones básicas (Requerimiento del Sprint 1)
if (empty($nombre) || empty($id_cargo) || empty($fecha_ingreso)) {
    http_response_code(400);
    header("Location: ../views/empleados_crear.php?error=campos_obligatorios");
    exit;
}

if (!is_numeric($salario) || $salario <= 0) {
    http_response_code(400);
    header("Location: ../views/empleados_crear.php?error=salario_invalido");
    exit;

}

$objEmpleado = new Empleado();

// 3. Intentamos registrar
if ($objEmpleado->registrar($nombre, $id_cargo, $salario, $fecha_ingreso)) {
    // Éxito: Redirigimos a la lista (que haremos luego)
    http_response_code(201);
    header("Location: ../views/empleados_listar.php?success=1");
    exit;
} else {
    http_response_code(500);
    header("Location: ../views/empleados_crear.php?error=error_tecnico");
    exit;
}
