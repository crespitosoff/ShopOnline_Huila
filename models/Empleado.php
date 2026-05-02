<?php
class Empleado {
    private $db;

    // Al crear el objeto, le pasamos la conexión PDO
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Función para insertar un nuevo cliente
    public function registrar($nombre, $cargo, $salario, $fecha_ingreso) {
        try {
            // 1. Preparamos la plantilla SQL con marcadores (?)
            $sql = "INSERT INTO empleados (nombre, cargo, salario, fecha_ingreso) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);

            // 2. Ejecutamos pasando los datos por separado (Sentencia Preparada)
            // Esto cumple con el requisito de seguridad contra Inyección SQL
            return $stmt->execute([$nombre, $cargo, $salario, $fecha_ingreso]);
            
        } catch (PDOException $e) {
            // en caso de error en el sql
            error_log("Error en el Modelo Empleado: " . $e->getMessage());
            return false;
        }
    }
}
?>