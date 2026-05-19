<?php
session_start();
if (!isset($_SESSION['empleado_id'])) {
    header("Location: /ShopOnline_Huila/views/login.php");
    exit;
}

require_once __DIR__ . '/../../config/conexion.php';

$modulo = $_GET['modulo'] ?? '';
$db = Conexion::conectar();

// Configurar encabezados para descarga de CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=export_' . $modulo . '_' . date('Y-m-d_His') . '.csv');

// Salida al buffer
$output = fopen('php://output', 'w');
// UTF-8 BOM para que Excel lea correctamente los acentos
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

switch ($modulo) {
    case 'clientes':
        fputcsv($output, ['SKU Cliente', 'Primer Nombre', 'Segundo Nombre', 'Primer Apellido', 'Segundo Apellido', 'Email', 'Telefono', 'Cantidad Pedidos']);
        $sql = "SELECT SKU_cliente, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, email, telefono, 
                       (SELECT COUNT(*) FROM pedidos WHERE id_cliente = c.id_cliente) as cantidad_pedidos 
                FROM clientes c WHERE activo = 1";
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }
        break;

    case 'empleados':
        fputcsv($output, ['SKU Empleado', 'Primer Nombre', 'Segundo Nombre', 'Primer Apellido', 'Segundo Apellido', 'Email', 'Cargo', 'Salario', 'Fecha Ingreso']);
        $sql = "SELECT e.SKU_empleado, e.primer_nombre, e.segundo_nombre, e.primer_apellido, e.segundo_apellido, e.email, c.nombre as cargo, e.salario, e.fecha_ingreso 
                FROM empleados e 
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo
                WHERE e.activo = 1";
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }
        break;

    case 'productos':
        fputcsv($output, ['SKU Producto', 'Nombre', 'Categoria', 'Precio', 'Stock']);
        $sql = "SELECT p.SKU_producto, p.nombre, c.nombre as categoria, p.precio, p.stock 
                FROM productos p 
                INNER JOIN categorias c ON p.id_categoria = c.id_categoria
                WHERE p.activo = 1";
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }
        break;

    case 'pedidos':
        fputcsv($output, ['SKU Pedido', 'Fecha', 'Cliente', 'Direccion', 'Total', 'Estado']);
        $sql = "SELECT p.SKU_pedido, p.fecha_creacion, 
                       TRIM(CONCAT_WS(' ', NULLIF(c.primer_nombre,''), NULLIF(c.segundo_nombre,''), NULLIF(c.primer_apellido,''), NULLIF(c.segundo_apellido,''))) as cliente, 
                       p.direccion_envio, p.total, ep.nombre as estado 
                FROM pedidos p 
                INNER JOIN clientes c ON p.id_cliente = c.id_cliente 
                INNER JOIN estado_pedido ep ON p.id_estado = ep.id_estado";
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }
        break;

    case 'despachos':
        fputcsv($output, ['SKU Envio', 'SKU Pedido', 'Cliente', 'Direccion', 'Empleado', 'Guia Rastreo', 'Fecha Envio', 'Fecha Entrega']);
        $sql = "SELECT e.SKU_envio, p.SKU_pedido, 
                       TRIM(CONCAT_WS(' ', NULLIF(c.primer_nombre,''), NULLIF(c.segundo_nombre,''), NULLIF(c.primer_apellido,''), NULLIF(c.segundo_apellido,''))) as cliente, 
                       p.direccion_envio, 
                       TRIM(CONCAT_WS(' ', NULLIF(emp.primer_nombre,''), NULLIF(emp.segundo_nombre,''), NULLIF(emp.primer_apellido,''), NULLIF(emp.segundo_apellido,''))) as empleado, 
                       e.guia_rastreo, e.fecha_envio, e.fecha_entrega
                FROM envios e
                INNER JOIN pedidos p ON e.id_pedido = p.id_pedido
                INNER JOIN clientes c ON p.id_cliente = c.id_cliente
                LEFT JOIN empleados emp ON e.id_empleado = emp.id_empleado
                ORDER BY e.fecha_envio DESC";
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }
        break;

    case 'reportes':
        fputcsv($output, ['SKU Producto', 'Nombre', 'Categoria', 'Cantidad Vendida', 'Ingreso Total']);
        $sql = "SELECT pr.SKU_producto, pr.nombre, c.nombre as categoria, 
                       SUM(dp.cantidad) as cant_vendida, 
                       SUM(dp.cantidad * dp.precio_unitario) as ingreso_total 
                FROM detalle_pedidos dp 
                INNER JOIN productos pr ON dp.id_producto = pr.id_producto 
                INNER JOIN categorias c ON pr.id_categoria = c.id_categoria 
                INNER JOIN pedidos p ON dp.id_pedido = p.id_pedido 
                WHERE p.id_estado IN (2, 3) 
                GROUP BY pr.id_producto 
                ORDER BY ingreso_total DESC";
        $stmt = $db->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            fputcsv($output, $row);
        }
        break;

    default:
        fputcsv($output, ['Error', 'Modulo no valido']);
        break;
}

fclose($output);
exit;
