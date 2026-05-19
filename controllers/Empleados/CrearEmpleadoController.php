<?php
require_once __DIR__ . '/../../models/Empleado.php';

$id_cargo = $_POST['id_cargo'] ?? '';
$primer_nombre = trim($_POST['primer_nombre'] ?? '');
$segundo_nombre = trim($_POST['segundo_nombre'] ?? '');
$primer_apellido = trim($_POST['primer_apellido'] ?? '');
$segundo_apellido = trim($_POST['segundo_apellido'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$salario = (float) ($_POST['salario'] ?? 0);
$fecha_ingreso = trim($_POST['fecha_ingreso'] ?? '');


// Validaciones básicas (Requerimiento del Sprint 1)
if (empty($primer_nombre) || empty($primer_apellido) || empty($email) || empty($password) || empty($id_cargo) || empty($fecha_ingreso)) {
header("Location: /ShopOnline_Huila/views/empleados/?error=campos_obligatorios");
    exit;
}

if (!is_numeric($salario) || $salario <= 0) {
header("Location: /ShopOnline_Huila/views/empleados/?error=salario_invalido");
    exit;

}

$objEmpleado = new Empleado();

// 3. Intentamos registrar
if ($objEmpleado->registrar($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $email, $password, $id_cargo, $salario, $fecha_ingreso)) {
    // Éxito: Redirigimos a la lista (que haremos luego)
header("Location: /ShopOnline_Huila/views/empleados/?success=1");
    exit;
} else {
header("Location: /ShopOnline_Huila/views/empleados/?error=error_tecnico");
    exit;
}
