<?php
require_once __DIR__ . '/../../models/Empleado.php';

$id = $_GET['id'] ?? 0;

if (empty($id)) {
header("Location: /ShopOnline_Huila/views/empleados/?error=400");
    exit;
}

$objEmpleado = new Empleado();
$empleado = $objEmpleado->obtenerPorId($id);
$cargos = $objEmpleado->obtenerCargos();

if (!$empleado) {
header("Location: /ShopOnline_Huila/views/empleados/?error=404");
    exit;
}
