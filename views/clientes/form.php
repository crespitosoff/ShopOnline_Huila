<?php

require_once '../../models/Cliente.php';

$isEdit = isset($_GET['id']);
$id = $_GET['id'] ?? null;

$cliente = [
    'id_cliente' => '',
    'nombre' => '',
    'email' => '',
    'telefono' => ''
];

if ($isEdit) {
    $objCliente = new Cliente();
    $data = $objCliente->obtenerPorId($id);
    if ($data) {
        $cliente = $data;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Editar Cliente' : 'Nuevo Cliente' ?> | ShopOnline Huila</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>

<body>

    <div class="topbar">
        <div class="topbar-inner">
            <a href="../../" class="brand">
                <span class="brand-icon">SH</span>
                ShopOnline Huila
            </a>
            <nav class="topbar-nav">
                <a href="../../views/clientes/index.php">Clientes</a>
                <a href="../../views/empleados/index.php">Empleados</a>
            </nav>
        </div>
    </div>

    <div class="layout">

        <a href="index.php" class="back-link">← Volver al listado</a>

        <section class="form-card">

            <div class="form-header">
                <h1><?= $isEdit ? 'Editar Cliente' : 'Nuevo Cliente' ?></h1>
                <p>Complete la información del cliente.</p>
            </div>

            <form id="clienteForm" method="POST"
                action="../../controllers/Clientes/<?= $isEdit ? 'ActualizarClienteController.php' : 'CrearClienteController.php' ?>">

                <?php if ($isEdit): ?>
                    <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <div class="input-wrapper">
                        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre"
                            value="<?= htmlspecialchars($cliente['nombre']) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" placeholder="correo@ejemplo.com"
                            value="<?= htmlspecialchars($cliente['email']) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <div class="input-wrapper">
                        <input type="text" id="telefono" name="telefono" placeholder="3001234567"
                            value="<?= htmlspecialchars($cliente['telefono']) ?>">
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <?= $isEdit ? 'Actualizar Cliente' : 'Guardar Cliente' ?>
                    </button>
                </div>

            </form>

        </section>

    </div>

    <script src="../../assets/js/validations_v2.js"></script>

</body>

</html>