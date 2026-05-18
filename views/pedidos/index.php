<?php
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

<!-- Tabs and Filters -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm mb-6 flex flex-col md:flex-row justify-between items-center px-4 py-3 gap-4">
    <div class="flex space-x-1">
        <button class="px-4 py-2 bg-primary/10 text-primary font-label-md text-label-md rounded-lg font-medium transition-colors">Todos (124)</button>
        <button class="px-4 py-2 text-on-surface-variant hover:bg-surface-container-low font-label-md text-label-md rounded-lg transition-colors">Pendiente Pago (12)</button>
        <button class="px-4 py-2 text-on-surface-variant hover:bg-surface-container-low font-label-md text-label-md rounded-lg transition-colors">Procesando (45)</button>
        <button class="px-4 py-2 text-on-surface-variant hover:bg-surface-container-low font-label-md text-label-md rounded-lg transition-colors">Enviados (67)</button>
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
                
                <!-- Order 1: Pending Payment -->
                <tr class="hover:bg-primary/5 transition-colors group">
                    <td class="px-6 py-4 font-medium text-primary cursor-pointer hover:underline">#ORD-9001</td>
                    <td class="px-6 py-4 text-on-surface-variant">Hoy, 10:45 AM</td>
                    <td class="px-6 py-4">
                        <div class="font-medium">Ana María Rodríguez</div>
                        <div class="text-xs text-on-surface-variant">2 items</div>
                    </td>
                    <td class="px-6 py-4 text-right font-medium">$125,000</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-error/10 text-error border border-error/20">Pendiente</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-surface-variant text-on-surface-variant border border-outline-variant/50">Esperando Pago</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-1">
                        <button class="bg-surface-container border border-outline-variant text-on-surface-variant px-3 py-1 rounded text-xs hover:bg-surface-container-low transition-colors">Validar Pago</button>
                    </td>
                </tr>

                <!-- Order 2: Processing (Paid, needs preparation) -->
                <tr class="bg-surface-container-lowest hover:bg-primary/5 transition-colors group">
                    <td class="px-6 py-4 font-medium text-primary cursor-pointer hover:underline">#ORD-8995</td>
                    <td class="px-6 py-4 text-on-surface-variant">Ayer, 04:20 PM</td>
                    <td class="px-6 py-4">
                        <div class="font-medium">Carlos Eduardo Gómez</div>
                        <div class="text-xs text-on-surface-variant">5 items</div>
                    </td>
                    <td class="px-6 py-4 text-right font-medium">$340,500</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-fixed text-on-primary-fixed border border-primary-fixed-dim">Pagado</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-tertiary-container text-on-tertiary-container border border-tertiary/20">Procesando</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-1">
                        <button class="bg-primary text-on-primary px-3 py-1 rounded text-xs hover:bg-primary/90 transition-colors">Preparar Empaque</button>
                    </td>
                </tr>

                <!-- Order 3: Ready for Dispatch -->
                <tr class="hover:bg-primary/5 transition-colors group">
                    <td class="px-6 py-4 font-medium text-primary cursor-pointer hover:underline">#ORD-8982</td>
                    <td class="px-6 py-4 text-on-surface-variant">26 Oct, 09:15 AM</td>
                    <td class="px-6 py-4">
                        <div class="font-medium">Diana Marcela López</div>
                        <div class="text-xs text-on-surface-variant">1 item</div>
                    </td>
                    <td class="px-6 py-4 text-right font-medium">$45,000</td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-fixed text-on-primary-fixed border border-primary-fixed-dim">Pagado</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-secondary-container text-on-secondary-container border border-secondary/20">Listo p/ Despacho</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-1">
                        <button class="bg-surface-container border border-outline-variant text-on-surface-variant px-3 py-1 rounded text-xs hover:bg-surface-container-low transition-colors" disabled title="Pasa a pantalla de despachos">A Despachos</button>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="p-4 border-t border-surface-variant bg-surface-container-lowest flex items-center justify-between mt-auto">
        <span class="font-body-sm text-body-sm text-on-surface-variant">Mostrando 1 a 3 de 124 pedidos</span>
        <div class="flex gap-2">
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container-low transition-colors disabled:opacity-50" disabled>Anterior</button>
            <button class="px-3 py-1 border border-primary bg-primary text-on-primary rounded font-medium">1</button>
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface hover:bg-surface-container-low transition-colors">2</button>
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface hover:bg-surface-container-low transition-colors">Siguiente</button>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
