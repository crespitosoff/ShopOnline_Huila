<?php
require_once '../../models/Empleado.php';

$id = $_GET['id'] ?? 0;

if (empty($id)) {
    header("Location: ../../views/empleados/index.php?error=id_requerido");
    exit;
}

$objEmpleado = new Empleado();
$empleado = $objEmpleado->obtenerPorId($id);

if (!$empleado) {
    http_response_code(404);
    header("Location: ../../views/empleados/index.php?error=no_encontrado");
    exit;
}
