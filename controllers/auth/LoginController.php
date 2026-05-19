<?php
session_start();
require_once __DIR__ . '/../../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        header("Location: ../../views/login.php?error=" . urlencode("Por favor, ingrese sus credenciales."));
        exit;
    }

    try {
        $db = Conexion::conectar();
        
        // Buscar empleado por email
        $sql = "SELECT e.*, 
                       TRIM(CONCAT_WS(' ', NULLIF(e.primer_nombre,''), NULLIF(e.segundo_nombre,''), NULLIF(e.primer_apellido,''), NULLIF(e.segundo_apellido,''))) as nombre,
                       c.nombre as nombre_cargo 
                FROM empleados e 
                INNER JOIN cargos c ON e.id_cargo = c.id_cargo
                WHERE e.email = :email AND e.activo = 1";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $isValid = false;
            // Soporte para contraseñas en texto plano (script de datos) o hasheadas
            if (strpos($user['password'], '$2y$') === 0) {
                $isValid = password_verify($password, $user['password']);
            } else {
                $isValid = ($password === $user['password']);
            }

            if ($isValid) {
                // Iniciar sesión
                $_SESSION['empleado_id'] = $user['id_empleado'];
                $_SESSION['empleado_primer_nombre'] = $user['primer_nombre'];
                $_SESSION['empleado_primer_apellido'] = $user['primer_apellido'];
                $_SESSION['empleado_cargo'] = $user['nombre_cargo'];
                $_SESSION['empleado_id_cargo'] = $user['id_cargo'];
                
                header("Location: ../../views/dashboard/");
                exit;
            } else {
                header("Location: ../../views/login.php?error=" . urlencode("Contraseña incorrecta."));
                exit;
            }
        } else {
            header("Location: ../../views/login.php?error=" . urlencode("El correo no está registrado o la cuenta está inactiva."));
            exit;
        }

    } catch (PDOException $e) {
        error_log("Error en Login: " . $e->getMessage());
        header("Location: ../../views/login.php?error=" . urlencode("Error de conexión. Intente más tarde."));
        exit;
    }
} else {
    header("Location: ../../views/login.php");
    exit;
}
