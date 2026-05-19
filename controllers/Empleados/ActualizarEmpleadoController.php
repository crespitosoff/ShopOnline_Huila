<?php
require_once __DIR__ . '/../../models/Empleado.php';

$id = $_POST['id_empleado'] ?? 0;
$primer_nombre = trim($_POST['primer_nombre'] ?? '');
$segundo_nombre = trim($_POST['segundo_nombre'] ?? '');
$primer_apellido = trim($_POST['primer_apellido'] ?? '');
$segundo_apellido = trim($_POST['segundo_apellido'] ?? '');
$email = trim($_POST['email'] ?? '');
$id_cargo = (float) ($_POST['id_cargo'] ?? '');
$salario = trim($_POST['salario'] ?? '');

if (empty($id) || empty($primer_nombre) || empty($primer_apellido) || empty($id_cargo) || !is_numeric($salario)) {
header("Location: /ShopOnline_Huila/views/empleados/editar.php?id=$id&error=400");
    exit;
}

$objEmpleado = new Empleado();
if ($objEmpleado->actualizar($id, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $email, $id_cargo, $salario)) {
header("Location: /ShopOnline_Huila/views/empleados/?success=update");
} else {
header("Location: /ShopOnline_Huila/views/empleados/editar.php?id=$id&error=1");
}
exit;
