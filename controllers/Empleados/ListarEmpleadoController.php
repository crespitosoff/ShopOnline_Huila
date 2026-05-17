<?php
require_once '../../models/Empleado.php';

$objEmpleado = new Empleado();
$empleados = $objEmpleado->obtenerTodos();

if ($empleados === false) {
    http_response_code(500);
    $_error = "Error al cargar empleados desde la base de datos";
    $empleados = [];
} else {
    http_response_code(200);
}

// ✅ Backend pasa control a la vista con los datos disponibles
require_once '../../views/empleados_listar.php';
?>