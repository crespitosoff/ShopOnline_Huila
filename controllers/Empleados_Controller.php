<?php

require_once '../models/Empleado.php'; 

$action = $_REQUEST['action'] ?? 'listar';

if ($action === 'crear') {
    // Capturamos los datos del formulario
    $nombre        = trim ($_POST['nombre'] ?? '');
    $id_cargo       = $_POST['id_cargo'] ?? '';
    $salario       = $_POST['salario'] ?? 0;
    $fecha_ingreso = $_POST['fecha_ingreso'] ?? '';


    // Validaciones básicas (Requerimiento del Sprint 1)
    if (empty($nombre) || empty($id_cargo)  ||  empty($fecha_ingreso)) {
        http_response_code(400);
        header("Location: ../views/empleados_crear.php?error=campos_obligatorios");
        exit;       
    }

    if (!is_numeric($salario)  || $salario <= 0){
        http_response_code(400);
        header("Location: ../views/empleados_crear.php?error=salario_invalido");
        exit;

    }

    $objEmpleado = new Empleado();

    // 3. Intentamos registrar
    if ($objEmpleado->registrar($nombre, $id_cargo, $salario, $fecha_ingreso)) {
        // Éxito: Redirigimos a la lista (que haremos luego)
        http_response_code(201);
        header("Location: ../views/empleados_listar.php?success=1");
        exit;
    } else {
        http_response_code(500);
        header("Location: ../views/empleados_crear.php?error=error_tecnico");
        exit;
    }
}

    if ($action === 'listar') {
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
}

if ($action === 'editar') {
    $id = $_GET['id'] ?? 0;

    if (empty($id)) {
        http_response_code(400);
        header("Location: ../views/empleados_listar.php?error=400");
        exit;
    }

    $objEmpleado = new Empleado();
    $empleado = $objEmpleado->obtenerPorId($id);
    $cargos = $objEmpleado->obtenerCargos(); 

    if (!$empleado) {
        http_response_code(404);
        header("Location: ../views/empleados_listar.php?error=404");
        exit;
    }
}

if ($action === 'actualizar') {
    $id       = $_POST['id_empleado'] ?? 0;
    $nombre   = $_POST['nombre'] ?? '';
    $id_cargo = $_POST['id_cargo'] ?? '';
    $salario  = $_POST['salario'] ?? '';

    if (empty($id) || empty($nombre) || empty($id_cargo) || !is_numeric($salario)) {
        http_response_code(400);
        header("Location: ../views/empleados_editar.php?id=$id&error=400");
        exit;
    }

    $objEmpleado = new Empleado();
    if ($objEmpleado->actualizar($id, $nombre, $id_cargo, $salario)) {
        http_response_code(200);
        header("Location: ../views/empleados_listar.php?success=update");
    } else {
        http_response_code(500);
        header("Location: ../views/empleados_editar.php?id=$id&error=1");
    }
    exit;
}

if ($action === 'eliminar') {
    $id = $_POST['id'] ?? 0;

    if (empty($id)) {
        http_response_code(400);
        header("Location: ../views/empleados_listar.php?error=400");
        exit;
    }

    $objEmpleado = new Empleado();
    if ($objEmpleado->eliminar($id)) {
        http_response_code(200);
        header("Location: ../views/empleados_listar.php?success=delete");
    } else {
        http_response_code(500);
        header("Location: ../views/empleados_listar.php?error=500");
    }
    exit;
}
if ($action === 'ver') {
    $id = $_GET['id'] ?? 0;

    if (empty($id)) {
        http_response_code(400);
        header("Location: ../views/empleados_listar.php?error=id_requerido");
        exit;
    }

    $objEmpleado = new Empleado();
    $empleado = $objEmpleado->obtenerPorId($id);

    if (!$empleado) {
        http_response_code(404);
        header("Location: ../views/empleados_listar.php?error=no_encontrado");
        exit;
    }
    http_response_code(200);
}