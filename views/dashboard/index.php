<?php
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
            <h3 class="font-headline-md text-headline-md text-on-background">$124,500</h3>
            <p class="font-label-sm text-label-sm text-primary flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px]">arrow_upward</span> +12.5% este mes
            </p>
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
            <h3 class="font-headline-md text-headline-md text-on-background">1,842</h3>
            <p class="font-label-sm text-label-sm text-primary flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px]">arrow_upward</span> +5.2% este mes
            </p>
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
            <h3 class="font-headline-md text-headline-md text-on-background">3,490</h3>
            <p class="font-label-sm text-label-sm text-on-surface-variant flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px]">horizontal_rule</span> Estable
            </p>
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
            <h3 class="font-headline-md text-headline-md text-on-background">14</h3>
            <p class="font-label-sm text-label-sm text-error flex items-center gap-1 mt-1">
                <span class="material-symbols-outlined text-[14px]">arrow_downward</span> Requiere atención
            </p>
        </div>
        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-error/5 rounded-full blur-2xl group-hover:bg-error/10 transition-colors"></div>
    </div>
</div>

<!-- Bento Grid: Main Content Area -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
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
                    <tr class="border-b border-outline-variant/30 hover:bg-primary/5 transition-colors group">
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-sm">MC</div>
                            <span class="text-on-background font-medium">Maria Camila</span>
                        </td>
                        <td class="p-4 text-on-surface-variant">24 Oct, 2023</td>
                        <td class="p-4 text-right font-medium">$340.50</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-primary/10 text-primary-container border border-primary/20">Enviado</span>
                        </td>
                        <td class="p-4 text-center">
                            <button class="text-secondary hover:text-primary transition-colors opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">more_horiz</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="bg-surface-container-lowest border-b border-outline-variant/30 hover:bg-primary/5 transition-colors group">
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-tertiary-container text-on-tertiary-container flex items-center justify-center font-bold text-sm">JR</div>
                            <span class="text-on-background font-medium">Juan Restrepo</span>
                        </td>
                        <td class="p-4 text-on-surface-variant">24 Oct, 2023</td>
                        <td class="p-4 text-right font-medium">$1,250.00</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-surface-variant text-on-surface-variant border border-outline-variant/50">Pendiente</span>
                        </td>
                        <td class="p-4 text-center">
                            <button class="text-secondary hover:text-primary transition-colors opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">more_horiz</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b border-outline-variant/30 hover:bg-primary/5 transition-colors group">
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-sm">AP</div>
                            <span class="text-on-background font-medium">Ana Perez</span>
                        </td>
                        <td class="p-4 text-on-surface-variant">23 Oct, 2023</td>
                        <td class="p-4 text-right font-medium">$85.20</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-secondary-container/50 text-secondary border border-secondary/20">Pagado</span>
                        </td>
                        <td class="p-4 text-center">
                            <button class="text-secondary hover:text-primary transition-colors opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">more_horiz</span>
                            </button>
                        </td>
                    </tr>
                    <tr class="bg-surface-container-lowest border-b border-outline-variant/30 hover:bg-primary/5 transition-colors group">
                        <td class="p-4 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-tertiary-container text-on-tertiary-container flex items-center justify-center font-bold text-sm">LG</div>
                            <span class="text-on-background font-medium">Luis Gomez</span>
                        </td>
                        <td class="p-4 text-on-surface-variant">23 Oct, 2023</td>
                        <td class="p-4 text-right font-medium">$450.00</td>
                        <td class="p-4 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm bg-primary/10 text-primary-container border border-primary/20">Enviado</span>
                        </td>
                        <td class="p-4 text-center">
                            <button class="text-secondary hover:text-primary transition-colors opacity-0 group-hover:opacity-100">
                                <span class="material-symbols-outlined">more_horiz</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sales Trend Graph Placeholder (1 column) -->
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/50 shadow-sm p-lg flex flex-col h-full min-h-[300px]">
        <div class="flex justify-between items-center mb-md">
            <h2 class="font-headline-sm text-headline-sm text-on-background">Tendencia de Ventas</h2>
            <button class="p-1 text-on-surface-variant hover:bg-surface-container-low rounded">
                <span class="material-symbols-outlined text-[20px]">more_vert</span>
            </button>
        </div>
        <p class="font-body-sm text-body-sm text-on-surface-variant mb-lg">Rendimiento de los últimos 30 días</p>
        <!-- Abstract Chart Representation using CSS -->
        <div class="flex-1 w-full flex items-end justify-between gap-2 pt-4 relative">
            <!-- Y-axis lines -->
            <div class="absolute inset-0 flex flex-col justify-between pointer-events-none pb-8">
                <div class="border-b border-outline-variant/30 w-full h-0"></div>
                <div class="border-b border-outline-variant/30 w-full h-0"></div>
                <div class="border-b border-outline-variant/30 w-full h-0"></div>
                <div class="border-b border-outline-variant/30 w-full h-0"></div>
            </div>
            <!-- Bars -->
            <div class="w-1/6 bg-primary/20 hover:bg-primary/40 rounded-t-sm h-[30%] transition-all relative group cursor-pointer">
                <div class="opacity-0 group-hover:opacity-100 absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-inverse-on-surface text-xs py-1 px-2 rounded pointer-events-none transition-opacity">S1</div>
            </div>
            <div class="w-1/6 bg-primary/40 hover:bg-primary/60 rounded-t-sm h-[50%] transition-all relative group cursor-pointer">
                <div class="opacity-0 group-hover:opacity-100 absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-inverse-on-surface text-xs py-1 px-2 rounded pointer-events-none transition-opacity">S2</div>
            </div>
            <div class="w-1/6 bg-primary/60 hover:bg-primary/80 rounded-t-sm h-[40%] transition-all relative group cursor-pointer">
                <div class="opacity-0 group-hover:opacity-100 absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-inverse-on-surface text-xs py-1 px-2 rounded pointer-events-none transition-opacity">S3</div>
            </div>
            <div class="w-1/6 bg-primary hover:bg-primary-fixed-dim rounded-t-sm h-[80%] transition-all relative group cursor-pointer">
                <div class="opacity-0 group-hover:opacity-100 absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-inverse-on-surface text-xs py-1 px-2 rounded pointer-events-none transition-opacity">S4</div>
            </div>
            <div class="w-1/6 bg-primary-container hover:bg-primary-fixed rounded-t-sm h-[65%] transition-all relative group cursor-pointer">
                <div class="opacity-0 group-hover:opacity-100 absolute -top-8 left-1/2 -translate-x-1/2 bg-inverse-surface text-inverse-on-surface text-xs py-1 px-2 rounded pointer-events-none transition-opacity">S5</div>
            </div>
        </div>
        <!-- X-axis labels -->
        <div class="flex justify-between mt-2 font-label-sm text-label-sm text-on-surface-variant px-1">
            <span>S1</span><span>S2</span><span>S3</span><span>S4</span><span>S5</span>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
