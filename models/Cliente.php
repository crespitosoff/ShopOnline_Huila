<?php
require_once '../config/conexion.php';
class Cliente {
    private $db;

    // Al crear el objeto, le pasamos la conexión PDO
    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function registrar($nombre, $email, $telefono) {
        try {
            // 1. Preparamos la plantilla SQL con marcadores (?)
            $sql = "INSERT INTO clientes (nombre, email, telefono) VALUES (:nombre, :email, :telefono)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telefono', $telefono);

            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Error en el cliente::registrar-> " . $e->getMessage());
            return false;
        }
    }
        public function obtenerTodos() {
    try {
        $sql = "SELECT id_cliente, nombre, email, telefono FROM clientes";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        error_log("Error al obtener Cliente::obtenerTodos -> " . $e->getMessage());
        return []; 
    }
  }
public function obtenerPorId($id) {
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

public function actualizar($id, $nombre, $email, $telefono) {
    try {
        $sql = "UPDATE clientes SET nombre = :nom, email = :em, telefono = :tel 
                WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nombre);
        $stmt->bindParam(':em', $email);
        $stmt->bindParam(':tel', $telefono);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error en Cliente::actualizar -> " . $e->getMessage());
        return false;
    }
 }

 public function eliminar($id) {
    try {
        $sql = "DELETE FROM clientes WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error en Cliente::eliminar -> " . $e->getMessage());
        return false;
    }
}
}