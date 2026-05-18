<?php
require_once '../../models/Empleado.php';

$id = $_POST['id_empleado'] ?? 0;
$nombre = trim($_POST['nombre'] ?? '');
$id_cargo = (float) ($_POST['id_cargo'] ?? '');
$salario = trim($_POST['salario'] ?? '');

if (empty($id) || empty($nombre) || empty($id_cargo) || !is_numeric($salario)) {
    header("Location: ../../views/empleados/form.php?id=$id&error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->actualizar($id, $nombre, $id_cargo, $salario)) {
    header("Location: ../../views/empleados/index.php?success=update");
} else {
    header("Location: ../../views/empleados/form.php?id=$id&error=1");
}
exit;
