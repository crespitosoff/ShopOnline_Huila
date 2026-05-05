<?php 
require_once '../controllers/Empleados_Controller.php'; 
// Al incluir el controlador con action=editar, ya tenemos disponibles:
// $empleado (los datos actuales) y $cargos (la lista para el select)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Empleado - ShopOnline</title>
    <link rel="stylesheet" href="../assets/css.css">
</head>
<body>
    <div class="container">
        <h2>Editar Empleado</h2>

        <form action="../controllers/Empleados_Controller.php?action=actualizar" method="POST">
            <!-- Campo oculto indispensable para el WHERE del SQL -->
            <input type="hidden" name="id_empleado" value="<?php echo $empleado['id_empleado']; ?>">

            <div class="form-group">
                <label>Nombre Completo:</label>
                <input type="text" name="nombre" value="<?php echo $empleado['nombre']; ?>" required>
            </div>

            <div class="form-group">
                <label>Cargo Actual:</label>
                <select name="id_cargo" required>
                    <?php foreach ($cargos as $car): ?>
                        <option value="<?php echo $car['id_cargo']; ?>" 
                            <?php echo ($car['id_cargo'] == $empleado['id_cargo']) ? 'selected' : ''; ?>>
                            <?php echo $car['nombre_cargo']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Salario:</label>
                <input type="number" step="0.01" name="salario" value="<?php echo $empleado['salario']; ?>" required>
            </div>

            <div class="botones">
                <button type="submit">Actualizar Datos</button>
                <a href="empleados_listar.php" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>