<?php
require_once __DIR__ . '/../config/conexion.php';

class Categoria
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::conectar();
    }

    public function obtenerTodas()
    {
        try {
            $sql = "SELECT * FROM categorias";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Categoria::obtenerTodas -> " . $e->getMessage());
            return [];
        }
    }
}
