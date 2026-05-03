<?php

$isEdit = isset($_GET['id']);

$id = $_GET['id'] ?? null;

$cliente = [
    'nombre' => '',
    'email' => '',
    'telefono' => ''
];

if ($id == 1) {

    $cliente = [
        'nombre' => 'María González',
        'email' => 'maria@email.com',
        'telefono' => '3001234567'
    ];

} elseif ($id == 2) {

    $cliente = [
        'nombre' => 'Carlos Ramírez',
        'email' => 'carlos@email.com',
        'telefono' => '3019876543'
    ];

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= $isEdit ? 'Editar Cliente' : 'Nuevo Cliente'; ?>
    </title>

    <link
        rel="stylesheet"
        href="/ShopOnline_Huila/assets/css/styles.css">

</head>

<body>

    <div class="layout">

        <section class="form-card">

            <div class="form-header">

                <h1>

                    <?= $isEdit ? 'Editar Cliente' : 'Nuevo Cliente'; ?>

                </h1>

                <p>

                    Complete la información del cliente.

                </p>

            </div>

            <form
                id="clienteForm"
                method="POST"
                action="../../controllers/ClienteController.php">

                <div class="form-group">

                    <label for="nombre">

                        Nombre

                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingrese el nombre"
                        value="<?= $cliente['nombre']; ?>">

                </div>

                <div class="form-group">

                    <label for="email">

                        Correo Electrónico

                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="correo@ejemplo.com"
                        value="<?= $cliente['email']; ?>">

                </div>

                <div class="form-group">

                    <label for="telefono">

                        Teléfono

                    </label>

                    <input
                        type="text"
                        id="telefono"
                        name="telefono"
                        placeholder="3001234567"
                        value="<?= $cliente['telefono']; ?>">

                </div>

                <div class="form-actions">

                    <a
                        href="index.php"
                        class="btn btn-secondary">

                        Cancelar

                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <?= $isEdit ? 'Actualizar Cliente' : 'Guardar Cliente'; ?>

                    </button>

                </div>

            </form>

        </section>

    </div>

    <script src="/ShopOnline_Huila/assets/js/validations.js"></script>

</body>

</html>