<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes | ShopOnline Huila</title>
    <link rel="stylesheet" href="/ShopOnline_Huila/assets/css/styles.css">
</head>

<body>

<?php
require_once '../../models/Cliente.php';

$objCliente = new Cliente();
$clientes = isset($clientes) ? $clientes : $objCliente->obtenerTodos();
$total = count($clientes);

$success = $_GET['success'] ?? '';
if ($success) {
    $mensajes = ['1' => 'Cliente creado correctamente', 'update' => 'Cliente actualizado correctamente', 'Eliminado' => 'Cliente eliminado correctamente'];
    if (isset($mensajes[$success])) {
        echo '<div class="notification success show">' . $mensajes[$success] . '</div>';
    }
}
?>

<div class="topbar">
    <div class="topbar-inner">
        <a href="/ShopOnline_Huila/" class="brand">
            <span class="brand-icon">SH</span>
            ShopOnline Huila
        </a>
        <nav class="topbar-nav">
            <a href="/ShopOnline_Huila/views/clientes/index.php" class="active">Clientes</a>
            <a href="/ShopOnline_Huila/views/empleados/index.php">Empleados</a>
        </nav>
    </div>
</div>

<div class="layout">

    <div class="page-header">
        <div>
            <h1>Clientes</h1>
            <p>Gestión y administración de clientes.</p>
        </div>
        <a href="form.php" class="btn btn-primary">+ Nuevo Cliente</a>
    </div>

    <div class="stats">
        <div class="stat-card">
            <div class="stat-icon primary">👤</div>
            <div class="stat-info">
                <h3><?= $total ?></h3>
                <p>Total de clientes</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon success">✓</div>
            <div class="stat-info">
                <h3><?= $total ?></h3>
                <p>Registros activos</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h2>Listado de Clientes</h2>
            <span style="font-size:0.85rem;color:var(--text-secondary);font-weight:500;">
                <?= $total ?> registro(s)
            </span>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clientes)): ?>
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <div class="empty-state-icon">📋</div>
                                <h3>No hay clientes registrados</h3>
                                <p>Comienza creando un nuevo cliente.</p>
                            </div>
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($clientes as $c): ?>
                    <tr>
                        <td><strong>#<?= str_pad($c['id_cliente'], 3, '0', STR_PAD_LEFT) ?></strong></td>
                        <td><?= htmlspecialchars($c['nombre']) ?></td>
                        <td><?= htmlspecialchars($c['email']) ?></td>
                        <td><?= htmlspecialchars($c['telefono']) ?></td>
                        <td>
                            <div class="actions">
                                <a href="form.php?id=<?= $c['id_cliente'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="../../controllers/Clientes/EliminarClienteController.php?id=<?= $c['id_cliente'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este registro?')">Eliminar</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>