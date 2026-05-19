<?php
class Conexion {
    public static function conectar() {
        // Fijar zona horaria de Colombia para date() y funciones de PHP
        date_default_timezone_set('America/Bogota');
        $host = "localhost";
        $db   = "shoponline"; // Asegúrate de usar el nuevo nombre de tu BD
        $user = "root";
        $pass = "";
        $charset = "utf8mb4";

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
            // Fijar zona horaria en MySQL para CURRENT_TIMESTAMP y NOW()
            $pdo->exec("SET time_zone = '-05:00'");
            return $pdo;
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
?>