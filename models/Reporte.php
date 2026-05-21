<?php
require_once __DIR__ . '/../config/conexion.php';

class Reporte
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function obtenerMapeoKPIs($periodo = 'all')
    {
        try {
            $dateFilter = "";
            if ($periodo == 'today') {
                $dateFilter = " AND DATE(p.fecha_creacion) = CURDATE()";
            } elseif ($periodo == 'month') {
                $dateFilter = " AND MONTH(p.fecha_creacion) = MONTH(CURDATE()) AND YEAR(p.fecha_creacion) = YEAR(CURDATE())";
            }

            // Total Ingresos (Solo pedidos pagados o enviados)
            $stmt1 = $this->db->prepare("SELECT SUM(total) as total_ingresos FROM pedidos p WHERE id_estado IN (2, 3)" . $dateFilter);
            $stmt1->execute();
            $totalIngresos = $stmt1->fetchColumn() ?: 0;

            // Unidades Vendidas
            $stmt2 = $this->db->prepare("SELECT SUM(dp.cantidad) as unidades 
                                         FROM detalle_pedidos dp 
                                         INNER JOIN pedidos p ON dp.id_pedido = p.id_pedido 
                                         WHERE p.id_estado IN (2, 3)" . $dateFilter);
            $stmt2->execute();
            $unidadesVendidas = $stmt2->fetchColumn() ?: 0;

            // Producto Estrella
            $stmt3 = $this->db->prepare("SELECT pr.nombre 
                                         FROM detalle_pedidos dp 
                                         INNER JOIN productos pr ON dp.id_producto = pr.id_producto 
                                         INNER JOIN pedidos p ON dp.id_pedido = p.id_pedido 
                                         WHERE p.id_estado IN (2, 3)" . $dateFilter . " 
                                         GROUP BY pr.id_producto 
                                         ORDER BY SUM(dp.cantidad) DESC LIMIT 1");
            $stmt3->execute();
            $productoEstrella = $stmt3->fetchColumn() ?: 'Ninguno';

            return [
                'total_ingresos' => $totalIngresos,
                'unidades_vendidas' => $unidadesVendidas,
                'producto_estrella' => $productoEstrella
            ];
        } catch (PDOException $e) {
            error_log("Error en Reporte::obtenerMapeoKPIs -> " . $e->getMessage());
            return [
                'total_ingresos' => 0,
                'unidades_vendidas' => 0,
                'producto_estrella' => 'Error'
            ];
        }
    }

    public function obtenerPedidosPorFecha($fecha)
{
    try {
        $sql = "SELECT 
                    p.id_pedido,
                    p.SKU_pedido,
                    CONCAT(c.primer_nombre, ' ', c.primer_apellido) AS cliente,
                    pg.monto AS valor_pagado,
                    mp.nombre AS metodo_pago,
                    DATE(pg.fecha_pago) AS fecha
                FROM pedidos p
                INNER JOIN pagos pg ON p.id_pedido = pg.id_pedido
                INNER JOIN metodo_pago mp ON pg.id_metodo = mp.id_metodo
                INNER JOIN clientes c ON p.id_cliente = c.id_cliente
                WHERE DATE(pg.fecha_pago) = :fecha
                ORDER BY pg.fecha_pago DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en Reporte::obtenerPedidosPorFecha -> " . $e->getMessage());
        return [];
    }
}

public function obtenerDetallePedido($id_pedido)
{
    try {
        $sql = "SELECT
                    p.id_pedido,
                    p.SKU_pedido,
                    CONCAT(c.primer_nombre, ' ', c.primer_apellido) AS cliente,
                    pr.nombre AS producto,
                    dp.cantidad,
                    dp.precio_unitario,
                    (dp.cantidad * dp.precio_unitario) AS subtotal
                FROM pedidos p
                INNER JOIN clientes c ON p.id_cliente = c.id_cliente
                INNER JOIN detalle_pedidos dp ON p.id_pedido = dp.id_pedido
                INNER JOIN productos pr ON dp.id_producto = pr.id_producto
                WHERE p.id_pedido = :id_pedido";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error en Reporte::obtenerDetallePedido -> " . $e->getMessage());
        return [];
    }
}

    public function obtenerVentasPorProducto($periodo = 'all')
    {
        try {
            $dateFilter = "";
            if ($periodo == 'today') {
                $dateFilter = " AND DATE(p.fecha_creacion) = CURDATE()";
            } elseif ($periodo == 'month') {
                $dateFilter = " AND MONTH(p.fecha_creacion) = MONTH(CURDATE()) AND YEAR(p.fecha_creacion) = YEAR(CURDATE())";
            }

            $sql = "SELECT pr.id_producto, pr.SKU_producto, pr.nombre, c.nombre as categoria, 
                           SUM(dp.cantidad) as cant_vendida, 
                           SUM(dp.cantidad * dp.precio_unitario) as ingreso_total 
                    FROM detalle_pedidos dp 
                    INNER JOIN productos pr ON dp.id_producto = pr.id_producto 
                    INNER JOIN categorias c ON pr.id_categoria = c.id_categoria 
                    INNER JOIN pedidos p ON dp.id_pedido = p.id_pedido 
                    WHERE p.id_estado IN (2, 3)" . $dateFilter . " 
                    GROUP BY pr.id_producto 
                    ORDER BY ingreso_total DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Reporte::obtenerVentasPorProducto -> " . $e->getMessage());
            return [];
        }
    }
}
