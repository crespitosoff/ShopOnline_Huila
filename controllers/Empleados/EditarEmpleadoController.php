<?php
require_once '../../models/Empleado.php';

$id = $_GET['id'] ?? 0;

if (empty($id)) {
    header("Location: ../../views/empleados_listar.php?error=400");
    exit;
}

$objEmpleado = new Empleado();
$empleado = $objEmpleado->obtenerPorId($id);
$cargos = $objEmpleado->obtenerCargos();

if (!$empleado) {
    header("Location: ../../views/empleados_listar.php?error=404");
    exit;
}

