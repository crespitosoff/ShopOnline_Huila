<?php
require_once '../../models/Cliente.php';

$id = $_POST['id'] ?? $_GET['id'] ?? 0;

if (empty($id)) {
    header("Location: /ShopOnline_Huila/views/clientes/index.php?error=400");
    exit;
}

$objCliente = new Cliente();

if ($objCliente->eliminar($id)) {
    header("Location: /ShopOnline_Huila/views/clientes/index.php?success=Eliminado");
} else {
    header("Location: /ShopOnline_Huila/views/clientes/index.php?error=no_se_pudo_eliminar");
}
exit;
