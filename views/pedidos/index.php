<?php
require_once __DIR__ . '/../../models/Pedido.php';
$objPedido = new Pedido();
$pedidos = $objPedido->obtenerTodos();

$pageTitle = 'Gestión de Pedidos - ShopOnline Huila';
$activePage = 'pedidos';
$searchPlaceholder = 'Buscar pedidos (ID, cliente)...';
include __DIR__ . '/../layouts/header.php';
?>

<!-- Page Header -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background">Centro de Pedidos</h2>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Gestione las compras, valide pagos y prepare pedidos para despacho.</p>
    </div>
    <button class="bg-primary hover:bg-primary/90 text-on-primary font-label-md text-label-md px-6 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
        <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span>
        Nuevo Pedido Manual
    </button>
</div>

<!-- Alertas -->
<?php if (isset($_GET['success'])): ?>
<div class="mb-6 p-4 rounded-lg bg-primary-fixed text-on-primary-fixed border border-primary-fixed-dim flex items-center gap-3">
    <span class="material-symbols-outlined">check_circle</span>
    <p class="font-body-md text-body-md">Estado del pedido actualizado correctamente.</p>
</div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
<div class="mb-6 p-4 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-3">
    <span class="material-symbols-outlined">error</span>
    <p class="font-body-md text-body-md">Ha ocurrido un error (Código: <?= htmlspecialchars($_GET['error']) ?>).</p>
</div>
<?php endif; ?>

<!-- Tabs and Filters -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm mb-6 flex flex-col md:flex-row justify-between items-center px-4 py-3 gap-4">
    <div class="flex space-x-1">
        <?php
            $pendientes = count(array_filter($pedidos, fn($p) => $p['id_estado'] == 1));
            $procesando = count(array_filter($pedidos, fn($p) => $p['id_estado'] == 2));
            $enviados = count(array_filter($pedidos, fn($p) => $p['id_estado'] >= 3));
        ?>
        <button class="px-4 py-2 bg-primary/10 text-primary font-label-md text-label-md rounded-lg font-medium transition-colors">Todos (<?= count($pedidos) ?>)</button>
        <button class="px-4 py-2 text-on-surface-variant hover:bg-surface-container-low font-label-md text-label-md rounded-lg transition-colors">Pendiente Pago (<?= $pendientes ?>)</button>
        <button class="px-4 py-2 text-on-surface-variant hover:bg-surface-container-low font-label-md text-label-md rounded-lg transition-colors">Procesando (<?= $procesando ?>)</button>
        <button class="px-4 py-2 text-on-surface-variant hover:bg-surface-container-low font-label-md text-label-md rounded-lg transition-colors">Enviados (<?= $enviados ?>)</button>
    </div>
    <div class="flex gap-2 w-full md:w-auto">
        <button class="border border-outline-variant text-on-surface-variant px-3 py-1.5 rounded-md font-label-sm text-label-sm hover:bg-surface-container-low transition-colors flex items-center gap-1 w-full md:w-auto justify-center">
            <span class="material-symbols-outlined text-[16px]">filter_list</span> Filtros Avanzados
        </button>
    </div>
</div>

<!-- Data Table Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm flex-1 flex flex-col">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-surface-variant bg-surface-container-low">
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">ID Pedido</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">Fecha</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">Cliente</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase text-right">Total (COP)</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase text-center">Estado Pago</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase text-center">Estado Pedido</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="font-table-data text-table-data text-on-surface divide-y divide-surface-variant">
                <?php if (empty($pedidos)): ?>
                    <tr><td colspan="7" class="text-center py-4 text-on-surface-variant">No hay pedidos registrados.</td></tr>
                <?php else: ?>
                    <?php foreach ($pedidos as $p): 
                        // Formateo de UI según estado
                        $estadoId = (int)$p['id_estado'];
                        
                        $pagoClass = 'bg-error/10 text-error border-error/20';
                        $pagoLabel = 'Pendiente';
                        
                        $estadoClass = 'bg-surface-variant text-on-surface-variant border-outline-variant/50';
                        
                        if ($estadoId >= 2) {
                            $pagoClass = 'bg-primary-fixed text-on-primary-fixed border-primary-fixed-dim';
                            $pagoLabel = 'Pagado';
                        }
                        
                        if ($estadoId == 2) {
                            $estadoClass = 'bg-tertiary-container text-on-tertiary-container border-tertiary/20';
                        } elseif ($estadoId == 3) {
                            $estadoClass = 'bg-secondary-container text-on-secondary-container border-secondary/20';
                        }
                    ?>
                    <tr class="hover:bg-primary/5 transition-colors group <?= $estadoId == 2 ? 'bg-surface-container-lowest' : '' ?>">
                        <td class="px-6 py-4 font-medium text-primary cursor-pointer hover:underline">#ORD-<?= str_pad($p['id_pedido'], 4, '0', STR_PAD_LEFT) ?></td>
                        <td class="px-6 py-4 text-on-surface-variant"><?= date('d M, h:i A', strtotime($p['fecha_creacion'])) ?></td>
                        <td class="px-6 py-4">
                            <div class="font-medium"><?= htmlspecialchars($p['nombre_cliente']) ?></div>
                        </td>
                        <td class="px-6 py-4 text-right font-medium">$ <?= number_format($p['total'], 0, ',', '.') ?></td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $pagoClass ?>"><?= $pagoLabel ?></span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $estadoClass ?>"><?= htmlspecialchars($p['nombre_estado']) ?></span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-1 whitespace-nowrap">
                            <form action="/ShopOnline_Huila/controllers/pedidos/AvanzarPedidoController.php" method="POST" class="inline">
                                <input type="hidden" name="id_pedido" value="<?= $p['id_pedido'] ?>">
                                <input type="hidden" name="monto" value="<?= $p['total'] ?>">
                                <?php if ($estadoId == 1): ?>
                                    <input type="hidden" name="accion" value="validar_pago">
                                    <button type="submit" class="bg-surface-container border border-outline-variant text-on-surface-variant px-3 py-1 rounded text-xs hover:bg-surface-container-low transition-colors">Validar Pago</button>
                                <?php elseif ($estadoId == 2): ?>
                                    <input type="hidden" name="accion" value="preparar_empaque">
                                    <button type="submit" class="bg-primary text-on-primary px-3 py-1 rounded text-xs hover:bg-primary/90 transition-colors">Preparar Empaque</button>
                                <?php elseif ($estadoId >= 3): ?>
                                    <a href="/ShopOnline_Huila/views/despachos/" class="inline-block bg-surface-container border border-outline-variant text-on-surface-variant px-3 py-1 rounded text-xs hover:bg-surface-container-low transition-colors">A Despachos</a>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="p-4 border-t border-surface-variant bg-surface-container-lowest flex items-center justify-between mt-auto">
        <span class="font-body-sm text-body-sm text-on-surface-variant">Total pedidos: <?= count($pedidos) ?></span>
        <div class="flex gap-2">
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container-low transition-colors disabled:opacity-50" disabled>Anterior</button>
            <button class="px-3 py-1 border border-primary bg-primary text-on-primary rounded font-medium">1</button>
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface hover:bg-surface-container-low transition-colors">2</button>
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface hover:bg-surface-container-low transition-colors">Siguiente</button>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
