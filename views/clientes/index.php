<?php
/**
 * Gestión de Clientes
 * Accesible desde: Sidebar > "Clientes"
 */
require_once __DIR__ . '/../../models/Cliente.php';
$objCliente = new Cliente();
$clientes = $objCliente->obtenerTodos();

$pageTitle = 'Gestión de Clientes - ShopOnline Huila';
$activePage = 'clientes';
$searchPlaceholder = 'Buscar clientes...';
include __DIR__ . '/../layouts/header.php';
?>

<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-lg">
    <div>
        <!-- Breadcrumb -->
        <!-- <nav class="flex items-center gap-2 font-label-sm text-label-sm text-on-surface-variant mb-2">
            <a href="/ShopOnline_Huila/views/reportes/" class="hover:text-primary transition-colors">Reportes</a>
            <span class="material-symbols-outlined text-[16px]">chevron_right</span>
            <span class="text-on-surface">Pedidos por Cliente</span>
        </nav> -->
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Directorio de Clientes</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Gestione la información y el historial de pedidos de sus clientes.</p>
    </div>
    <a href="/ShopOnline_Huila/views/clientes/crear.php" class="bg-primary text-on-primary font-label-md text-label-md px-6 py-3 rounded-lg hover:bg-primary-container transition-colors flex items-center justify-center shadow-sm">
        <span class="material-symbols-outlined mr-2 text-[18px]">add</span>
        Añadir Cliente
    </a>
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



<!-- Table Section -->
<div class="bg-surface-container-lowest rounded-xl border border-surface-container-high shadow-sm overflow-hidden flex-1 flex flex-col">
    <!-- Toolbar -->
    <div class="p-4 border-b border-surface-container-high flex flex-col sm:flex-row gap-4 justify-between items-center bg-surface-bright">
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                <input class="local-search-input w-full pl-10 pr-4 py-2 border border-outline-variant rounded-lg font-body-sm text-body-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest" placeholder="Buscar por nombre o ID..." type="text">
            </div>
            <!-- <button class="px-4 py-2 border border-outline-variant rounded-lg font-label-md text-label-md text-on-surface flex items-center gap-2 hover:bg-surface-container-low transition-colors whitespace-nowrap">
                <span class="material-symbols-outlined text-[18px]">filter_list</span> Filtros
            </button> -->
            <a href="/ShopOnline_Huila/controllers/exportar/ExportarController.php?modulo=clientes" class="px-4 py-2 border border-outline-variant rounded-lg font-label-md text-label-md text-on-surface flex items-center gap-2 hover:bg-surface-container-low transition-colors whitespace-nowrap">
                <span class="material-symbols-outlined text-[18px]">download</span> Exportar
            </a>
        </div>
        <!-- <button class="text-on-surface-variant hover:text-on-surface p-2 rounded-lg hover:bg-surface-container-low transition-colors">
            <span class="material-symbols-outlined">more_vert</span>
        </button> -->
    </div>
    <!-- Table -->
    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-surface-container-high bg-surface-container-low text-on-surface-variant font-label-sm text-label-sm">
                    <th class="px-6 py-4 font-semibold text-center">ID</th>
                    <th class="px-6 py-4 font-semibold">Nombre</th>
                    <th class="px-6 py-4 font-semibold">Correo Electrónico</th>
                    <th class="px-6 py-4 font-semibold">Teléfono</th>
                    <th class="px-6 py-4 font-semibold text-center">Pedidos</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody class="font-table-data text-table-data text-on-surface divide-y divide-surface-container-high">
                <?php if (empty($clientes)): ?>
                    <tr><td colspan="6" class="text-center py-4 text-on-surface-variant">No hay clientes registrados o activos.</td></tr>
                <?php else: ?>
                    <?php foreach ($clientes as $c): ?>
                    <tr class="hover:bg-primary/5 transition-colors group bg-surface-container-lowest">
                        <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant text-center font-medium"><?= $c['SKU_cliente'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium"><?= htmlspecialchars($c['nombre']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-on-surface-variant"><?= htmlspecialchars($c['email']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?= htmlspecialchars($c['telefono']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-medium"><?= $c['cantidad_pedidos'] ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <a href="/ShopOnline_Huila/views/clientes/editar.php?id=<?= $c['id_cliente'] ?>" class="text-tertiary hover:text-tertiary-container transition-colors p-1" title="Editar"><span class="material-symbols-outlined text-[20px]">edit</span></a>
                            
                            <form action="/ShopOnline_Huila/controllers/clientes/EliminarClienteController.php" method="POST" class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar este cliente?');">
                                <input type="hidden" name="id" value="<?= $c['id_cliente'] ?>">
                                <button type="submit" class="text-error hover:text-error-container transition-colors p-1" title="Eliminar"><span class="material-symbols-outlined text-[20px]">delete</span></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="p-4 border-t border-surface-container-high flex items-center justify-between bg-surface-bright">
        <span class="font-body-sm text-body-sm text-on-surface-variant">Total registrados: <?= count($clientes) ?></span>
        <div class="flex items-center gap-2">
            <button class="px-3 py-1 border border-outline-variant rounded-md text-on-surface-variant hover:bg-surface-container-low disabled:opacity-50" disabled>
                <span class="material-symbols-outlined text-[18px] align-middle">chevron_left</span>
            </button>
            <button class="px-3 py-1 border border-primary bg-primary text-on-primary rounded-md font-label-sm text-label-sm">1</button>
            <button class="px-3 py-1 border border-outline-variant rounded-md text-on-surface hover:bg-surface-container-low font-label-sm text-label-sm">2</button>
            <button class="px-3 py-1 border border-outline-variant rounded-md text-on-surface hover:bg-surface-container-low font-label-sm text-label-sm">3</button>
            <span class="text-on-surface-variant">...</span>
            <button class="px-3 py-1 border border-outline-variant rounded-md text-on-surface-variant hover:bg-surface-container-low">
                <span class="material-symbols-outlined text-[18px] align-middle">chevron_right</span>
            </button>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
