<?php
require_once '../models/Cliente.php'; 

// 2. Detectamos qué acción quiere realizar el usuario
$action = $_REQUEST ['action'] ?? 'listar';

if ($action === 'crear') {
    // Capturamos los datos del formulario
    $nombre   = trim ($_POST['nombre'] ?? '');
    $email    = trim ($_POST['email'] ?? '');
    $telefono = trim ($_POST['telefono'] ?? '');

    // Validaciones básicas (Requerimiento del Sprint 1)
    if (empty($nombre) || empty($email) || empty($telefono)) {
        http_response_code(400);
        header("Location: ../views/clientes_crear.php?error=campos_obligatorios");
        exit;
    }

    $objCliente = new Cliente();

    // 3. Intentamos registrar
    if ($objCliente->registrar($nombre, $email, $telefono)) {
        http_response_code(201);
        header("Location: ../views/clientes_listar.php?success=1");
    } else {
        http_response_code(500);
        header("Location: ../views/clientes_crear.php?error=error_tecnico");
        exit;
    }
}
    
    if ($action === 'listar') {
    $objCliente = new Cliente();
    
    // Llamamos al método que explicamos antes
    $clientes= $objCliente->obtenerTodos();
    if ($clientes === false) {
        http_response_code(500); 
        $clientes = [];
     } else {
        http_response_code(200); // OK (Todo salió bien)
    }
}

if ($action === 'editar') {
    $id = $_GET['id'] ?? 0;

    if (empty($id)) {
        http_response_code(400);
        header("Location: ../views/clientes_listar.php?error=400");
        exit;
    }

    $objCliente = new Cliente();
    $cliente = $objCliente->obtenerPorId($id);
    
    if (!$cliente) {
        http_response_code(404); 
        header("Location: ../views/clientes_listar.php?error=no_encontrado");
        exit;
    }
    http_response_code(200);
}

if ($action === 'actualizar') {
    $id       = $_POST['id_cliente'] ?? 0;
    $nombre   = trim ($_POST['nombre'] ?? '');
    $email    = trim ($_POST['email'] ?? '');
    $telefono = trim ($_POST['telefono'] ?? '');
    
    if (empty($id) || empty($nombre) || empty($email) || empty($telefono)) {
        http_response_code(400); 
        header("Location: ../views/clientes_editar.php?id=$id&error=campos_obligatorios");
        exit;
    }

    $objCliente = new Cliente();
    if ($objCliente->actualizar($id, $nombre, $email, $telefono)) {
        http_response_code(200);
        header("Location: ../views/clientes_listar.php?success=update");
    } else {
        http_response_code(500);
        header("Location: ../views/clientes_editar.php?id=$id&error=fallo_update");
    }
    exit;
}
if ($action === 'eliminar') {
    $id = $_POST['id'] ?? 0;

    if (empty($id)) {
        http_response_code(400);
        header("Location: ../views/clientes_listar.php?error=400");
        exit;
    }

    $objCliente = new Cliente();
    
    if ($objCliente->eliminar($id)) {
        http_response_code(200);
        header("Location: ../views/clientes_listar.php?success=delete");
    } else {
        http_response_code(500);
        header("Location: ../views/clientes_listar.php?error=no_se_pudo_eliminar");
    }
    exit;
}
if ($action === 'ver') {
    $id = $_GET['id'] ?? 0;

    if (empty($id)) {
        http_response_code(400);
        header("Location: ../views/clientes_listar.php?error=id_requerido");
        exit;
    }

    $objCliente = new Cliente();
    $cliente = $objCliente->obtenerPorId($id);

    if (!$cliente) {
        http_response_code(404);
        header("Location: ../views/clientes_listar.php?error=no_encontrado");
        exit;
    }
    http_response_code(200);
}


