<?php
require_once __DIR__ . '/../../models/Pedido.php';

$id_pedido = $_POST['id_pedido'] ?? 0;
$accion = $_POST['accion'] ?? '';
$monto = (float) ($_POST['monto'] ?? 0);

if (!$id_pedido || !$accion) {
    header("Location: /ShopOnline_Huila/views/pedidos/?error=datos_invalidos");
    exit;
}

$objPedido = new Pedido();

if ($accion === 'validar_pago') {
    // Para simplificar, asumimos id_metodo = 1 (Efectivo) si no se manda otro
    $id_metodo = 1;
    if ($objPedido->validarPago($id_pedido, $id_metodo, $monto)) {
        header("Location: /ShopOnline_Huila/views/pedidos/?success=pago_validado");
    } else {
        header("Location: /ShopOnline_Huila/views/pedidos/?error=error_pago");
    }
    exit;
} elseif ($accion === 'preparar_empaque') {
    // Simulamos un empleado logueado con ID 1 o 2 (lo traemos del seed)
    $id_empleado_asignado = 1; 
    if ($objPedido->prepararEmpaque($id_pedido, $id_empleado_asignado)) {
        header("Location: /ShopOnline_Huila/views/pedidos/?success=empaque_iniciado");
    } else {
        header("Location: /ShopOnline_Huila/views/pedidos/?error=error_empaque");
    }
    exit;
} else {
    header("Location: /ShopOnline_Huila/views/pedidos/?error=accion_desconocida");
    exit;
}
