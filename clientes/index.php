<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - ShopOnline Huila</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👥 Gestión de Clientes</h1>
            <p>Lista completa de clientes registrados</p>
        </div>
        <div class="table-container">
            <div style="margin-bottom: 20px; display: flex; justify-content: space-between;">
                <h2>Lista de Clientes</h2>
                <a href="form.php" class="btn btn-primary">➕ Nuevo Cliente</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th><th>Nombre Completo</th><th>Cédula</th><th>Email</th><th>Teléfono</th><th>Fecha Registro</th><th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td><td>Juan Pérez</td><td>12345678</td><td>juan@email.com</td><td>3001234567</td><td>2024-01-15</td>
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
            if(confirm('¿Estás seguro de eliminar este cliente?')){
                alert('Cliente eliminado correctamente');
                location.reload();
            }
        }
    </script>
</body>
</html>