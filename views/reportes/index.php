<?php

require_once __DIR__ . '/../../models/Reporte.php';
$objReporte = new Reporte();
$periodo = $_GET['periodo'] ?? 'all';
$kpis = $objReporte->obtenerMapeoKPIs($periodo);
$ventas = $objReporte->obtenerVentasPorProducto($periodo);
$fecha_consulta = $_GET['fecha_consulta'] ?? date('Y-m-d');
$pedidos_fecha = $objReporte->obtenerPedidosPorFecha($fecha_consulta);
$pageTitle = 'Reportes y Analítica - ShopOnline Huila';
$activePage = 'reportes';
$searchPlaceholder = 'Buscar reportes...';
$id_pedido_consulta = $_GET['id_pedido_consulta'] ?? '';
$detalle_pedido = [];
if (!empty($id_pedido_consulta) && is_numeric($id_pedido_consulta)) {
    $detalle_pedido = $objReporte->obtenerDetallePedido($id_pedido_consulta);
}
include __DIR__ . '/../layouts/header.php';
?>

<!-- Header Section -->
<div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-xl">
    <div>
        <h1 class="font-headline-lg text-headline-lg text-on-surface">Reportes y Analítica</h1>
        <p class="font-body-md text-body-md text-on-surface-variant mt-1">Revise las métricas operativas y el rendimiento del negocio.</p>
    </div>
    <!-- Date Picker Filter -->
    <form method="GET" class="flex items-center gap-2 bg-surface-container-lowest border border-outline-variant hover:border-primary px-3 py-1.5 rounded-lg shadow-sm transition-colors group">
        <span class="material-symbols-outlined text-on-surface-variant group-hover:text-primary transition-colors">calendar_month</span>
        <select name="periodo" onchange="this.form.submit()" class="font-label-md text-label-md text-on-surface bg-transparent focus:outline-none appearance-none cursor-pointer pr-4">
            <option value="all" <?= $periodo == 'all' ? 'selected' : '' ?>>Histórico Completo</option>
            <option value="month" <?= $periodo == 'month' ? 'selected' : '' ?>>Este Mes</option>
            <option value="today" <?= $periodo == 'today' ? 'selected' : '' ?>>Hoy</option>
        </select>
    </form>
</div>

<!-- Predefined Query Tabs -->
<!-- NOTE: "Pedidos por Cliente" tab links to the Clientes management view -->
<!-- <div class="flex flex-wrap gap-3 border-b border-outline-variant pb-1 mb-xl">
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
</div> -->

<!-- Bento Grid: Summary KPIs -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter mb-xl">
    <!-- KPI Card 1 -->
    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 shadow-sm flex flex-col justify-between">
        <div class="flex items-start justify-between mb-4">
            <div class="w-10 h-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary">
                <span class="material-symbols-outlined">payments</span>
            </div>
        </div>
        <div>
            <p class="font-label-md text-label-md text-on-surface-variant mb-1">Total Ingresos</p>
            <p class="font-headline-md text-headline-md text-on-surface">$<?= number_format($kpis['total_ingresos'], 2, ',', '.') ?></p>
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
            <p class="font-headline-md text-headline-md text-on-surface"><?= number_format($kpis['unidades_vendidas'], 0, ',', '.') ?></p>
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
            <p class="font-headline-sm text-headline-sm text-on-surface truncate" title="<?= htmlspecialchars($kpis['producto_estrella']) ?>"><?= htmlspecialchars($kpis['producto_estrella']) ?></p>
        </div>
    </div>
</div>

