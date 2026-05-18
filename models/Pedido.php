<?php
require_once __DIR__ . '/../config/conexion.php';

class Pedido
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function obtenerTodos()
    {
        try {
            $sql = "SELECT p.*, c.nombre as nombre_cliente, ep.nombre as nombre_estado 
                    FROM pedidos p 
                    INNER JOIN clientes c ON p.id_cliente = c.id_cliente 
                    INNER JOIN estado_pedido ep ON p.id_estado = ep.id_estado
                    ORDER BY p.fecha_creacion DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Pedido::obtenerTodos -> " . $e->getMessage());
            return [];
        }
    }

    public function validarPago($id_pedido, $id_metodo, $monto)
    {
        try {
            $this->db->beginTransaction();

            // Verificar si ya existe el pago para evitar duplicados
            $check = $this->db->prepare("SELECT id_pago FROM pagos WHERE id_pedido = ?");
            $check->execute([$id_pedido]);
            if ($check->rowCount() == 0) {
                // Insertar pago
                $sqlPago = "INSERT INTO pagos (id_pedido, monto, id_metodo) VALUES (:id_pedido, :monto, :id_metodo)";
                $stmtPago = $this->db->prepare($sqlPago);
                $stmtPago->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $stmtPago->bindParam(':monto', $monto);
                $stmtPago->bindParam(':id_metodo', $id_metodo, PDO::PARAM_INT);
                $stmtPago->execute();
            }

            // Cambiar estado a Pagado (2)
            $sqlEstado = "UPDATE pedidos SET id_estado = 2 WHERE id_pedido = :id_pedido";
            $stmtEstado = $this->db->prepare($sqlEstado);
            $stmtEstado->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $stmtEstado->execute();

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error en Pedido::validarPago -> " . $e->getMessage());
            return false;
        }
    }

    public function prepararEmpaque($id_pedido, $id_empleado)
    {
        try {
            $this->db->beginTransaction();

            // Insertar en envíos si no existe
            $check = $this->db->prepare("SELECT id_envio FROM envios WHERE id_pedido = ?");
            $check->execute([$id_pedido]);
            if ($check->rowCount() == 0) {
                $sqlEnvio = "INSERT INTO envios (id_pedido, id_empleado, id_estado) VALUES (:id_pedido, :id_empleado, 1)";
                $stmtEnvio = $this->db->prepare($sqlEnvio);
                $stmtEnvio->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
                $stmtEnvio->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
                $stmtEnvio->execute();
            }

            // Cambiar estado del pedido a Enviado (3)
            $sqlEstado = "UPDATE pedidos SET id_estado = 3 WHERE id_pedido = :id_pedido";
            $stmtEstado = $this->db->prepare($sqlEstado);
            $stmtEstado->bindParam(':id_pedido', $id_pedido, PDO::PARAM_INT);
            $stmtEstado->execute();

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error en Pedido::prepararEmpaque -> " . $e->getMessage());
            return false;
        }
    }
}
