<?php
require_once __DIR__ . '/../../models/Empleado.php';
$objEmpleado = new Empleado();
$empleados = $objEmpleado->obtenerTodos();
$cargos = $objEmpleado->obtenerCargos();

$pageTitle = 'Directorio de Empleados - ShopOnline Huila';
$activePage = 'empleados';
$searchPlaceholder = 'Buscar empleados...';
include __DIR__ . '/../layouts/header.php';
?>

<!-- Page Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background">Directorio de Empleados</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Administre el personal de operaciones y rastree asignaciones.</p>
    </div>
    <!-- <button class="bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md text-label-md flex items-center gap-2 hover:bg-primary/90 transition-colors shadow-sm">
        <span class="material-symbols-outlined text-[18px]">add</span>
        Agregar Empleado
    </button> -->
</div>

<!-- Alertas -->
<?php if (isset($_GET['success'])): ?>
<div class="mb-6 p-4 rounded-lg bg-primary-fixed text-on-primary-fixed border border-primary-fixed-dim flex items-center gap-3">
    <span class="material-symbols-outlined">check_circle</span>
    <p class="font-body-md text-body-md">Operación realizada con éxito.</p>
</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
<div class="mb-6 p-4 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-3">
    <span class="material-symbols-outlined">error</span>
    <p class="font-body-md text-body-md">Ha ocurrido un error (Código: <?= htmlspecialchars($_GET['error']) ?>).</p>
</div>
<?php endif; ?>

