<?php

require_once '../../models/Empleado.php';

$isEdit = isset($_GET['id']);
$id = $_GET['id'] ?? null;

$empleado = [
    'id_empleado' => '',
    'nombre' => '',
    'id_cargo' => '',
    'salario' => '',
    'fecha_ingreso' => ''
];

if ($isEdit) {
    $objEmpleado = new Empleado();
    $data = $objEmpleado->obtenerPorId($id);
    if ($data) {
        $empleado = $data;
    }
}

$objCargos = new Empleado();
$cargosList = $objCargos->obtenerCargos();
$cargos = [];
foreach ($cargosList as $c) {
    $cargos[$c['id_cargo']] = $c['nombre'];
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $isEdit ? 'Editar Empleado' : 'Nuevo Empleado' ?> | ShopOnline Huila</title>
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
                <h1><?= $isEdit ? 'Editar Empleado' : 'Nuevo Empleado' ?></h1>
                <p>Complete la información del empleado.</p>
            </div>

            <form id="empleadoForm" method="POST"
                action="../../controllers/Empleados/<?= $isEdit ? 'ActualizarEmpleadoController.php' : 'CrearEmpledoController.php' ?>">

                <?php if ($isEdit): ?>
                    <input type="hidden" name="id_empleado" value="<?= $empleado['id_empleado'] ?>">
                <?php endif; ?>

                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <div class="input-wrapper">
                        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre"
                            value="<?= htmlspecialchars($empleado['nombre']) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="id_cargo">Cargo</label>
                    <div class="input-wrapper">
                        <select id="id_cargo" name="id_cargo">
                            <option value="">Seleccione un cargo</option>
                            <?php foreach ($cargos as $val => $label): ?>
                                <option value="<?= $val ?>" <?= $empleado['id_cargo'] == $val ? 'selected' : '' ?>>
                                    <?= $label ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="salario">Salario</label>
                    <div class="input-wrapper">
                        <input type="number" id="salario" name="salario" placeholder="Ingrese el salario"
                            value="<?= htmlspecialchars($empleado['salario']) ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="fecha_ingreso">Fecha de ingreso</label>
                    <div class="input-wrapper">
                        <input type="date" id="fecha_ingreso" name="fecha_ingreso"
                            value="<?= htmlspecialchars($empleado['fecha_ingreso']) ?>">
                    </div>
                </div>

                <div class="form-actions">
                    <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">
                        <?= $isEdit ? 'Actualizar Empleado' : 'Guardar Empleado' ?>
                    </button>
                </div>

            </form>

        </section>

    </div>

    <script src="../../assets/js/validations_v2.js"></script>

</body>

</html>