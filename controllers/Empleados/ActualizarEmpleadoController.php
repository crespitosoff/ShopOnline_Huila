<?php
require_once __DIR__ . '/../../models/Empleado.php';

$id = $_POST['id_empleado'] ?? 0;
$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$id_cargo = (float) ($_POST['id_cargo'] ?? '');
$salario = trim($_POST['salario'] ?? '');

if (empty($id) || empty($nombre) || empty($id_cargo) || !is_numeric($salario)) {
header("Location: /ShopOnline_Huila/views/empleados/editar.php?id=$id&error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->actualizar($id, $nombre, $email, $id_cargo, $salario)) {
header("Location: /ShopOnline_Huila/views/empleados/?success=update");
} else {
header("Location: /ShopOnline_Huila/views/empleados/editar.php?id=$id&error=1");
}
exit;
