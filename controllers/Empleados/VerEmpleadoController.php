<?php
require_once __DIR__ . '/../../models/Empleado.php';

$id = $_GET['id'] ?? 0;

if (empty($id)) {
header("Location: /ShopOnline_Huila/views/empleados/?error=id_requerido");
    exit;
}

$objEmpleado = new Empleado();
$empleado = $objEmpleado->obtenerPorId($id);

if (!$empleado) {
header("Location: /ShopOnline_Huila/views/empleados/?error=no_encontrado");
    exit;
}
