<?php
$pageTitle = 'Reportes y Analítica - ShopOnline Huila';
$activePage = 'reportes';
$searchPlaceholder = 'Buscar reportes...';
include __DIR__ . '/../layouts/header.php';
?>

<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-xl">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-surface">Reportes y Analítica</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Revise las métricas operativas y el rendimiento del negocio.</p>
    </div>
    <!-- Date Picker Filter -->
    <button class="flex items-center gap-2 bg-surface-container-lowest border border-outline-variant hover:border-primary px-4 py-2 rounded-lg shadow-sm transition-colors group">
        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">calendar_month</span>
        <span class="font-label-md text-label-md text-on-surface">1 Oct, 2023 - 31 Oct, 2023</span>
        <span class="material-symbols-outlined text-on-surface-variant">arrow_drop_down</span>
    </button>
</div>

<!-- Predefined Query Tabs -->
<!-- NOTE: "Pedidos por Cliente" tab links to the Clientes management view -->
<div class="flex flex-wrap gap-3 border-b border-outline-variant pb-1 mb-xl">
    <button class="px-5 py-2.5 rounded-t-lg bg-surface-container-low border-b-2 border-primary font-label-md text-label-md text-primary bg-primary/5 transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">inventory</span>
        Ventas por Producto
    </button>
    <a href="/ShopOnline_Huila/views/clientes/" class="px-5 py-2.5 rounded-t-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">group</span>
        Pedidos por Cliente
    </a>
    <button class="px-5 py-2.5 rounded-t-lg font-label-md text-label-md text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">fact_check</span>
        Auditoría de Despachos
    </button>
</div>

<!-- Bento Grid: Summary KPIs -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-xl">
    <!-- KPI Card 1 -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">payments</span>
            </div>
            <span class="font-label-sm text-label-sm text-primary flex items-center bg-primary/10 px-2 py-1 rounded-full">
                <span class="material-symbols-outlined text-[14px] mr-1">trending_up</span> 12.5%
            </span>
        </div>
        <div>
            <p class="font-label-md text-label-md text-on-surface-variant mb-1">Total Ingresos</p>
            <p class="font-headline-md text-headline-md text-on-surface">$145,200.00</p>
        </div>
    </div>
    <!-- KPI Card 2 -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-tertiary/10 flex items-center justify-center text-tertiary">
                <span class="material-symbols-outlined">shopping_bag</span>
            </div>
        </div>
        <div>
            <p class="font-label-md text-label-md text-on-surface-variant mb-1">Unidades Vendidas</p>
            <p class="font-headline-md text-headline-md text-on-surface">3,482</p>
        </div>
    </div>
    <!-- KPI Card 3 -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-secondary/10 flex items-center justify-center text-secondary">
                <span class="material-symbols-outlined">star</span>
            </div>
        </div>
        <div>
            <p class="font-label-md text-label-md text-on-surface-variant mb-1">Producto Estrella</p>
            <p class="font-headline-sm text-headline-sm text-on-surface truncate">Café Especial Huila 500g</p>
        </div>
    </div>
</div>

<!-- Data Table Card: Ventas por Producto -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col">
    <div class="p-6 border-b border-outline-variant flex justify-between items-center">
        <h3 class="font-headline-sm text-headline-sm text-on-surface">Resumen de Ventas por Producto</h3>
        <button class="font-label-md text-label-md text-primary border border-primary px-4 py-1.5 rounded-lg hover:bg-primary hover:text-on-primary transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">download</span>
            Exportar CSV
        </button>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant border-b border-outline-variant">
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase tracking-wider">Código SKU</th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase tracking-wider">Producto</th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase tracking-wider text-right">Categoría</th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase tracking-wider text-right">Cant. Vendida</th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase tracking-wider text-right">Ingreso Total</th>
                </tr>
            </thead>
            <tbody class="font-table-data text-table-data text-on-surface">
                <tr class="border-b border-outline-variant hover:bg-surface-bright transition-colors">
                    <td class="py-4 px-6 font-mono text-sm text-on-surface-variant">PRD-001</td>
                    <td class="py-4 px-6 font-medium">Café Especial Huila 500g</td>
                    <td class="py-4 px-6 text-right text-on-surface-variant">Cafés</td>
                    <td class="py-4 px-6 text-right">1,240</td>
                    <td class="py-4 px-6 text-right font-medium text-primary">$18,600.00</td>
                </tr>
                <tr class="border-b border-outline-variant hover:bg-surface-bright transition-colors bg-surface-container-lowest">
                    <td class="py-4 px-6 font-mono text-sm text-on-surface-variant">PRD-042</td>
                    <td class="py-4 px-6 font-medium">Cacao Premium Garzón</td>
                    <td class="py-4 px-6 text-right text-on-surface-variant">Chocolates</td>
                    <td class="py-4 px-6 text-right">850</td>
                    <td class="py-4 px-6 text-right font-medium text-primary">$10,200.00</td>
                </tr>
                <tr class="border-b border-outline-variant hover:bg-surface-bright transition-colors">
                    <td class="py-4 px-6 font-mono text-sm text-on-surface-variant">PRD-105</td>
                    <td class="py-4 px-6 font-medium">Achiras del Huila Tradicional</td>
                    <td class="py-4 px-6 text-right text-on-surface-variant">Snacks</td>
                    <td class="py-4 px-6 text-right">2,100</td>
                    <td class="py-4 px-6 text-right font-medium text-primary">$6,300.00</td>
                </tr>
                <tr class="border-b border-outline-variant hover:bg-surface-bright transition-colors bg-surface-container-lowest">
                    <td class="py-4 px-6 font-mono text-sm text-on-surface-variant">PRD-088</td>
                    <td class="py-4 px-6 font-medium">Panela Orgánica Pitalito</td>
                    <td class="py-4 px-6 text-right text-on-surface-variant">Endulzantes</td>
                    <td class="py-4 px-6 text-right">620</td>
                    <td class="py-4 px-6 text-right font-medium text-primary">$3,100.00</td>
                </tr>
                <tr class="hover:bg-surface-bright transition-colors">
                    <td class="py-4 px-6 font-mono text-sm text-on-surface-variant">PRD-015</td>
                    <td class="py-4 px-6 font-medium">Miel de Abejas Macizo</td>
                    <td class="py-4 px-6 text-right text-on-surface-variant">Endulzantes</td>
                    <td class="py-4 px-6 text-right">415</td>
                    <td class="py-4 px-6 text-right font-medium text-primary">$4,980.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Pagination Footer -->
    <div class="p-4 border-t border-outline-variant bg-surface-container-lowest flex items-center justify-between">
        <span class="font-body-sm text-body-sm text-on-surface-variant">Mostrando 1 a 5 de 45 productos</span>
        <div class="flex gap-2">
            <button class="p-2 rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-low transition-colors disabled:opacity-50" disabled>
                <span class="material-symbols-outlined text-[20px]">chevron_left</span>
            </button>
            <button class="p-2 rounded border border-outline-variant text-on-surface-variant hover:bg-surface-container-low transition-colors">
                <span class="material-symbols-outlined text-[20px]">chevron_right</span>
            </button>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
