<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Empleado - ShopOnline</title>
    <link rel="stylesheet" href="../assets/css/css.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Nuevo Empleado</h2>
        
        <!-- El action apunta al controlador que procesará los datos -->
        <form action="../controllers/Empleados_Controller.php?action=crear" method="POST">
            <div>
                <label>Nombre:</label>
                <input type="text" name="nombre" required placeholder="Nombre completo">
            </div>

            <div>
                <label>Cargo:</label>
                <input type="text" name="cargo" required placeholder="Gerente, Vendedor, etc.">
            </div>

            <div>
                <label>Salario</label>
                <input type="number" step=0.01 name="salario"required placeholder="1000000">
            </div>
            
            <div>
                <label>Fecha de Ingreso</label>
                <input type="date" name="fecha_ingreso" required>
            </div>
            

           <!-- <div>
                <label>Email:</label>
                <input type="email" name="email" required placeholder="ejemplo@correo.com">
            </div>
            
            <div>
                <label>Teléfono:</label>
                <input type="text" name="telefono" placeholder="Opcional">
            </div> -->
            
            <button type="submit">Guardar Empleado</button>
            <a href="index.php">Cancelar</a>
        </form>
    </div>
</body>
</html>