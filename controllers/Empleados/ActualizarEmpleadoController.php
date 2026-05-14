<?php
require_once '../../models/Empleado.php';

$id = $_POST['id_empleado'] ?? 0;
$nombre = trim($_POST['nombre'] ?? '');
$id_cargo = (float) ($_POST['id_cargo'] ?? '');
$salario = trim($_POST['salario'] ?? '');

if (empty($id) || empty($nombre) || empty($id_cargo) || !is_numeric($salario)) {
    http_response_code(400);
    header("Location: ../../views/empleados_editar.php?id=$id&error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->actualizar($id, $nombre, $id_cargo, $salario)) {
    http_response_code(200);
    header("Location: ../../views/empleados_listar.php?success=update");
} else {
    http_response_code(500);
    header("Location: ../../views/empleados_editar.php?id=$id&error=1");
}
exit;
