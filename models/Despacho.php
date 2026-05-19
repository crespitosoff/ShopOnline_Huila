<?php
require_once __DIR__ . '/../config/conexion.php';

class Despacho
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function obtenerTodos()
    {
        try {
            $sql = "SELECT e.id_envio, e.SKU_envio, e.id_pedido, p.SKU_pedido, e.id_empleado, e.fecha_envio, e.fecha_entrega, e.guia_rastreo, e.id_estado,
                           p.direccion_envio, 
                           TRIM(CONCAT_WS(' ', NULLIF(c.primer_nombre,''), NULLIF(c.segundo_nombre,''), NULLIF(c.primer_apellido,''), NULLIF(c.segundo_apellido,''))) as nombre_cliente, 
                           TRIM(CONCAT_WS(' ', NULLIF(emp.primer_nombre,''), NULLIF(emp.segundo_nombre,''), NULLIF(emp.primer_apellido,''), NULLIF(emp.segundo_apellido,''))) as nombre_empleado
                    FROM envios e
                    INNER JOIN pedidos p ON e.id_pedido = p.id_pedido
                    INNER JOIN clientes c ON p.id_cliente = c.id_cliente
                    LEFT JOIN empleados emp ON e.id_empleado = emp.id_empleado
                    ORDER BY e.id_estado ASC, e.fecha_envio DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Despacho::obtenerTodos -> " . $e->getMessage());
            return [];
        }
    }

    public function despachar($id_envio, $id_empleado, $guia_rastreo)
    {
        try {
            // Estado 2 = En camino
            $sql = "UPDATE envios SET id_empleado = :id_empleado, guia_rastreo = :guia, id_estado = 2 WHERE id_envio = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
            $stmt->bindParam(':guia', $guia_rastreo);
            $stmt->bindParam(':id', $id_envio, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Despacho::despachar -> " . $e->getMessage());
            return false;
        }
    }

    public function confirmarEntrega($id_envio)
    {
        try {
            // Estado 3 = Entregado
            $fecha = date('Y-m-d H:i:s');
            $sql = "UPDATE envios SET id_estado = 3, fecha_entrega = :fecha WHERE id_envio = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':id', $id_envio, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Despacho::confirmarEntrega -> " . $e->getMessage());
            return false;
        }
    }
}
