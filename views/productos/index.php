<?php
require_once __DIR__ . '/../../models/Producto.php';
$objProducto = new Producto();
$productos = $objProducto->obtenerTodos();

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
    <a href="/ShopOnline_Huila/views/productos/crear.php" class="bg-primary hover:bg-primary/90 text-on-primary font-label-md text-label-md px-6 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
        <span class="material-symbols-outlined text-sm">add</span>
        Agregar Producto
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
                <?php if (empty($productos)): ?>
                    <tr><td colspan="7" class="text-center py-4 text-on-surface-variant">No hay productos registrados.</td></tr>
                <?php else: ?>
                    <?php foreach ($productos as $p): 
                        // Determine stock status
                        $stockClass = 'bg-primary-fixed text-on-primary-fixed-variant border-primary-fixed-dim';
                        $stockLabel = 'Disponible';
                        $stockTextClass = '';
                        if ($p['stock'] == 0) {
                            $stockClass = 'bg-error-container text-on-error-container border-error/20';
                            $stockLabel = 'Agotado';
                            $stockTextClass = 'text-error font-medium';
                        } elseif ($p['stock'] < 20) {
                            $stockClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                            $stockLabel = 'Stock Bajo';
                            $stockTextClass = 'text-yellow-600 font-medium';
                        }
                    ?>
                    <tr class="border-b border-surface-variant hover:bg-primary/5 transition-colors">
                        <td class="px-6 py-4 font-medium">PRD-<?= str_pad($p['id_producto'], 4, '0', STR_PAD_LEFT) ?></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($p['nombre']) ?></td>
                        <td class="px-6 py-4 text-on-surface-variant"><?= htmlspecialchars($p['nombre_categoria']) ?></td>
                        <td class="px-6 py-4">$ <?= number_format($p['precio'], 0, ',', '.') ?></td>
                        <td class="px-6 py-4 <?= $stockTextClass ?>"><?= $p['stock'] ?></td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $stockClass ?>"><?= $stockLabel ?></span>
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap flex gap-2 justify-end">
                            <a href="/ShopOnline_Huila/views/productos/editar.php?id=<?= $p['id_producto'] ?>" class="text-tertiary hover:text-tertiary-container transition-colors p-1" title="Editar">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            <form action="/ShopOnline_Huila/controllers/productos/EliminarProductoController.php" method="POST" class="inline" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');">
                                <input type="hidden" name="id" value="<?= $p['id_producto'] ?>">
                                <button type="submit" class="text-error hover:text-error-container transition-colors p-1" title="Eliminar">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="border-t border-outline-variant bg-surface px-6 py-4 flex items-center justify-between">
        <span class="font-body-sm text-body-sm text-on-surface-variant">Total registrados: <?= count($productos) ?></span>
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