<!-- Data Table Card: Ventas por Producto -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col">
    <div class="p-6 border-b border-outline-variant flex justify-between items-center">
        <h3 class="font-headline-sm text-headline-sm text-on-surface">Resumen de Ventas por Producto</h3>
        <a href="/ShopOnline_Huila/controllers/exportar/ExportarController.php?modulo=reportes" class="font-label-md text-label-md text-primary border border-primary px-4 py-1.5 rounded-lg hover:bg-primary hover:text-on-primary transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">download</span>
            Exportar CSV
        </a>
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
                <?php if (empty($ventas)): ?>
                    <tr><td colspan="5" class="text-center py-4 text-on-surface-variant">No hay datos de ventas disponibles.</td></tr>
                <?php else: ?>
                    <?php foreach ($ventas as $index => $v): ?>
                    <tr class="border-b border-outline-variant hover:bg-surface-bright transition-colors <?= $index % 2 != 0 ? 'bg-surface-container-lowest' : '' ?>">
                        <td class="py-4 px-6 font-mono text-sm text-on-surface-variant"><?= $v['SKU_producto'] ?></td>
                        <td class="py-4 px-6 font-medium"><?= htmlspecialchars($v['nombre']) ?></td>
                        <td class="py-4 px-6 text-right text-on-surface-variant"><?= htmlspecialchars($v['categoria']) ?></td>
                        <td class="py-4 px-6 text-right"><?= number_format($v['cant_vendida'], 0, ',', '.') ?></td>
                        <td class="py-4 px-6 text-right font-medium text-primary">$<?= number_format($v['ingreso_total'], 2, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Pagination Footer -->
    <div class="p-4 border-t border-outline-variant bg-surface-container-lowest flex items-center justify-between">
        <span class="font-body-sm text-body-sm text-on-surface-variant">Total registros: <?= count($ventas) ?></span>
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

<!-- Consulta 5: Pedidos por fecha con método de pago -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm overflow-hidden flex flex-col mt-xl">
    <div class="p-6 border-b border-outline-variant flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <h3 class="font-headline-sm text-headline-sm text-on-surface">
            Pedidos por Fecha con Método de Pago
        </h3>
        <form method="GET" class="flex items-center gap-3">
            <?php if ($periodo): ?>
                <input type="hidden" name="periodo" value="<?= $periodo ?>">
            <?php endif; ?>
            <label class="font-label-md text-label-md text-on-surface-variant">Fecha:</label>
            <input 
                type="date" 
                name="fecha_consulta" 
                value="<?= htmlspecialchars($fecha_consulta) ?>"
                class="border border-outline-variant rounded-lg px-3 py-1.5 text-body-sm font-body-sm bg-surface-container-lowest focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary text-on-surface"
            >
            <button type="submit" class="bg-primary text-on-primary font-label-md text-label-md px-4 py-1.5 rounded-lg hover:bg-primary-container transition-colors">
                Consultar
            </button>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant border-b border-outline-variant">
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase">ID Pedido</th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase">Cliente</th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase text-right">Valor Pagado</th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase text-center">Método de Pago</th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase text-center">Fecha</th>
                </tr>
            </thead>
            <tbody class="font-table-data text-table-data text-on-surface divide-y divide-outline-variant/30">
                <?php if (empty($pedidos_fecha)): ?>
                    <tr>
                        <td colspan="5" class="text-center py-8 text-on-surface-variant">
                            <span class="material-symbols-outlined block text-[40px] mb-2 mx-auto">search_off</span>
                            No se encontraron pedidos para la fecha 
                            <strong><?= date('d/m/Y', strtotime($fecha_consulta)) ?></strong>.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pedidos_fecha as $pf): 
                        $metodoClass = match($pf['metodo_pago']) {
                            'Efectivo'       => 'bg-primary-fixed text-on-primary-fixed',
                            'Tarjeta'        => 'bg-tertiary-container text-on-tertiary-container',
                            'Transferencia'  => 'bg-secondary-container text-on-secondary-container',
                            default          => 'bg-surface-variant text-on-surface-variant'
                        };
                    ?>
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="py-4 px-6 font-medium text-primary"><?= $pf['SKU_pedido'] ?></td>
                        <td class="py-4 px-6"><?= htmlspecialchars($pf['cliente']) ?></td>
                        <td class="py-4 px-6 text-right font-medium">
                            $<?= number_format($pf['valor_pagado'], 0, ',', '.') ?>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full font-label-sm text-label-sm <?= $metodoClass ?>">
                                <?= htmlspecialchars($pf['metodo_pago']) ?>
                            </span>
                        </td>
                        <td class="py-4 px-6 text-center text-on-surface-variant">
                            <?= date('d/m/Y', strtotime($pf['fecha'])) ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (!empty($pedidos_fecha)): ?>
    <div class="p-4 border-t border-outline-variant bg-surface-container-lowest">
        <span class="font-body-sm text-body-sm text-on-surface-variant">
            <?= count($pedidos_fecha) ?> pedido(s) encontrado(s) para el 
            <?= date('d/m/Y', strtotime($fecha_consulta)) ?>
        </span>
    </div>
    <?php endif; ?>
</div>

