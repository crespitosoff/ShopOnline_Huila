<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados - ShopOnline Huila</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👨‍💼 Gestión de Empleados</h1>
            <p>Control completo del personal</p>
        </div>
        <div class="table-container">
            <div style="margin-bottom: 20px; display: flex; justify-content: space-between;">
                <h2>Lista de Empleados</h2>
                <a href="form.php" class="btn btn-primary">➕ Nuevo Empleado</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nombre Completo</th><th>Cédula</th><th>Cargo</th><th>Salario</th><th>Fecha Ingreso</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td><td>Carlos Rodríguez</td><td>11223344</td><td>Despachador</td><td>$1.500.000</td><td>2023-06-10</td>
                        <td>
                            <a href="form.php?id=1" class="btn btn-warning" style="padding:8px 16px;font-size:14px;">Editar</a>
                            <button class="btn btn-danger" style="padding:8px 16px;font-size:14px;" onclick="confirmDelete(1)">Eliminar</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmDelete(id){
            if(confirm('¿Estás seguro de eliminar este empleado?')){
                alert('Empleado eliminado correctamente');
                location.reload();
            }
        }
    </script>
</body>
</html>