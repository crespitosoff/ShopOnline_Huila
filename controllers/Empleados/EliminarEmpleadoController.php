<?php
require_once '../../models/Empleado.php';

$id = $_POST['id'] ?? 0;

if (empty($id)) {
        header("Location: ../../views/empleados_listar.php?error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->eliminar($id)) {
        header("Location: ../../views/empleados_listar.php?success=delete");
} else {
        header("Location: ../../views/empleados_listar.php?error=500");
}
exit;
