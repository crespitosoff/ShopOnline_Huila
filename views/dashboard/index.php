<?php
require_once __DIR__ . '/../../models/Reporte.php';
require_once __DIR__ . '/../../models/Pedido.php';
require_once __DIR__ . '/../../models/Cliente.php';
require_once __DIR__ . '/../../models/Producto.php';

$kpis = (new Reporte())->obtenerMapeoKPIs();
$pedidosModel = new Pedido();
$todosPedidos = $pedidosModel->obtenerTodos();
$pedidosRecientes = array_slice($todosPedidos, 0, 5);

$clientes = (new Cliente())->obtenerTodos();
$productos = (new Producto())->obtenerTodos();
$stockBajo = count(array_filter($productos, fn($p) => $p['stock'] <= 20));

$pageTitle = 'ShopOnline Huila - Panel de Control';
$activePage = 'dashboard';
$searchPlaceholder = 'Buscar pedidos, inventario...';
include __DIR__ . '/../layouts/header.php';
?>

<!-- Page Header -->
<div class="mb-lg">
    <h1 class="font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background">Vista General</h1>
    <p class="font-body-md text-body-md text-on-surface-variant mt-sm">Bienvenido de nuevo. Aquí hay un resumen de sus operaciones de comercio electrónico.</p>
</div>

<!-- Bento Grid: Summary Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-md md:gap-lg mb-xl">
    <!-- Total Revenue -->
    <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant/50 shadow-[0px_4px_6px_rgba(15,23,42,0.05)] flex flex-col justify-between h-32 relative overflow-hidden group hover:border-primary/30 transition-colors">
        <div class="flex justify-between items-start z-10">
            <p class="font-label-md text-label-md text-on-surface-variant">Ingresos Totales</p>
            <span class="material-symbols-outlined text-primary-container p-2 bg-primary/10 rounded-lg">payments</span>
        </div>
        <div class="z-10">
            <h3 class="font-headline-md text-headline-md text-on-background">$<?= number_format($kpis['total_ingresos'], 0, ',', '.') ?></h3>
        </div>
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-primary/5 rounded-full blur-2xl group-hover:bg-primary/10 transition-colors"></div>
    </div>
    <!-- Total Orders -->
    <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant/50 shadow-[0px_4px_6px_rgba(15,23,42,0.05)] flex flex-col justify-between h-32 relative overflow-hidden group hover:border-primary/30 transition-colors">
        <div class="flex justify-between items-start z-10">
            <p class="font-label-md text-label-md text-on-surface-variant">Pedidos Totales</p>
            <span class="material-symbols-outlined text-secondary p-2 bg-secondary/10 rounded-lg">shopping_bag</span>
        </div>
        <div class="z-10">
            <h3 class="font-headline-md text-headline-md text-on-background"><?= count($todosPedidos) ?></h3>
        </div>
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-secondary/5 rounded-full blur-2xl group-hover:bg-secondary/10 transition-colors"></div>
    </div>
    <!-- Active Customers -->
    <div class="bg-surface-container-lowest rounded-xl p-lg border border-outline-variant/50 shadow-[0px_4px_6px_rgba(15,23,42,0.05)] flex flex-col justify-between h-32 relative overflow-hidden group hover:border-primary/30 transition-colors">
        <div class="flex justify-between items-start z-10">
            <p class="font-label-md text-label-md text-on-surface-variant">Clientes Activos</p>
            <span class="material-symbols-outlined text-tertiary p-2 bg-tertiary/10 rounded-lg">group</span>
        </div>
        <div class="z-10">
            <h3 class="font-headline-md text-headline-md text-on-background"><?= count($clientes) ?></h3>
        </div>
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-tertiary/5 rounded-full blur-2xl group-hover:bg-tertiary/10 transition-colors"></div>
    </div>
    <!-- Low Stock Alerts -->
    <div class="bg-surface-container-lowest rounded-xl p-lg border border-error/20 shadow-[0px_4px_6px_rgba(15,23,42,0.05)] flex flex-col justify-between h-32 relative overflow-hidden group hover:border-error/40 transition-colors">
        <div class="flex justify-between items-start z-10">
            <p class="font-label-md text-label-md text-error">Alertas de Stock Bajo</p>
            <span class="material-symbols-outlined text-error p-2 bg-error/10 rounded-lg">warning</span>
        </div>
        <div class="z-10">
            <h3 class="font-headline-md text-headline-md text-on-background"><?= $stockBajo ?></h3>
        </div>
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-error/5 rounded-full blur-2xl group-hover:bg-error/10 transition-colors"></div>
    </div>
