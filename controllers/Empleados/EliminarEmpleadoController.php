<?php
require_once '../../models/Empleado.php';

$id = $_POST['id'] ?? $_GET['id'] ?? 0;

if (empty($id)) {
    header("Location: /ShopOnline_Huila/views/empleados/index.php?error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->eliminar($id)) {
    header("Location: /ShopOnline_Huila/views/empleados/index.php?success=delete");
} else {
    header("Location: /ShopOnline_Huila/views/empleados/index.php?error=500");
}
exit;
