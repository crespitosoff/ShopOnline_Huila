<?php
require_once '../../models/Empleado.php';

$objEmpleado = new Empleado();
$empleados = $objEmpleado->obtenerTodos();

if ($empleados === false) {
    // Error 500: Algo falló en la consulta o la conexión
    http_response_code(500);
    $empleados = []; // Evitamos errores en la vista enviando un arreglo vacío
} else {
    // Código 200: La solicitud fue exitosa y los datos están listos
    http_response_code(200);
}
