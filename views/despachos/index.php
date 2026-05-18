<?php
require_once __DIR__ . '/../../models/Despacho.php';
require_once __DIR__ . '/../../models/Empleado.php';

$objDespacho = new Despacho();
$despachos = $objDespacho->obtenerTodos();

$objEmpleado = new Empleado();
$empleados = $objEmpleado->obtenerTodos();

$pageTitle = 'Centro de Despachos - ShopOnline Huila';
$activePage = 'despachos';
$searchPlaceholder = 'Buscar pedidos, rastreo...';
include __DIR__ . '/../layouts/header.php';
?>

<!-- Page Header -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-lg">
    <div>
        <h2 class="font-headline-lg text-headline-lg text-on-background">Centro de Despachos</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Administre y asigne envíos listos para su cumplimiento.</p>
    </div>
    <div class="flex gap-3">
        <button class="bg-surface-container-lowest border border-outline text-on-surface font-label-md text-label-md px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-surface-container-low transition-colors">
            <span class="material-symbols-outlined text-[18px]">download</span>
            Exportar Manifiesto
        </button>
    </div>
</div>

<!-- Alertas -->
<?php if (isset($_GET['success'])): ?>
<div class="mb-6 p-4 rounded-lg bg-primary-fixed text-on-primary-fixed border border-primary-fixed-dim flex items-center gap-3">
    <span class="material-symbols-outlined">check_circle</span>
    <p class="font-body-md text-body-md">Logística actualizada correctamente.</p>
</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
<div class="mb-6 p-4 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-3">
    <span class="material-symbols-outlined">error</span>
    <p class="font-body-md text-body-md">Ha ocurrido un error (Código: <?= htmlspecialchars($_GET['error']) ?>).</p>
</div>
<?php endif; ?>

<!-- Bento Grid Metrics -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-lg">
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-secondary-container text-on-secondary-container rounded-lg">
                <span class="material-symbols-outlined">hourglass_top</span>
            </div>
            <span class="font-label-sm text-label-sm text-primary bg-primary-fixed py-1 px-2 rounded-full">Alta Prioridad</span>
        </div>
        <?php
            $pendientes = count(array_filter($despachos, fn($d) => $d['id_estado'] == 1));
            $enTransito = count(array_filter($despachos, fn($d) => $d['id_estado'] == 2));
            $entregados = count(array_filter($despachos, fn($d) => $d['id_estado'] == 3));
        ?>
        <div>
            <p class="font-display-lg text-display-lg text-on-surface"><?= $pendientes ?></p>
            <p class="font-body-md text-body-md text-on-surface-variant">Pendientes de Despacho</p>
        </div>
    </div>
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-tertiary-container text-on-tertiary-container rounded-lg">
                <span class="material-symbols-outlined">local_shipping</span>
            </div>
        </div>
        <div>
            <p class="font-display-lg text-display-lg text-on-surface"><?= $enTransito ?></p>
            <p class="font-body-md text-body-md text-on-surface-variant">En Tránsito</p>
        </div>
    </div>
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-surface-variant text-on-surface-variant rounded-lg">
                <span class="material-symbols-outlined">inventory_2</span>
            </div>
        </div>
        <div>
            <p class="font-display-lg text-display-lg text-on-surface"><?= $entregados ?></p>
            <p class="font-body-md text-body-md text-on-surface-variant">Total Entregados</p>
        </div>
    </div>
</div>

