<?php 
require_once '../controllers/Empleados_Controller.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Empleados - ShopOnline</title>
    <link rel="stylesheet" href="../assets/css.css">
</head>
<body>
    <div class="container">
        <h2>Listado de Empleados</h2>     
        <a href="empleados_crear.php">Registrar Nuevo Empleado</a>
        <br><br>

        <table border="1">
            <thead>
                <tr>
                    <th>ID : </th>
                    <th>Nombre : </th>
                    <th>Cargo :</th>
                    <th>Salario :</th>
                    <th>Fecha de Ingreso :</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($empleados)): ?>
                    <?php foreach ($empleados as $emp): ?>
                        <tr>
                            <td><?php echo $emp['id_empleado']; ?></td>
                            <td><?php echo $emp['nombre']; ?></td>
                            <td><?php echo $emp['nombre_cargo']; ?></td> <!-- Viene del INNER JOIN -->
                            <td>$<?php echo number_format($emp['salario'], 2); ?></td>
                            <td><?php echo $emp['fecha_ingreso']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>  
                    <tr>
                        <td colspan="5">No hay empleados registrados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>