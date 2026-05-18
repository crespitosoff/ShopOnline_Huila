<?php
require_once __DIR__ . '/../../models/Cliente.php';
$id = $_GET['id'] ?? 0;
if (!$id) {
    header('Location: /ShopOnline_Huila/views/clientes/?error=id_invalido');
    exit;
}

$objCliente = new Cliente();
$cliente = $objCliente->obtenerPorId($id);

if (!$cliente) {
    header('Location: /ShopOnline_Huila/views/clientes/?error=no_encontrado');
    exit;
}

$pageTitle = 'Editar Cliente - ShopOnline Huila';
$activePage = 'clientes';
include __DIR__ . '/../layouts/header.php';
?>

<div class="max-w-2xl mx-auto mt-8">
    <div class="mb-6 flex items-center gap-4">
        <a href="/ShopOnline_Huila/views/clientes/" class="text-on-surface-variant hover:text-primary transition-colors flex items-center justify-center p-2 rounded-full hover:bg-surface-container-high">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <h2 class="font-headline-lg text-headline-lg text-on-surface">Editar Cliente #<?= str_pad($cliente['id_cliente'], 3, '0', STR_PAD_LEFT) ?></h2>
    </div>

    <div class="bg-surface-container-lowest border border-surface-container-high rounded-xl p-6 shadow-sm">
        <form action="/ShopOnline_Huila/controllers/clientes/ActualizarClienteController.php" method="POST" class="space-y-6">
            <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
            
            <div>
                <label for="nombre" class="block font-label-md text-label-md text-on-surface mb-1">Nombre Completo *</label>
                <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($cliente['nombre']) ?>" class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
            </div>
            
            <div>
                <label for="email" class="block font-label-md text-label-md text-on-surface mb-1">Correo Electrónico *</label>
                <input type="email" id="email" name="email" required value="<?= htmlspecialchars($cliente['email']) ?>" class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
            </div>

            <div>
                <label for="telefono" class="block font-label-md text-label-md text-on-surface mb-1">Teléfono *</label>
                <input type="tel" id="telefono" name="telefono" required value="<?= htmlspecialchars($cliente['telefono']) ?>" class="w-full px-4 py-2 border border-outline-variant rounded-lg font-body-md text-body-md focus:border-primary focus:ring-1 focus:ring-primary outline-none bg-surface-container-lowest">
            </div>

            <div class="pt-4 border-t border-surface-container-high flex justify-end gap-3">
                <a href="/ShopOnline_Huila/views/clientes/" class="px-6 py-2 border border-outline-variant rounded-lg text-on-surface hover:bg-surface-container-low transition-colors font-label-md text-label-md">Cancelar</a>
                <button type="submit" class="px-6 py-2 bg-primary text-on-primary rounded-lg hover:bg-primary-container transition-colors font-label-md text-label-md">Actualizar Cliente</button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
