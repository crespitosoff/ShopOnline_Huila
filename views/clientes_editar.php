<?php require_once '../controllers/Clientes_Controller.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente - ShopOnline</title>
</head>
<body>
    <div class="container">
        <h2>Editar Datos del Cliente</h2>
        
    
        <form action="../controllers/Clientes_Controller.php?action=actualizar" method="POST">
            
            <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">

            <label>Nombre Completo :</label><br>
            <input type="text" name="nombre" value="<?php echo $cliente['nombre']; ?>" required><br><br>

            <label>Correo Electrónico :</label><br>
            <input type="email" name="email" value="<?php echo $cliente['email']; ?>" required><br><br>

            <label>Teléfono :</label><br>
            <input type="text" name="telefono" value="<?php echo $cliente['telefono']; ?>"><br><br>

            <button type="submit">Guardar Cambios</button>
            <a href="clientes_listar.php">Cancelar</a>
        </form>
    </div>
</body>
</html>