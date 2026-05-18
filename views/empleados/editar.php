<?php
require_once __DIR__ . '/../../models/Empleado.php';
$id = $_GET['id'] ?? 0;
if (!$id) {
    header('Location: /ShopOnline_Huila/views/empleados/?error=id_invalido');
    exit;
}

$objEmpleado = new Empleado();
$empleado = $objEmpleado->obtenerPorId($id);

if (!$empleado) {
    header('Location: /ShopOnline_Huila/views/empleados/?error=no_encontrado');
    exit;
}

$cargos = $objEmpleado->obtenerCargos();

$pageTitle = 'Editar Empleado - ShopOnline Huila';
$activePage = 'empleados';
include __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-2xl mx-auto mt-8">
    <div class="mb-6 flex items-center gap-4">
        <a href="/ShopOnline_Huila/views/empleados/" class="text-on-surface-variant hover:text-primary transition-colors flex items-center justify-center p-2 rounded-full hover:bg-surface-container-high">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Editar Empleado #<?= str_pad($empleado['id_empleado'], 3, '0', STR_PAD_LEFT) ?></h2>
    </div>

    <!-- Alertas -->
    <?php if (isset($_GET['error'])): ?>
    <div class="mb-6 p-4 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-3">
        <span class="material-symbols-outlined">error</span>
        <p class="font-body-md text-body-md">Ha ocurrido un error (Código: <?= htmlspecialchars($_GET['error']) ?>).</p>
    </div>
    <?php endif; ?>

    <div class="bg-surface-container-lowest border border-surface-container-high rounded-xl p-6 shadow-sm">
        <form action="/ShopOnline_Huila/controllers/empleados/ActualizarEmpleadoController.php" method="POST" class="space-y-6">
            <input type="hidden" name="id_empleado" value="<?= $empleado['id_empleado'] ?>">
            
            <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1">Nombre Completo *</label>
                <input type="text" name="nombre" required value="<?= htmlspecialchars($empleado['nombre']) ?>" class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
            </div>
            
            <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1">Correo Electrónico *</label>
                <input type="email" name="email" required value="<?= htmlspecialchars($empleado['email']) ?>" class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
            </div>

            <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1">Cargo/Posición *</label>
                <select name="id_cargo" class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none text-on-surface bg-surface-container-lowest" required>
                    <option value="">Seleccionar cargo...</option>
                    <?php foreach ($cargos as $c): ?>
                        <option value="<?= $c['id_cargo'] ?>" <?= ($c['id_cargo'] == $empleado['id_cargo']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1">Salario (COP) *</label>
                <input type="number" name="salario" required value="<?= htmlspecialchars($empleado['salario']) ?>" class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
            </div>

            <div class="pt-4 border-t border-surface-container-high flex justify-end gap-3">
                <a href="/ShopOnline_Huila/views/empleados/" class="px-6 py-2 border border-outline-variant rounded-lg text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md">Cancelar</a>
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-lg hover:bg-primary-container transition-colors font-label-md text-label-md">Actualizar Empleado</button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
