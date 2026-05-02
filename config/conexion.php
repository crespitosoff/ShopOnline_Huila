<?php
// Parámetros de configuración
$host = "localhost";
$db   = "shoponline_jsj";
$user = "root";       // Usuario por defecto en XAMPP
$pass = "";           // Contraseña por defecto en XAMPP (vacía)
$charset = "utf8mb4";

// El DSN (Data Source Name) es el "string" que le dice a PDO a dónde conectarse
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// Opciones adicionales para manejar errores y formatos
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza errores si algo falla
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Devuelve los datos como arreglos asociativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Usa sentencias preparadas reales
];

try {
    // Creamos la instancia de la clase PDO
    $pdo = new PDO($dsn, $user, $pass, $options);
     // echo "Conexión exitosa"; // Solo para probar, luego lo comentamos
} catch (\PDOException $e) {
    // Si algo sale mal, atrapamos el error y lo mostramos
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>