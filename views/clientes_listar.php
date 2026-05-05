<?php 
require_once '../controllers/Clientes_Controller.php'; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Clientes - ShopOnline</title>
    <link rel="stylesheet" href="../assets/css.css">
</head>
<body>
    <div class="container">
        <h2> Clientes</h2>
        
        <a href="clientes_crear.php">Registrar Nuevo Cliente</a>
        <br><br>

        <table border="1">
            <thead>
                <tr>
                    <th>ID :</th>
                    <th>Nombre :</th>
                    <th>Email :</th>
                    <th>Teléfono :</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $cli): ?>
                        <tr>
                            <td><?php echo $cli['id_cliente']; ?></td>
                            <td><?php echo $cli['nombre']; ?></td>
                            <td><?php echo $cli['email']; ?></td>
                            <td><?php echo $cli['telefono'] ? $cli['telefono'] : 'No existe telefono'; ?></td>
                            <td>
                                 <a href="clientes_editar.php?action=editar&id=<?php echo $cli['id_cliente']; ?>">
                                   Editar
                                 </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No hay clientes registrados en el sistema.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>