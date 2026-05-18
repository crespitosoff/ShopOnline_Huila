<?php
require_once '../../models/Empleado.php';

$objEmpleado = new Empleado();
$empleados = $objEmpleado->obtenerTodos();

if ($empleados === false) {
    $_error = "Error al cargar empleados desde la base de datos";
    $empleados = [];
}

// ✅ Backend pasa control a la vista con los datos disponibles
require_once '../../views/empleados/index.php';
?>
