<?php
require_once __DIR__ . '/../../models/Empleado.php';

$id = $_POST['id'] ?? 0;

if (empty($id)) {
    http_response_code(400);
    header("Location: /ShopOnline_Huila/views/empleados/?error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->eliminar($id)) {
    http_response_code(200);
    header("Location: /ShopOnline_Huila/views/empleados/?success=delete");
} else {
    http_response_code(500);
    header("Location: /ShopOnline_Huila/views/empleados/?error=500");
}
exit;
