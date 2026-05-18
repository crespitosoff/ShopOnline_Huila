<?php
require_once __DIR__ . '/../../models/Producto.php';

$id = $_POST['id'] ?? '';

if (empty($id)) {
    header("Location: /ShopOnline_Huila/views/productos/?error=id_invalido");
    exit;
}

$objProducto = new Producto();
if ($objProducto->eliminar($id)) {
    header("Location: /ShopOnline_Huila/views/productos/?success=eliminado");
    exit;
} else {
    header("Location: /ShopOnline_Huila/views/productos/?error=error_tecnico");
    exit;
}
