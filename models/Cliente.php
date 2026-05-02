<?php
class Cliente {
    private $db;

    // Al crear el objeto, le pasamos la conexión PDO
    public function __construct($conexion) {
        $this->db = $conexion;
    }

    // Función para insertar un nuevo cliente
    public function registrar($nombre, $email, $telefono) {
        try {
            // 1. Preparamos la plantilla SQL con marcadores (?)
            $sql = "INSERT INTO clientes (nombre, email, telefono) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($sql);

            // 2. Ejecutamos pasando los datos por separado (Sentencia Preparada)
            // Esto cumple con el requisito de seguridad contra Inyección SQL
            return $stmt->execute([$nombre, $email, $telefono]);
            
        } catch (PDOException $e) {
            // Si el email ya existe (es UNIQUE en tu DB), saltará aquí
            return false;
        }
    }
}
?>