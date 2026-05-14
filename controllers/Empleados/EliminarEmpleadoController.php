<?php
require_once '../../models/Empleado.php';

$id = $_POST['id'] ?? 0;

if (empty($id)) {
    http_response_code(400);
    header("Location: ../../views/empleados_listar.php?error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->eliminar($id)) {
    http_response_code(200);
    header("Location: ../../views/empleados_listar.php?success=delete");
} else {
    http_response_code(500);
    header("Location: ../../views/empleados_listar.php?error=500");
}
exit;
