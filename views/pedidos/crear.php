<?php
require_once __DIR__ . '/../../models/Cliente.php';
require_once __DIR__ . '/../../models/Producto.php';

$clientes = (new Cliente())->obtenerTodos();
$productos = (new Producto())->obtenerTodos();

$pageTitle = 'Nuevo Pedido Manual - ShopOnline Huila';
$activePage = 'pedidos';
include __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-4xl mx-auto mb-10">
    <div class="flex items-center gap-4 mb-6">
        <a href="/ShopOnline_Huila/views/pedidos/" class="w-10 h-10 rounded-full border border-outline-variant flex items-center justify-center text-on-surface hover:bg-surface-container-low transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Nuevo Pedido Manual</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Registre una compra telefónica o presencial descontando el stock automáticamente.</p>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
    <div class="mb-6 p-4 rounded-lg bg-error-container text-on-error-container border border-error flex items-center gap-3">
        <span class="material-symbols-outlined">error</span>
        <p class="font-body-md text-body-md"><?= htmlspecialchars($_GET['error']) ?></p>
    </div>
    <?php endif; ?>

    <div class="bg-surface-container-lowest border border-outline-variant rounded-xl shadow-sm p-6 md:p-8">
        <form action="/ShopOnline_Huila/controllers/pedidos/CrearPedidoController.php" method="POST" class="space-y-8" id="form-pedido">
            
            <!-- Datos Generales -->
            <section>
                <h3 class="font-headline-sm text-headline-sm text-primary mb-4 flex items-center gap-2 border-b border-outline-variant/30 pb-2">
                    <span class="material-symbols-outlined">person</span> Información del Cliente
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2">Cliente Asociado <span class="text-error">*</span></label>
                        <select name="id_cliente" class="w-full bg-surface-container-lowest border border-outline-variant rounded-md px-4 py-2.5 text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none text-on-surface" required>
                            <option value="">Seleccione un cliente registrado...</option>
                            <?php foreach ($clientes as $c): ?>
                                <option value="<?= $c['id_cliente'] ?>"><?= htmlspecialchars($c['nombre']) ?> (<?= htmlspecialchars($c['email']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block font-label-md text-label-md text-on-surface mb-2">Dirección de Envío <span class="text-error">*</span></label>
                        <input type="text" name="direccion_envio" class="w-full bg-surface-container-lowest border border-outline-variant rounded-md px-4 py-2.5 text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none" placeholder="Ej: Calle 10 #5-24, Pitalito" required>
                    </div>
                </div>
            </section>

            <!-- Productos -->
            <section>
                <h3 class="font-headline-sm text-headline-sm text-primary mb-4 flex items-center gap-2 border-b border-outline-variant/30 pb-2">
                    <span class="material-symbols-outlined">shopping_bag</span> Productos del Pedido
                </h3>
                <p class="font-body-sm text-body-sm text-on-surface-variant mb-4">Indique la cantidad de los productos que desea agregar al pedido. Solo se mostrarán productos con stock disponible.</p>
                
                <div class="overflow-x-auto rounded-lg border border-outline-variant/50">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-surface-container-low">
                            <tr>
                                <th class="px-4 py-3 font-label-sm text-label-sm text-on-surface-variant">Producto</th>
                                <th class="px-4 py-3 font-label-sm text-label-sm text-on-surface-variant text-right">Precio Unitario</th>
                                <th class="px-4 py-3 font-label-sm text-label-sm text-on-surface-variant text-center">Stock Disp.</th>
                                <th class="px-4 py-3 font-label-sm text-label-sm text-on-surface-variant text-center w-32">Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/30">
                            <?php foreach ($productos as $p): 
                                if ($p['stock'] <= 0) continue; // No mostrar productos sin stock
                            ?>
                            <tr class="hover:bg-primary/5 transition-colors">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-on-surface"><?= htmlspecialchars($p['nombre']) ?></div>
                                    <div class="text-xs text-on-surface-variant"><?= htmlspecialchars($p['nombre_categoria']) ?></div>
                                </td>
                                <td class="px-4 py-3 text-right text-on-surface-variant">$<?= number_format($p['precio'], 0, ',', '.') ?></td>
                                <td class="px-4 py-3 text-center text-on-surface-variant"><?= $p['stock'] ?></td>
                                <td class="px-4 py-3">
                                    <input type="hidden" name="id_producto[]" value="<?= $p['id_producto'] ?>">
                                    <input type="number" name="cantidad[]" min="0" max="<?= $p['stock'] ?>" value="0" class="w-full bg-surface-container border border-outline-variant rounded px-2 py-1 text-center font-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <div class="pt-4 flex items-center justify-end border-t border-outline-variant/50 gap-4">
                <a href="/ShopOnline_Huila/views/pedidos/" class="text-on-surface-variant font-label-md px-4 py-2 hover:bg-surface-container-low rounded-lg transition-colors">Cancelar</a>
                <button type="submit" class="bg-primary hover:bg-primary-fixed-dim text-on-primary font-label-md text-label-md px-8 py-3 rounded-lg shadow-sm transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span> Registrar Pedido
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form-pedido');
    form.addEventListener('submit', (e) => {
        const cantidades = document.querySelectorAll('input[name="cantidad[]"]');
        let totalCant = 0;
        cantidades.forEach(inp => {
            totalCant += parseInt(inp.value) || 0;
        });

        if (totalCant === 0) {
            e.preventDefault();
            alert('Por favor, indique una cantidad mayor a cero en al menos un producto para registrar el pedido.');
        } else {
            const btn = form.querySelector('button[type="submit"]');
            btn.disabled = true;
            btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Registrando...';
        }
    });
});
</script>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
