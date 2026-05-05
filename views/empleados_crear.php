<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Empleado - ShopOnline</title>
    <link rel="stylesheet" href="../assets/css.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Nuevo Empleado</h2>

        <?php if (isset($_GET['error'])): ?>
            <div style="color: red; margin-bottom: 15px;">
                <?php 
                    if($_GET['error'] == 'campos_obligatorios') echo "Todos los campos con * son obligatorios.";
                    if($_GET['error'] == 'salario_invalido') echo "El salario debe ser un número mayor a 0.";
                    if($_GET['error'] == 'error_tecnico') echo "Hubo un fallo en el servidor. Intente más tarde.";
                ?>
            </div>
        <?php endif; ?>      
        
        , 
        <!-- El action apunta al controlador que procesará los datos -->
        <form action="../controllers/Empleados_Controller.php?action=crear" method="POST">
            <div>
                <label>Nombre *:</label>
                <input type="text" name="nombre" required placeholder="Nombre completo">
            </div>

            <div>
                <label for="id_cargo">Cargo *:</label>
                <select name="id_cargo" id="id_cargo" required>
                <option value="">Seleccione un cargo</option>
                <option value="1">Administrador</option>
                <option value="2">Vendedor</option>
                <option value="3">Cajero</option>
                </select>
            </div>

            <div>
                <label>Salario *:</label>
                <input type="number" step=0.01 name="salario"required placeholder="1000000">
            </div>
            
            <div>
                <label>Fecha de Ingreso *:</label>
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