<!-- Data Table Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl flex-1 flex flex-col overflow-hidden">
    <div class="px-6 py-4 border-b border-surface-variant flex justify-between items-center bg-surface-bright">
        <h3 class="font-headline-sm text-headline-sm text-on-surface">Pedidos Listos para Despacho</h3>
        <button class="text-primary font-label-sm text-label-sm hover:underline flex items-center gap-1">
            Ver Todo <span class="material-symbols-outlined text-[16px]">chevron_right</span>
        </button>
    </div>
    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse min-w-[1000px]">
            <thead>
                <tr class="border-b border-surface-variant bg-surface-container-low text-on-surface-variant font-label-md text-label-md uppercase tracking-wider">
                    <th class="py-3 px-6 font-semibold">ID Pedido</th>
                    <th class="py-3 px-6 font-semibold">Cliente</th>
                    <th class="py-3 px-6 font-semibold">Dirección de Envío</th>
                    <th class="py-3 px-6 font-semibold">Fecha</th>
                    <th class="py-3 px-6 font-semibold">Empleado Asignado</th>
                    <th class="py-3 px-6 font-semibold">Estado</th>
                    <th class="py-3 px-6 font-semibold text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="font-table-data text-table-data text-on-surface divide-y divide-surface-variant">
                <?php if (empty($despachos)): ?>
                    <tr><td colspan="7" class="text-center py-4 text-on-surface-variant">No hay envíos registrados.</td></tr>
                <?php else: ?>
                    <?php foreach ($despachos as $d): 
                        $estadoId = (int)$d['id_estado'];
                        $estadoClass = 'bg-surface-variant text-on-surface-variant';
                        $estadoLabel = 'En Preparación';
                        
                        if ($estadoId == 2) {
                            $estadoClass = 'bg-tertiary-container text-on-tertiary-container';
                            $estadoLabel = 'En Camino';
                        } elseif ($estadoId == 3) {
                            $estadoClass = 'bg-secondary-container text-on-secondary-container opacity-80';
                            $estadoLabel = 'Entregado';
                        }
                        
                        // Generar iniciales del cliente
                        $iniciales = strtoupper(substr($d['nombre_cliente'], 0, 2));
                    ?>
                    <tr class="hover:bg-primary-fixed/10 transition-colors group <?= $estadoId == 1 ? 'bg-surface-container-lowest' : '' ?>">
                        <td class="py-4 px-6 font-medium text-primary">#ORD-<?= str_pad($d['id_pedido'], 4, '0', STR_PAD_LEFT) ?></td>
                        <td class="py-4 px-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant font-bold text-xs"><?= $iniciales ?></div>
                                <span class="whitespace-nowrap"><?= htmlspecialchars($d['nombre_cliente']) ?></span>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-on-surface-variant truncate max-w-[200px]" title="<?= htmlspecialchars($d['direccion_envio']) ?>"><?= htmlspecialchars($d['direccion_envio']) ?></td>
                        <td class="py-4 px-6 text-on-surface-variant whitespace-nowrap"><?= date('d M, h:i A', strtotime($d['fecha_envio'])) ?></td>
                        
                        <td class="py-4 px-6">
                            <?php if ($estadoId == 1): ?>
                            <form id="form-despacho-<?= $d['id_envio'] ?>" action="/ShopOnline_Huila/controllers/despachos/AvanzarDespachoController.php" method="POST" class="m-0">
                                <input type="hidden" name="id_envio" value="<?= $d['id_envio'] ?>">
                                <input type="hidden" name="accion" value="despachar">
                                <select name="id_empleado" class="bg-surface-container border border-outline-variant text-on-surface text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2 outline-none">
                                    <?php foreach ($empleados as $emp): ?>
                                        <option value="<?= $emp['id_empleado'] ?>"><?= htmlspecialchars($emp['nombre']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                            <?php else: ?>
                                <span class="text-sm font-medium text-on-surface-variant"><?= htmlspecialchars($d['nombre_empleado']) ?></span>
                                <div class="text-xs text-outline mt-1 font-mono tracking-widest"><?= htmlspecialchars($d['guia_rastreo']) ?></div>
                            <?php endif; ?>
                        </td>
                        
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full font-label-sm text-label-sm <?= $estadoClass ?> whitespace-nowrap"><?= $estadoLabel ?></span>
                        </td>
                        
                        <td class="py-4 px-6 text-right space-x-2 whitespace-nowrap">
                            <?php if ($estadoId == 1): ?>
                                <button type="submit" form="form-despacho-<?= $d['id_envio'] ?>" class="bg-primary text-on-primary px-3 py-1.5 rounded-lg font-label-sm text-label-sm hover:bg-primary-container hover:text-on-primary-container transition-colors">Despachar</button>
                            <?php elseif ($estadoId == 2): ?>
                                <form action="/ShopOnline_Huila/controllers/despachos/AvanzarDespachoController.php" method="POST" class="inline m-0">
                                    <input type="hidden" name="id_envio" value="<?= $d['id_envio'] ?>">
                                    <input type="hidden" name="accion" value="confirmar_entrega">
                                    <button type="submit" class="bg-secondary text-on-secondary px-3 py-1.5 rounded-lg font-label-sm text-label-sm hover:bg-secondary-container hover:text-on-secondary-container transition-colors">Entregar</button>
                                </form>
                            <?php elseif ($estadoId == 3): ?>
                                <span class="text-secondary font-label-sm text-label-sm px-3 py-1.5"><?= date('d M, h:i A', strtotime($d['fecha_entrega'])) ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
