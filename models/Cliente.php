<?php
require_once __DIR__ . '/../config/conexion.php';

class Cliente
{
    private $db;

    // Al crear el objeto, le pasamos la conexión PDO
    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function registrar($primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $email, $password, $telefono)
    {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO clientes (primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, email, password, telefono) VALUES (:primer_nombre, :segundo_nombre, :primer_apellido, :segundo_apellido, :email, :password, :telefono)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':primer_nombre', $primer_nombre);
            $stmt->bindParam(':segundo_nombre', $segundo_nombre);
            $stmt->bindParam(':primer_apellido', $primer_apellido);
            $stmt->bindParam(':segundo_apellido', $segundo_apellido);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':telefono', $telefono);

            return $stmt->execute();

        } catch (PDOException $e) {
            error_log("Error en el cliente::registrar-> " . $e->getMessage());
            return false;
        }
    }
    public function obtenerTodos()
    {
        try {
            $sql = "SELECT id_cliente, codigo_cliente, nombre, email, telefono, 
                           (SELECT COUNT(*) FROM pedidos WHERE id_cliente = c.id_cliente) as cantidad_pedidos 
                    FROM clientes c WHERE activo = 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error al obtener Cliente::obtenerTodos -> " . $e->getMessage());
            return [];
        }
    }
    public function obtenerPorId($id)
    {
        try {
            $sql = "SELECT * FROM clientes WHERE id_cliente = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Cliente::obtenerPorId -> " . $e->getMessage());
            return false;
        }
    }

    public function actualizar($id, $primer_nombre, $segundo_nombre, $primer_apellido, $segundo_apellido, $email, $telefono)
    {
        try {
            $sql = "UPDATE clientes SET primer_nombre = :pn, segundo_nombre = :sn, primer_apellido = :pa, segundo_apellido = :sa, email = :em, telefono = :tel 
                WHERE id_cliente = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':pn', $primer_nombre);
            $stmt->bindParam(':sn', $segundo_nombre);
            $stmt->bindParam(':pa', $primer_apellido);
            $stmt->bindParam(':sa', $segundo_apellido);
            $stmt->bindParam(':em', $email);
            $stmt->bindParam(':tel', $telefono);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Cliente::actualizar -> " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id)
    {
        try {
            $sql = "UPDATE clientes SET activo = 0 WHERE id_cliente = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Cliente::eliminar -> " . $e->getMessage());
            return false;
        }
    }
}
