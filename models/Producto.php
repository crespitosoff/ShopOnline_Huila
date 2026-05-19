<?php
require_once __DIR__ . '/../config/conexion.php';

class Producto
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function registrar($id_categoria, $nombre, $precio, $stock, $descripcion)
    {
        try {
            $sql = "INSERT INTO productos (id_categoria, nombre, precio, stock, descripcion) 
                    VALUES (:id_categoria, :nombre, :precio, :stock, :descripcion)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':descripcion', $descripcion);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Producto::registrar -> " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodos()
    {
        try {
            $sql = "SELECT p.*, c.nombre as nombre_categoria 
                    FROM productos p 
                    INNER JOIN categorias c ON p.id_categoria = c.id_categoria 
                    WHERE p.activo = 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Producto::obtenerTodos -> " . $e->getMessage());
            return [];
        }
    }

    public function obtenerPorId($id)
    {
        try {
            $sql = "SELECT * FROM productos WHERE id_producto = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("Error en Producto::obtenerPorId -> " . $e->getMessage());
            return null;
        }
    }

    public function actualizar($id, $id_categoria, $nombre, $precio, $stock, $descripcion)
    {
        try {
            $sql = "UPDATE productos SET id_categoria = :id_categoria, nombre = :nombre, precio = :precio, stock = :stock, descripcion = :descripcion WHERE id_producto = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_INT);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Producto::actualizar -> " . $e->getMessage());
            return false;
        }
    }

    public function eliminar($id)
    {
        try {
            $sql = "UPDATE productos SET activo = 0 WHERE id_producto = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Producto::eliminar -> " . $e->getMessage());
            return false;
        }
    }

    public function obtenerCategorias()
    {
        try {
            $sql = "SELECT * FROM categorias";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Producto::obtenerCategorias -> " . $e->getMessage());
            return [];
        }
    }
}