<!-- Consulta 4: Detalle de pedido específico -->
<div class="bg-surface-container-lowest border border-outline-variant 
            rounded-xl shadow-sm overflow-hidden flex flex-col mt-xl">
    
    <div class="p-6 border-b border-outline-variant flex flex-col 
                md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h3 class="font-headline-sm text-headline-sm text-on-surface">
                Detalle de Pedido
            </h3>
            <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                Consulta el nombre del cliente y los productos de un pedido.
            </p>
        </div>
        <form method="GET" class="flex items-center gap-3">
            <?php if ($periodo): ?>
                <input type="hidden" name="periodo" value="<?= $periodo ?>">
            <?php endif; ?>
            <?php if ($fecha_consulta): ?>
                <input type="hidden" name="fecha_consulta" 
                       value="<?= htmlspecialchars($fecha_consulta) ?>">
            <?php endif; ?>
            <label class="font-label-md text-label-md text-on-surface-variant 
                          whitespace-nowrap">
                ID Pedido:
            </label>
            <input
                type="number"
                name="id_pedido_consulta"
                value="<?= htmlspecialchars($id_pedido_consulta) ?>"
                min="1"
                placeholder="Ej: 1"
                class="border border-outline-variant rounded-lg px-3 py-1.5 
                       text-body-sm font-body-sm bg-surface-container-lowest 
                       focus:outline-none focus:border-primary focus:ring-1 
                       focus:ring-primary text-on-surface w-28"
            >
            <button type="submit"
                    class="bg-primary text-on-primary font-label-md text-label-md 
                           px-4 py-1.5 rounded-lg hover:bg-primary-container 
                           transition-colors">
                Consultar
            </button>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-surface-container-low text-on-surface-variant 
                           border-b border-outline-variant">
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase">
                        SKU Pedido
                    </th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase">
                        Cliente
                    </th>
                    <th class="py-3 px-6 font-label-sm text-label-sm uppercase">
                        Producto
                    </th>
                    <th class="py-3 px-6 font-label-sm text-label-sm 
                               uppercase text-center">
                        Cantidad
                    </th>
                    <th class="py-3 px-6 font-label-sm text-label-sm 
                               uppercase text-right">
                        Precio Unitario
                    </th>
                    <th class="py-3 px-6 font-label-sm text-label-sm 
                               uppercase text-right">
                        Subtotal
                    </th>
                </tr>
            </thead>
            <tbody class="font-table-data text-table-data text-on-surface 
                          divide-y divide-outline-variant/30">

                <?php if (empty($id_pedido_consulta)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-8 text-on-surface-variant">
                            <span class="material-symbols-outlined block text-[40px] 
                                         mb-2 mx-auto">
                                search
                            </span>
                            Ingrese un ID de pedido para ver su detalle.
                        </td>
                    </tr>

                <?php elseif (empty($detalle_pedido)): ?>
                    <tr>
                        <td colspan="6" class="text-center py-8 text-on-surface-variant">
                            <span class="material-symbols-outlined block text-[40px] 
                                         mb-2 mx-auto">
                                search_off
                            </span>
                            No se encontró ningún pedido con ID 
                            <strong><?= htmlspecialchars($id_pedido_consulta) ?></strong>.
                        </td>
                    </tr>

                <?php else: ?>
                    <?php 
                        $total_pedido = 0;
                        foreach ($detalle_pedido as $index => $d): 
                            $total_pedido += $d['subtotal'];
                    ?>
                    <tr class="hover:bg-primary/5 transition-colors">
                        <td class="py-4 px-6 font-medium text-primary">
                            <?= htmlspecialchars($d['SKU_pedido']) ?>
                        </td>
                        <td class="py-4 px-6">
                            <?= htmlspecialchars($d['cliente']) ?>
                        </td>
                        <td class="py-4 px-6 font-medium">
                            <?= htmlspecialchars($d['producto']) ?>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <?= $d['cantidad'] ?>
                        </td>
                        <td class="py-4 px-6 text-right text-on-surface-variant">
                            $<?= number_format($d['precio_unitario'], 0, ',', '.') ?>
                        </td>
                        <td class="py-4 px-6 text-right font-medium text-primary">
                            $<?= number_format($d['subtotal'], 0, ',', '.') ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <!-- Fila de total -->
                    <tr class="bg-surface-container-low font-medium">
                        <td colspan="5" class="py-3 px-6 text-right 
                                               font-label-md text-label-md 
                                               text-on-surface-variant">
                            TOTAL DEL PEDIDO:
                        </td>
                        <td class="py-3 px-6 text-right font-headline-sm 
                                   text-headline-sm text-primary">
                            $<?= number_format($total_pedido, 0, ',', '.') ?>
                        </td>
                    </tr>
                <?php endif; ?>

            </tbody>
        </table>
    </div>

    <?php if (!empty($detalle_pedido)): ?>
    <div class="p-4 border-t border-outline-variant bg-surface-container-lowest 
                flex items-center justify-between">
        <span class="font-body-sm text-body-sm text-on-surface-variant">
            <?= count($detalle_pedido) ?> producto(s) en el pedido 
            <strong><?= htmlspecialchars($detalle_pedido[0]['SKU_pedido']) ?></strong>
            — Cliente: 
            <strong><?= htmlspecialchars($detalle_pedido[0]['cliente']) ?></strong>
        </span>
    </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
