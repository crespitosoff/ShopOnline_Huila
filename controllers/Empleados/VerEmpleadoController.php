<?php
require_once '../../models/Empleado.php';

$id = $_GET['id'] ?? 0;

if (empty($id)) {
    header("Location: ../../views/empleados_listar.php?error=id_requerido");
    exit;
}

$objEmpleado = new Empleado();
$empleado = $objEmpleado->obtenerPorId($id);

if (!$empleado) {
    header("Location: ../../views/empleados_listar.php?error=no_encontrado");
    exit;
}
