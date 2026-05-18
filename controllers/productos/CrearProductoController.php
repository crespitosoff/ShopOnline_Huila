<?php
require_once __DIR__ . '/../../models/Producto.php';

$nombre = trim($_POST['nombre'] ?? '');
$id_categoria = $_POST['id_categoria'] ?? '';
$precio = (float) ($_POST['precio'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);
$descripcion = trim($_POST['descripcion'] ?? '');

if (empty($nombre) || empty($id_categoria) || $precio <= 0 || $stock < 0) {
    header("Location: /ShopOnline_Huila/views/productos/?error=campos_obligatorios");
    exit;
}

$objProducto = new Producto();
if ($objProducto->registrar($id_categoria, $nombre, $precio, $stock, $descripcion)) {
    header("Location: /ShopOnline_Huila/views/productos/?success=1");
    exit;
} else {
    header("Location: /ShopOnline_Huila/views/productos/?error=error_tecnico");
    exit;
}
