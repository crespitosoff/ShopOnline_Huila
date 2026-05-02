<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_GET['id']) ? 'Editar' : 'Nuevo'; ?> Cliente</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo isset($_GET['id']) ? '✏️ Editar Cliente' : '👤 Nuevo Cliente'; ?></h1>
            <p>Complete todos los campos requeridos</p>
        </div>
        <form id="clienteForm" method="POST" action="">
            <div class="form-container">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nombre">* Nombre</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">* Apellido</label>
                        <input type="text" id="apellido" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="cedula">* Cédula</label>
                        <input type="text" id="cedula" name="cedula" required>
                    </div>
                    <div class="form-group">
                        <label for="email">* Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">* Teléfono</label>
                        <input type="text" id="telefono" name="telefono" required>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="index.php" class="btn" style="background:#6c757d;color:white;">Cancelar</a>
                    <button type="submit" class="btn btn-primary">💾 Guardar Cliente</button>
                </div>
            </div>
        </form>
    </div>
    <script src="../../assets/js/validations.js"></script>
</body>
</html>