<!-- Bento Grid Layout -->
<div class="grid grid-cols-1 xl:grid-cols-12 gap-6">
    <!-- Quick Stats / Add Form Area (Left Column) -->
    <div class="xl:col-span-4 flex flex-col gap-6">
        <!-- Stats Card -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm">
            <h3 class="font-headline-sm text-headline-sm text-on-background mb-4">Resumen Operativo</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-surface p-4 rounded-lg border border-outline-variant/30">
                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Personal Total</p>
                    <p class="font-display-lg text-display-lg text-primary"><?= count($empleados) ?></p>
                </div>
                <div class="bg-surface p-4 rounded-lg border border-outline-variant/30">
                    <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">Entregas Activas</p>
                    <p class="font-display-lg text-display-lg text-tertiary">--</p>
                </div>
            </div>
        </div>

        <!-- Add Employee Mini Form -->
        <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm flex-1">
            <div class="flex items-center justify-between mb-6 border-b border-outline-variant/50 pb-4">
                <h3 class="font-headline-sm text-headline-sm text-on-background">Registro Rápido de Empleado</h3>
                <span class="material-symbols-outlined text-primary">person_add</span>
            </div>
            <form class="space-y-4" action="/ShopOnline_Huila/controllers/empleados/CrearEmpleadoController.php" method="POST">
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Nombre Completo</label>
                    <input name="nombre" class="w-full bg-surface-container-lowest border border-outline-variant rounded-md px-3 py-2 text-body-sm font-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="ej. Maria Gonzalez" type="text" required>
                </div>
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Correo Electrónico</label>
                    <input name="email" class="w-full bg-surface-container-lowest border border-outline-variant rounded-md px-3 py-2 text-body-sm font-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="ej. maria@empresa.com" type="email" required>
                </div>
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Contraseña</label>
                    <input name="password" class="w-full bg-surface-container-lowest border border-outline-variant rounded-md px-3 py-2 text-body-sm font-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="••••••••" type="password" required>
                </div>
                <div>
                    <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Cargo/Posición</label>
                    <select name="id_cargo" class="w-full bg-surface-container-lowest border border-outline-variant rounded-md px-3 py-2 text-body-sm font-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-on-surface" required>
                        <option value="">Seleccionar cargo...</option>
                        <?php foreach ($cargos as $c): ?>
                            <option value="<?= $c['id_cargo'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Salario (COP)</label>
                        <input name="salario" class="w-full bg-surface-container-lowest border border-outline-variant rounded-md px-3 py-2 text-body-sm font-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" placeholder="2.500.000" type="number" required>
                    </div>
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Fecha de Ingreso</label>
                        <input name="fecha_ingreso" class="w-full bg-surface-container-lowest border border-outline-variant rounded-md px-3 py-2 text-body-sm font-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all text-on-surface" type="date" required>
                    </div>
                </div>
                <button class="w-full bg-primary text-on-primary py-2.5 rounded-lg font-label-md text-label-md hover:bg-primary/90 transition-colors mt-4" type="submit">
                    Guardar Registro
                </button>
            </form>
        </div>
    </div>

    <!-- Main Employee List (Right Column) -->
    <div class="xl:col-span-8 bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col">
        <div class="p-6 border-b border-outline-variant/50 flex justify-between items-center bg-surface-container-lowest">
            <h3 class="font-headline-sm text-headline-sm text-on-background">Directorio de Personal</h3>
            <div class="flex gap-2">
                <button class="border border-outline-variant text-on-surface-variant px-3 py-1.5 rounded-md font-label-sm text-label-sm hover:bg-surface-container-low transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">filter_list</span> Filtrar
                </button>
                <button class="border border-outline-variant text-on-surface-variant px-3 py-1.5 rounded-md font-label-sm text-label-sm hover:bg-surface-container-low transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-[16px]">download</span> Exportar
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface border-b border-outline-variant/50">
                        <th class="py-3 px-6 font-label-sm text-label-sm text-on-surface-variant font-semibold">Empleado</th>
                        <th class="py-3 px-6 font-label-sm text-label-sm text-on-surface-variant font-semibold">Cargo</th>
                        <th class="py-3 px-6 font-label-sm text-label-sm text-on-surface-variant font-semibold text-right">Salario (COP)</th>
                        <th class="py-3 px-6 font-label-sm text-label-sm text-on-surface-variant font-semibold">Fecha Ingreso</th>
                        <th class="py-3 px-6 font-label-sm text-label-sm text-on-surface-variant font-semibold text-center">Despachos</th>
                        <th class="py-3 px-6 font-label-sm text-label-sm text-on-surface-variant font-semibold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/30 bg-surface-container-lowest">
                    <?php if (empty($empleados)): ?>
                        <tr><td colspan="6" class="text-center py-4 text-on-surface-variant">No hay empleados registrados.</td></tr>
                    <?php else: ?>
                        <?php foreach ($empleados as $e): 
                            $iniciales = strtoupper(substr($e['nombre'], 0, 2));
                        ?>
                        <tr class="hover:bg-surface/50 transition-colors group">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-label-md"><?= $iniciales ?></div>
                                    <div>
                                        <p class="font-table-data text-table-data font-medium text-on-background"><?= htmlspecialchars($e['nombre']) ?></p>
                                        <p class="font-body-sm text-body-sm text-on-surface-variant/70 text-xs">ID: <?= $e['id_empleado'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-secondary-container text-on-secondary-container"><?= htmlspecialchars($e['nombre_cargo']) ?></span>
                            </td>
                            <td class="py-4 px-6 font-table-data text-table-data text-right text-on-surface">$ <?= number_format($e['salario'], 0, ',', '.') ?></td>
                            <td class="py-4 px-6 font-table-data text-table-data text-on-surface-variant"><?= date('d M Y', strtotime($e['fecha_ingreso'])) ?></td>
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-surface-variant text-on-surface-variant font-label-sm text-label-sm"><?= $e['cantidad_despachos'] ?></span>
                            </td>
                            <td class="py-4 px-6 text-right whitespace-nowrap">
                                <a href="/ShopOnline_Huila/views/empleados/editar.php?id=<?= $e['id_empleado'] ?>" class="text-tertiary hover:text-tertiary-container transition-colors p-1" title="Editar">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                
                                <form action="/ShopOnline_Huila/controllers/empleados/EliminarEmpleadoController.php" method="POST" class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar este empleado?');">
                                    <input type="hidden" name="id" value="<?= $e['id_empleado'] ?>">
                                    <button type="submit" class="text-error hover:text-error-container transition-colors p-1" title="Eliminar">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- Pagination Footer -->
        <div class="p-4 border-t border-outline-variant/50 bg-surface-container-lowest flex items-center justify-between mt-auto">
            <p class="font-body-sm text-body-sm text-on-surface-variant">Total registrados: <?= count($empleados) ?></p>
            <div class="flex gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-low disabled:opacity-50" disabled>
                    <span class="material-symbols-outlined text-[18px]">chevron_left</span>
                </button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-primary bg-primary/10 text-primary font-label-sm text-label-sm">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface hover:bg-surface-container-low font-label-sm text-label-sm">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface hover:bg-surface-container-low font-label-sm text-label-sm">3</button>
                <span class="w-8 h-8 flex items-center justify-center text-on-surface-variant">...</span>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-low">
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
