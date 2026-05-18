<?php
require_once __DIR__ . '/../../models/Empleado.php';

$id = $_POST['id'] ?? 0;

if (empty($id)) {
header("Location: /ShopOnline_Huila/views/empleados/?error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->eliminar($id)) {
header("Location: /ShopOnline_Huila/views/empleados/?success=delete");
} else {
header("Location: /ShopOnline_Huila/views/empleados/?error=500");
}
exit;
