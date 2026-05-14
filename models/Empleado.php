<?php
require_once '../config/conexion.php';
class Empleado
{
    private $db;

    public function __construct()
    {
        // Usamos la clase Conexion para obtener el objeto PDO
        $this->db = Conexion::conectar();
    }


    public function registrar($nombre, $id_cargo, $salario, $fecha_ingreso)
    {
        try {
            // El SQL ahora pide id_cargo porque es una relación con la tabla cargos
            $sql = "INSERT INTO empleados (nombre, id_cargo, salario, fecha_ingreso) 
                    VALUES (:nombre, :id_cargo, :salario, :fecha_ingreso)";

            $stmt = $this->db->prepare($sql);

            // Vinculamos los parámetros usando PDO para mayor seguridad
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':id_cargo', $id_cargo, PDO::PARAM_INT);
            $stmt->bindParam(':salario', $salario);
            $stmt->bindParam(':fecha_ingreso', $fecha_ingreso);

            // Retorna verdadero si se insertó correctamente[cite: 1]
            return $stmt->execute();

        } catch (PDOException $e) {
            // Si algo falla, nos avisa qué pasó
            error_log("Error en el Empleado::registrar -> " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodos()
    {
        try {
            // Usamos INNER JOIN para unir la tabla empleados con cargos
            $sql = "SELECT e.*, c.nombre as nombre_cargo 
                FROM empleados e 
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            // fetchAll devuelve un arreglo con todos los registros encontrados
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log("Error en obtenerTodos: " . $e->getMessage());
            return []; // Devolvemos un arreglo vacío si algo falla
        }
    }

    public function obtenerPorId($id)
    {
        try {
            $sql = "SELECT * FROM empleados WHERE id_empleado = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("Error en obtenerPorId: " . $e->getMessage());
            return null;
        }
    }
    public function actualizar($id, $nombre, $id_cargo, $salario)
    {
        try {
            $sql = "UPDATE empleados SET nombre = :nom, id_cargo = :car, salario = :sal 
                WHERE id_empleado = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nom', $nombre);
            $stmt->bindParam(':car', $id_cargo, PDO::PARAM_INT);
            $stmt->bindParam(':sal', $salario);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function eliminar($id)
    {
        try {
            $sql = "DELETE FROM empleados WHERE id_empleado = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public function obtenerCargos()
    {
        try {
            // Traemos todos los cargos disponibles para el formulario
            $sql = "SELECT id_cargo, nombre FROM cargos";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener cargos: " . $e->getMessage());
            return [];
        }
    }
}
