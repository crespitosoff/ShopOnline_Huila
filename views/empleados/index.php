<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados | ShopOnline Huila</title>
    <link rel="stylesheet" href="/ShopOnline_Huila/assets/css/styles.css">
</head>

<body>

    <?php
    require_once '../../models/Empleado.php';

    $objEmpleado = new Empleado();
    $empleados = isset($empleados) ? $empleados : $objEmpleado->obtenerTodos();
    $total = count($empleados);

    $success = $_GET['success'] ?? '';
    if ($success) {
        $mensajes = ['1' => 'Empleado creado correctamente', 'update' => 'Empleado actualizado correctamente', 'delete' => 'Empleado eliminado correctamente'];
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
                <a href="/ShopOnline_Huila/views/clientes/index.php">Clientes</a>
                <a href="/ShopOnline_Huila/views/empleados/index.php" class="active">Empleados</a>
            </nav>
        </div>
    </div>

    <div class="layout">

        <div class="page-header">
            <div>
                <h1>Empleados</h1>
                <p>Gestión de empleados del sistema.</p>
            </div>
            <a href="form.php" class="btn btn-primary">+ Nuevo Empleado</a>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-icon primary">👥</div>
                <div class="stat-info">
                    <h3><?= $total ?></h3>
                    <p>Total de empleados</p>
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
                <h2>Listado de Empleados</h2>
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
                            <th>Cargo</th>
                            <th>Salario</th>
                            <th>Fecha Ingreso</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($empleados)): ?>
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">📋</div>
                                        <h3>No hay empleados registrados</h3>
                                        <p>Comienza creando un nuevo empleado.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($empleados as $e): ?>
                                <tr>
                                    <td><strong>#<?= str_pad($e['id_empleado'], 3, '0', STR_PAD_LEFT) ?></strong></td>
                                    <td><?= htmlspecialchars($e['nombre']) ?></td>
                                    <td>
                                        <span class="badge badge-primary">
                                            <?= htmlspecialchars($e['nombre_cargo'] ?? 'Sin cargo') ?>
                                        </span>
                                    </td>
                                    <td><strong>$<?= number_format($e['salario'], 0, ',', '.') ?></strong></td>
                                    <td><?= htmlspecialchars($e['fecha_ingreso']) ?></td>
                                    <td>
                                        <div class="actions">
                                            <a href="form.php?id=<?= $e['id_empleado'] ?>"
                                                class="btn btn-warning btn-sm">Editar</a>
                                            <a href="../../controllers/Empleados/EliminarEmpleadoController.php?id=<?= $e['id_empleado'] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('¿Está seguro de eliminar este registro?')">Eliminar</a>
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