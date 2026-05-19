<?php
require_once __DIR__ . '/../config/conexion.php';
class Empleado
{
    private $db;

    public function __construct()
    {
        // Usamos la clase Conexion para obtener el objeto PDO
        $this->db = Conexion::conectar();
    }


    public function registrar($nombre, $email, $password, $id_cargo, $salario, $fecha_ingreso)
    {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO empleados (nombre, email, password, id_cargo, salario, fecha_ingreso) 
                    VALUES (:nombre, :email, :password, :id_cargo, :salario, :fecha_ingreso)";

            $stmt = $this->db->prepare($sql);

            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
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
            $sql = "SELECT e.*, c.nombre as nombre_cargo, 
                           (SELECT COUNT(*) FROM envios WHERE id_empleado = e.id_empleado) as cantidad_despachos
                FROM empleados e 
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo
                WHERE e.activo = 1";

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
    public function actualizar($id, $nombre, $email, $id_cargo, $salario)
    {
        try {
            $sql = "UPDATE empleados SET nombre = :nom, email = :email, id_cargo = :car, salario = :sal 
                WHERE id_empleado = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nom', $nombre);
            $stmt->bindParam(':email', $email);
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
            $sql = "UPDATE empleados SET activo = 0 WHERE id_empleado = :id";
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
