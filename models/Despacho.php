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
            $sql = "SELECT e.id_envio, e.codigo_envio, e.id_pedido, p.codigo_pedido, e.id_empleado, e.fecha_envio, e.fecha_entrega, e.guia_rastreo, e.id_estado,
                           p.direccion_envio, c.nombre as nombre_cliente, emp.nombre as nombre_empleado
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
