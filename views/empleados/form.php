<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_GET['id']) ? 'Editar' : 'Nuevo'; ?> Empleado</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><?php echo isset($_GET['id']) ? '✏️ Editar Empleado' : '👨‍💼 Nuevo Empleado'; ?></h1>
            <p>Complete todos los campos requeridos</p>
        </div>
        <form id="empleadoForm" method="POST" action="">
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
                        <label for="cargo">* Cargo</label>
                        <select id="cargo" name="cargo" required>
                            <option value="">Seleccione cargo</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Atención al Cliente">Atención al Cliente</option>
                            <option value="Despachador">Despachador</option>
                            <option value="Almacén">Almacén</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="salario">* Salario (COP)</label>
                        <input type="text" id="salario" name="salario" required placeholder="1500000">
                    </div>
                    <div class="form-group">
                        <label for="fecha_ingreso">* Fecha de Ingreso</label>
                        <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>
                    </div>
                </div>
                <div class="form-actions">
                    <a href="index.php" class="btn" style="background:#6c757d;color:white;">Cancelar</a>
                    <button type="submit" class="btn btn-primary">💾 Guardar Empleado</button>
                </div>
            </div>
        </form>
    </div>
    <script src="../../assets/js/validations.js"></script>
</body>
</html>