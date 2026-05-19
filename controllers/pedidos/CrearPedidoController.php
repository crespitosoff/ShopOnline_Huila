<?php
require_once __DIR__ . '/../../models/Pedido.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = $_POST['id_cliente'] ?? null;
    $direccion_envio = trim($_POST['direccion_envio'] ?? '');
    
    // Obtener array de IDs de productos y cantidades
    $ids_productos = $_POST['id_producto'] ?? [];
    $cantidades = $_POST['cantidad'] ?? [];

    if (!$id_cliente || empty($direccion_envio) || empty($ids_productos)) {
        header("Location: ../../views/pedidos/crear.php?error=" . urlencode("Faltan datos obligatorios."));
        exit;
    }

    $productosSeleccionados = [];
    foreach ($ids_productos as $index => $id_prod) {
        $cant = (int)($cantidades[$index] ?? 0);
        if ($cant > 0) {
            $productosSeleccionados[] = [
                'id_producto' => $id_prod,
                'cantidad' => $cant
            ];
        }
    }

    if (empty($productosSeleccionados)) {
        header("Location: ../../views/pedidos/crear.php?error=" . urlencode("Debe seleccionar al menos un producto con cantidad válida."));
        exit;
    }

    $pedidoModel = new Pedido();
    $exito = $pedidoModel->crearManual($id_cliente, $direccion_envio, $productosSeleccionados);

    if ($exito) {
        header("Location: ../../views/pedidos/index.php?success=1");
    } else {
        header("Location: ../../views/pedidos/crear.php?error=" . urlencode("No se pudo crear el pedido. Verifique el stock o intente más tarde."));
    }
    exit;
} else {
    header("Location: ../../views/pedidos/index.php");
    exit;
}