</div>

<!-- Recent Orders Table (2 columns) -->
<div class="lg:col-span-2 bg-surface-container-lowest rounded-xl border border-outline-variant/50 shadow-sm overflow-hidden flex flex-col">
    <div class="p-lg border-b border-outline-variant/50 flex justify-between items-center bg-surface-container-lowest">
        <h2 class="font-headline-sm text-headline-sm text-on-background">Pedidos Recientes</h2>
        <button class="font-label-md text-label-md text-primary hover:text-primary-container transition-colors flex items-center gap-xs">
            Ver Todo <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </button>
    </div>
    <div class="overflow-x-auto flex-1">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low border-b border-outline-variant/50">
                    <th class="p-4 font-label-md text-label-md text-on-surface-variant font-semibold">Nombre del Cliente</th>
                    <th class="p-4 font-label-md text-label-md text-on-surface-variant font-semibold">Fecha de Pedido</th>
                    <th class="p-4 font-label-md text-label-md text-on-surface-variant font-semibold text-right">Monto Total</th>
                    <th class="p-4 font-label-md text-label-md text-on-surface-variant font-semibold text-center">Estado</th>
                    <th class="p-4 font-label-md text-label-md text-on-surface-variant font-semibold text-center">Acción</th>
                </tr>
            </thead>
            <tbody class="font-table-data text-table-data">
                <?php if (empty($pedidosRecientes)): ?>
                    <tr><td colspan="5" class="p-4 text-center text-on-surface-variant">No hay pedidos recientes.</td></tr>
                <?php else: ?>
                    <?php foreach ($pedidosRecientes as $index => $p): 
                        $estadoId = (int)$p['id_estado'];
                        $estadoClass = 'bg-surface-variant text-on-surface-variant border border-outline-variant/50';
                        
                        if ($estadoId == 1) {
                            $estadoClass = 'bg-error/10 text-error border border-error/20';
                        } elseif ($estadoId == 2) {
                            $estadoClass = 'bg-primary-fixed text-on-primary-fixed border border-primary-fixed-dim';
                        } elseif ($estadoId == 3) {
                            $estadoClass = 'bg-secondary-container text-on-secondary-container border border-secondary/20';
                        }
                        
                        $iniciales = strtoupper(substr($p['nombre_cliente'], 0, 2));
                    ?>
                    <tr class="border-b border-outline-variant/30 hover:bg-primary/5 transition-colors group <?= $index % 2 != 0 ? 'bg-surface-container-lowest' : '' ?>">
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-sm"><?= $iniciales ?></div>
                            <span class="text-on-background font-medium"><?= htmlspecialchars($p['nombre_cliente']) ?></span>
                        </td>
                        <td class="p-4 text-on-surface-variant"><?= date('d M, Y', strtotime($p['fecha_creacion'])) ?></td>
                        <td class="p-4 text-right font-medium">$<?= number_format($p['total'], 0, ',', '.') ?></td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm <?= $estadoClass ?>"><?= htmlspecialchars($p['nombre_estado']) ?></span>
                        </td>
                        <td class="p-4 text-center">
                            <a href="/ShopOnline_Huila/views/pedidos/" class="text-secondary hover:text-primary transition-colors opacity-0 group-hover:opacity-100" title="Ver pedido">
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
