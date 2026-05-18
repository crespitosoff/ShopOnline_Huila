<?php
require_once __DIR__ . '/../../models/Producto.php';

$id_producto = $_POST['id_producto'] ?? '';
$nombre = trim($_POST['nombre'] ?? '');
$id_categoria = $_POST['id_categoria'] ?? '';
$precio = (float) ($_POST['precio'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);
$descripcion = trim($_POST['descripcion'] ?? '');

if (empty($id_producto) || empty($nombre) || empty($id_categoria) || $precio <= 0 || $stock < 0) {
    header("Location: /ShopOnline_Huila/views/productos/editar.php?id=$id_producto&error=campos_obligatorios");
    exit;
}

$objProducto = new Producto();
if ($objProducto->actualizar($id_producto, $id_categoria, $nombre, $precio, $stock, $descripcion)) {
    header("Location: /ShopOnline_Huila/views/productos/?success=update");
    exit;
} else {
    header("Location: /ShopOnline_Huila/views/productos/editar.php?id=$id_producto&error=fallo_update");
    exit;
}
