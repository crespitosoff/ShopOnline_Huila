<?php
$pageTitle = 'Inventario de Productos - ShopOnline Huila';
$activePage = 'inventario';
$searchPlaceholder = 'Buscar inventario...';
include __DIR__ . '/../layouts/header.php';
?>

<!-- Header Actions -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h2 class="font-headline-lg-mobile md:font-headline-lg text-headline-lg-mobile md:text-headline-lg text-on-background">Inventario de Productos</h2>
        <p class="font-body-sm text-body-sm text-on-surface-variant mt-1">Administrar inventario, actualizar precios y clasificar productos.</p>
    </div>
    <button class="bg-primary hover:bg-primary/90 text-on-primary font-label-md text-label-md px-6 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
        <span class="material-symbols-outlined text-sm">add</span>
        Agregar Producto
    </button>
</div>

<!-- Filters & Controls Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 mb-6">
    <div class="flex flex-col md:flex-row gap-4 items-end">
        <div class="flex-1 w-full">
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-2">Buscar Productos</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
                <input class="w-full pl-10 pr-4 py-2 border border-outline-variant rounded-lg bg-surface text-on-surface font-body-sm text-body-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="Buscar por ID, Nombre o SKU" type="text">
            </div>
        </div>
        <div class="w-full md:w-64">
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-2">Filtro de Categoría</label>
            <select class="w-full px-4 py-2 border border-outline-variant rounded-lg bg-surface text-on-surface font-body-sm text-body-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary appearance-none">
                <option value="">Todas las Categorías</option>
                <option value="coffee">Café Premium</option>
                <option value="cacao">Productos de Cacao</option>
                <option value="crafts">Artesanías</option>
                <option value="honey">Miel Local</option>
            </select>
        </div>
        <div class="w-full md:w-48">
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-2">Estado</label>
            <select class="w-full px-4 py-2 border border-outline-variant rounded-lg bg-surface text-on-surface font-body-sm text-body-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary appearance-none">
                <option value="">Todos los Estados</option>
                <option value="available">Disponible</option>
                <option value="out_of_stock">Agotado</option>
                <option value="low_stock">Stock Bajo</option>
            </select>
        </div>
        <button class="w-full md:w-auto bg-surface border border-outline-variant text-on-surface font-label-md text-label-md px-4 py-2 rounded-lg flex items-center justify-center gap-2 hover:bg-surface-container-low transition-colors h-[42px]">
            <span class="material-symbols-outlined text-sm">filter_list</span>
            Más Filtros
        </button>
    </div>
</div>

<!-- Data Table Card -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-outline-variant bg-surface-container-low">
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">ID Producto</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">Nombre</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">Categoría</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">Precio (COP)</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">Cantidad</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase">Estado</th>
                    <th class="px-6 py-4 font-label-sm text-label-sm text-on-surface-variant uppercase text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="font-table-data text-table-data text-on-surface">
                <tr class="border-b border-surface-variant hover:bg-primary/5 transition-colors">
                    <td class="px-6 py-4 font-medium">PRD-1042</td>
                    <td class="px-6 py-4">Huila Supremo Coffee Beans 500g</td>
                    <td class="px-6 py-4 text-on-surface-variant">Café Premium</td>
                    <td class="px-6 py-4">$45,000</td>
                    <td class="px-6 py-4">124</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-fixed text-on-primary-fixed-variant border border-primary-fixed-dim">Disponible</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-tertiary hover:text-tertiary-container transition-colors p-1"><span class="material-symbols-outlined text-sm">edit</span></button>
                    </td>
                </tr>
                <tr class="border-b border-surface-variant bg-surface-container-lowest hover:bg-primary/5 transition-colors">
                    <td class="px-6 py-4 font-medium">PRD-2091</td>
                    <td class="px-6 py-4">Organic Raw Cacao Nibs 250g</td>
                    <td class="px-6 py-4 text-on-surface-variant">Productos de Cacao</td>
                    <td class="px-6 py-4">$28,500</td>
                    <td class="px-6 py-4 text-error font-medium">0</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-error-container text-on-error-container border border-error/20">Agotado</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-tertiary hover:text-tertiary-container transition-colors p-1"><span class="material-symbols-outlined text-sm">edit</span></button>
                    </td>
                </tr>
                <tr class="border-b border-surface-variant hover:bg-primary/5 transition-colors">
                    <td class="px-6 py-4 font-medium">PRD-1045</td>
                    <td class="px-6 py-4">San Agustín Medium Roast 1kg</td>
                    <td class="px-6 py-4 text-on-surface-variant">Café Premium</td>
                    <td class="px-6 py-4">$85,000</td>
                    <td class="px-6 py-4 text-yellow-600 font-medium">12</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 border border-yellow-200">Stock Bajo</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-tertiary hover:text-tertiary-container transition-colors p-1"><span class="material-symbols-outlined text-sm">edit</span></button>
                    </td>
                </tr>
                <tr class="border-b border-surface-variant bg-surface-container-lowest hover:bg-primary/5 transition-colors">
                    <td class="px-6 py-4 font-medium">PRD-3011</td>
                    <td class="px-6 py-4">Pitalito Wildflower Honey 500ml</td>
                    <td class="px-6 py-4 text-on-surface-variant">Miel Local</td>
                    <td class="px-6 py-4">$32,000</td>
                    <td class="px-6 py-4">58</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-fixed text-on-primary-fixed-variant border border-primary-fixed-dim">Disponible</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-tertiary hover:text-tertiary-container transition-colors p-1"><span class="material-symbols-outlined text-sm">edit</span></button>
                    </td>
                </tr>
                <tr class="hover:bg-primary/5 transition-colors">
                    <td class="px-6 py-4 font-medium">PRD-4005</td>
                    <td class="px-6 py-4">Handwoven Chiva Bus Miniature</td>
                    <td class="px-6 py-4 text-on-surface-variant">Artesanías</td>
                    <td class="px-6 py-4">$55,000</td>
                    <td class="px-6 py-4">34</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-fixed text-on-primary-fixed-variant border border-primary-fixed-dim">Disponible</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-tertiary hover:text-tertiary-container transition-colors p-1"><span class="material-symbols-outlined text-sm">edit</span></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="border-t border-outline-variant bg-surface px-6 py-4 flex items-center justify-between">
        <span class="font-body-sm text-body-sm text-on-surface-variant">Mostrando 1 a 5 de 248 registros</span>
        <div class="flex items-center gap-2">
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface-variant hover:bg-surface-container-low transition-colors disabled:opacity-50" disabled>Anterior</button>
            <button class="px-3 py-1 border border-primary bg-primary text-on-primary rounded font-medium">1</button>
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface hover:bg-surface-container-low transition-colors">2</button>
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface hover:bg-surface-container-low transition-colors">3</button>
            <span class="px-2 text-on-surface-variant">...</span>
            <button class="px-3 py-1 border border-outline-variant rounded bg-surface-container-lowest text-on-surface hover:bg-surface-container-low transition-colors">Siguiente</button>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
