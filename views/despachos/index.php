<?php
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
        <button class="bg-primary text-on-primary font-label-md text-label-md px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-primary-container hover:text-on-primary-container transition-colors shadow-sm">
            <span class="material-symbols-outlined text-[18px]">add_box</span>
            Despacho por Lote
        </button>
    </div>
</div>

<!-- Bento Grid Metrics -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-lg">
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-secondary-container text-on-secondary-container rounded-lg">
                <span class="material-symbols-outlined">hourglass_top</span>
            </div>
            <span class="font-label-sm text-label-sm text-primary bg-primary-fixed py-1 px-2 rounded-full">Alta Prioridad</span>
        </div>
        <div>
            <p class="font-display-lg text-display-lg text-on-surface">42</p>
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
            <p class="font-display-lg text-display-lg text-on-surface">128</p>
            <p class="font-body-md text-body-md text-on-surface-variant">En Tránsito Hoy</p>
        </div>
    </div>
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <div class="p-2 bg-surface-variant text-on-surface-variant rounded-lg">
                <span class="material-symbols-outlined">timer</span>
            </div>
        </div>
        <div>
            <p class="font-display-lg text-display-lg text-on-surface">1.2<span class="text-headline-md font-normal text-on-surface-variant ml-1">días</span></p>
            <p class="font-body-md text-body-md text-on-surface-variant">Tiempo Promedio de Entrega</p>
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
                <!-- Row 1 -->
                <tr class="hover:bg-primary-fixed/10 transition-colors group">
                    <td class="py-4 px-6 font-medium text-primary">#ORD-8821</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant font-bold text-xs">MA</div>
                            <span>Maria Arango</span>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-on-surface-variant truncate max-w-[200px]">Calle 10 # 5-42, Neiva, Huila</td>
                    <td class="py-4 px-6 text-on-surface-variant">Oct 24, 09:30 AM</td>
                    <td class="py-4 px-6">
                        <select class="bg-surface-container border border-outline-variant text-on-surface text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2 outline-none">
                            <option disabled selected value="">Asignar Mensajero...</option>
                            <option value="1">Carlos Diaz (Van 1)</option>
                            <option value="2">Luis Gomez (Moto 3)</option>
                            <option value="3">Ana Rios (Van 2)</option>
                        </select>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-surface-variant text-on-surface-variant">Procesando</span>
                    </td>
                    <td class="py-4 px-6 text-right space-x-2">
                        <button class="p-2 rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container-low transition-colors" title="Imprimir etiqueta">
                            <span class="material-symbols-outlined text-[18px]">print</span>
                        </button>
                        <button class="bg-primary text-on-primary px-3 py-1.5 rounded-lg font-label-sm text-label-sm hover:bg-primary-container hover:text-on-primary-container transition-colors">Confirmar</button>
                    </td>
                </tr>
                <!-- Row 2 -->
                <tr class="bg-surface-container-lowest hover:bg-primary-fixed/10 transition-colors group">
                    <td class="py-4 px-6 font-medium text-primary">#ORD-8822</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant font-bold text-xs">JP</div>
                            <span>Juan Perez</span>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-on-surface-variant truncate max-w-[200px]">Cra 7 # 14-22, Garzón, Huila</td>
                    <td class="py-4 px-6 text-on-surface-variant">Oct 24, 10:15 AM</td>
                    <td class="py-4 px-6">
                        <select class="bg-surface-container border border-outline-variant text-on-surface text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2 outline-none">
                            <option selected value="1">Carlos Diaz (Van 1)</option>
                            <option value="2">Luis Gomez (Moto 3)</option>
                            <option value="3">Ana Rios (Van 2)</option>
                        </select>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-primary-fixed text-on-primary-fixed">Listo</span>
                    </td>
                    <td class="py-4 px-6 text-right space-x-2">
                        <button class="p-2 rounded-lg border border-outline-variant text-on-surface-variant hover:bg-surface-container-low transition-colors" title="Imprimir etiqueta">
                            <span class="material-symbols-outlined text-[18px]">print</span>
                        </button>
                        <button class="bg-primary text-on-primary px-3 py-1.5 rounded-lg font-label-sm text-label-sm hover:bg-primary-container hover:text-on-primary-container transition-colors">Despachar</button>
                    </td>
                </tr>
                <!-- Row 3 -->
                <tr class="hover:bg-primary-fixed/10 transition-colors group">
                    <td class="py-4 px-6 font-medium text-primary">#ORD-8819</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant font-bold text-xs">CR</div>
                            <span>Camila Rojas</span>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-on-surface-variant truncate max-w-[200px]">Avenida La Toma # 2-80, Neiva, Huila</td>
                    <td class="py-4 px-6 text-on-surface-variant">Oct 23, 04:45 PM</td>
                    <td class="py-4 px-6">
                        <select class="bg-surface-container-low border border-transparent text-on-surface-variant text-sm rounded-lg block w-full p-2 outline-none appearance-none cursor-not-allowed" disabled>
                            <option selected value="2">Luis Gomez (Moto 3)</option>
                        </select>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-tertiary-container text-on-tertiary-container">En Tránsito</span>
                    </td>
                    <td class="py-4 px-6 text-right space-x-2">
                        <button class="text-tertiary font-label-sm text-label-sm px-3 py-1.5 hover:underline">Rastrear</button>
                    </td>
                </tr>
                <!-- Row 4 -->
                <tr class="bg-surface-container-lowest hover:bg-primary-fixed/10 transition-colors group">
                    <td class="py-4 px-6 font-medium text-primary">#ORD-8815</td>
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant font-bold text-xs">SM</div>
                            <span>Santiago Mora</span>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-on-surface-variant truncate max-w-[200px]">Barrio Quirinal Mz C Casa 4, Neiva</td>
                    <td class="py-4 px-6 text-on-surface-variant">Oct 23, 02:10 PM</td>
                    <td class="py-4 px-6">
                        <select class="bg-surface-container-low border border-transparent text-on-surface-variant text-sm rounded-lg block w-full p-2 outline-none appearance-none cursor-not-allowed" disabled>
                            <option selected value="3">Ana Rios (Van 2)</option>
                        </select>
                    </td>
                    <td class="py-4 px-6">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full font-label-sm text-label-sm bg-secondary-container text-on-secondary-container opacity-80">Entregado</span>
                    </td>
                    <td class="py-4 px-6 text-right space-x-2">
                        <button class="text-secondary font-label-sm text-label-sm px-3 py-1.5 hover:underline">Ver POD</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
