<?php

$isEdit = isset($_GET['id']);

$id = $_GET['id'] ?? null;

$empleado = [
    'nombre' => '',
    'cargo' => '',
    'salario' => '',
    'fecha_ingreso' => ''
];

if ($id == 1) {

    $empleado = [
        'nombre' => 'Laura Martínez',
        'cargo' => '1',
        'salario' => '3500000',
        'fecha_ingreso' => '2025-05-01'
    ];

} elseif ($id == 2) {

    $empleado = [
        'nombre' => 'Carlos Pérez',
        'cargo' => '2',
        'salario' => '2100000',
        'fecha_ingreso' => '2025-04-18'
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
        <?= $isEdit ? 'Editar Empleado' : 'Nuevo Empleado'; ?>
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

                    <?= $isEdit ? 'Editar Empleado' : 'Nuevo Empleado'; ?>

                </h1>

                <p>

                    Complete la información del empleado.

                </p>

            </div>

            <form
                id="empleadoForm"
                method="POST"
                action="../../controllers/EmpleadoController.php">

                <div class="form-group">

                    <label for="nombre">

                        Nombre

                    </label>

                    <input
                        type="text"
                        id="nombre"
                        name="nombre"
                        placeholder="Ingrese el nombre"
                        value="<?= $empleado['nombre']; ?>">

                </div>

                <div class="form-group">

                    <label for="id_cargo">

                        Cargo

                    </label>

                    <select
                        id="id_cargo"
                        name="id_cargo">

                        <option value="">

                            Seleccione un cargo

                        </option>

                        <option
                            value="1"
                            <?= $empleado['cargo'] == '1' ? 'selected' : ''; ?>>

                            Administrador

                        </option>

                        <option
                            value="2"
                            <?= $empleado['cargo'] == '2' ? 'selected' : ''; ?>>

                            Vendedor

                        </option>

                        <option
                            value="3"
                            <?= $empleado['cargo'] == '3' ? 'selected' : ''; ?>>

                            Logística

                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label for="salario">

                        Salario

                    </label>

                    <input
                        type="number"
                        id="salario"
                        name="salario"
                        placeholder="Ingrese el salario"
                        value="<?= $empleado['salario']; ?>">

                </div>

                <div class="form-group">

                    <label for="fecha_ingreso">

                        Fecha de ingreso

                    </label>

                    <input
                        type="date"
                        id="fecha_ingreso"
                        name="fecha_ingreso"
                        value="<?= $empleado['fecha_ingreso']; ?>">

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

                        <?= $isEdit ? 'Actualizar Empleado' : 'Guardar Empleado'; ?>

                    </button>

                </div>

            </form>

        </section>

    </div>

    <script src="/ShopOnline_Huila/assets/js/validations.js"></script>

</body>

</html>