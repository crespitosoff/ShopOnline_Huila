<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Cliente - ShopOnline</title>
    <link rel="stylesheet" href="../assets/css.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Nuevo Cliente</h2>

        <?php if (isset($_GET['error'])): ?>
            <div style="color: red; margin-bottom: 15px;">
                <?php 
                    if($_GET['error'] == 'campos_obligatorios') echo "Nombre y Email son obligatorios.";
                    if($_GET['error'] == 'error_tecnico') echo "Error al guardar. El correo ya podría estar registrado.";
                ?>
            </div>
        <?php endif; ?>
        
        <!-- El action apunta al controlador que procesará los datos -->
        <form action="../controllers/Clientes_Controller.php?action=crear" method="POST">
            <div>
                <label>Nombre *:</label>
                <input type="text" name="nombre" required placeholder="Nombre completo">
            </div>
            
            <div>
                <label>Email *:</label>
                <input type="email" name="email" required placeholder="ejemplo@correo.com">
            </div>
            
            <div>
                <label>Teléfono:</label>
                <input type="text" name="telefono" placeholder="Opcional">
            </div>
            
            <button type="submit">Guardar Cliente</button>
            <a href="index.php">Cancelar</a>
        </form>
    </div>
</body>
</html>