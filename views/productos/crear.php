<?php
require_once __DIR__ . '/../../models/Categoria.php';
$objCategoria = new Categoria();
$categorias = $objCategoria->obtenerTodas();

$pageTitle = 'Agregar Producto - ShopOnline Huila';
$activePage = 'inventario';
include __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-2xl mx-auto mt-8">
    <div class="mb-6 flex items-center gap-4">
        <a href="/ShopOnline_Huila/views/productos/" class="text-on-surface-variant hover:text-primary transition-colors flex items-center justify-center p-2 rounded-full hover:bg-surface-container-high">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Añadir Nuevo Producto</h2>
    </div>

    <!-- Alertas -->
    <?php if (isset($_GET['error'])): ?>
    <div class="mb-6 p-4 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-3">
        <span class="material-symbols-outlined">error</span>
        <p class="font-body-md text-body-md">Ha ocurrido un error (Código: <?= htmlspecialchars($_GET['error']) ?>).</p>
    </div>
    <?php endif; ?>

    <div class="bg-surface-container-lowest border border-surface-container-high rounded-xl p-6 shadow-sm">
        <form action="/ShopOnline_Huila/controllers/productos/CrearProductoController.php" method="POST" class="space-y-6">
            <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1">Nombre del Producto *</label>
                <input type="text" name="nombre" required class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
            </div>

            <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1">Categoría *</label>
                <select name="id_categoria" required class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest text-on-surface">
                    <option value="">Seleccionar categoría...</option>
                    <?php foreach ($categorias as $c): ?>
                        <option value="<?= $c['id_categoria'] ?>"><?= htmlspecialchars($c['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1">Precio (COP) *</label>
                    <input type="number" name="precio" min="0" step="0.01" required class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
                </div>
                <div>
                    <label class="block font-label-md text-label-md text-on-surface mb-1">Stock Inicial *</label>
                    <input type="number" name="stock" min="0" required class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
                </div>
            </div>

            <div>
                <label class="block font-label-md text-label-md text-on-surface mb-1">Descripción</label>
                <textarea name="descripcion" rows="3" class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest"></textarea>
            </div>

            <div class="pt-4 border-t border-surface-container-high flex justify-end gap-3">
                <a href="/ShopOnline_Huila/views/productos/" class="px-6 py-2 border border-outline-variant rounded-lg text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md">Cancelar</a>
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-lg hover:bg-primary-container transition-colors font-label-md text-label-md">Guardar Producto</button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
