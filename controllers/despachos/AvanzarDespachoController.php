<?php
require_once __DIR__ . '/../../models/Despacho.php';

$id_envio = $_POST['id_envio'] ?? 0;
$accion = $_POST['accion'] ?? '';

if (!$id_envio || !$accion) {
    header("Location: /ShopOnline_Huila/views/despachos/?error=datos_invalidos");
    exit;
}

$objDespacho = new Despacho();

if ($accion === 'despachar') {
    $id_empleado = $_POST['id_empleado'] ?? 1; // Fallback al empleado 1 si no seleccionan
    $guia_rastreo = 'TRK-' . strtoupper(substr(uniqid(), -6)); // Generar guía aleatoria
    
    if ($objDespacho->despachar($id_envio, $id_empleado, $guia_rastreo)) {
        header("Location: /ShopOnline_Huila/views/despachos/?success=despachado");
    } else {
        header("Location: /ShopOnline_Huila/views/despachos/?error=error_despacho");
    }
    exit;
} elseif ($accion === 'confirmar_entrega') {
    if ($objDespacho->confirmarEntrega($id_envio)) {
        header("Location: /ShopOnline_Huila/views/despachos/?success=entregado");
    } else {
        header("Location: /ShopOnline_Huila/views/despachos/?error=error_entrega");
    }
    exit;
} else {
    header("Location: /ShopOnline_Huila/views/despachos/?error=accion_desconocida");
    exit;
}
