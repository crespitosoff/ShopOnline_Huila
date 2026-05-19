<?php
require_once __DIR__ . '/../config/conexion.php';

class Reporte
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function obtenerMapeoKPIs()
    {
        try {
            // Total Ingresos (Solo pedidos pagados o enviados)
            $stmt1 = $this->db->prepare("SELECT SUM(total) as total_ingresos FROM pedidos WHERE id_estado IN (2, 3)");
            $stmt1->execute();
            $totalIngresos = $stmt1->fetchColumn() ?: 0;

            // Unidades Vendidas
            $stmt2 = $this->db->prepare("SELECT SUM(dp.cantidad) as unidades 
                                         FROM detalle_pedidos dp 
                                         INNER JOIN pedidos p ON dp.id_pedido = p.id_pedido 
                                         WHERE p.id_estado IN (2, 3)");
            $stmt2->execute();
            $unidadesVendidas = $stmt2->fetchColumn() ?: 0;

            // Producto Estrella
            $stmt3 = $this->db->prepare("SELECT pr.nombre 
                                         FROM detalle_pedidos dp 
                                         INNER JOIN productos pr ON dp.id_producto = pr.id_producto 
                                         INNER JOIN pedidos p ON dp.id_pedido = p.id_pedido 
                                         WHERE p.id_estado IN (2, 3) 
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

    public function obtenerVentasPorProducto()
    {
        try {
            $sql = "SELECT pr.id_producto, pr.SKU_producto, pr.nombre, c.nombre as categoria, 
                           SUM(dp.cantidad) as cant_vendida, 
                           SUM(dp.cantidad * dp.precio_unitario) as ingreso_total 
                    FROM detalle_pedidos dp 
                    INNER JOIN productos pr ON dp.id_producto = pr.id_producto 
                    INNER JOIN categorias c ON pr.id_categoria = c.id_categoria 
                    INNER JOIN pedidos p ON dp.id_pedido = p.id_pedido 
                    WHERE p.id_estado IN (2, 3) 
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
