<?php
/**
 * Top Navigation Bar Component
 * 
 * Receives: $searchPlaceholder (string) — placeholder text for the search input.
 */
$searchPlaceholder = $searchPlaceholder ?? 'Buscar...';
$usuarioPrimerNombre = $_SESSION['empleado_primer_nombre'] ?? 'Usuario';
$usuarioApellido = $_SESSION['empleado_primer_apellido'] ?? '';
$iniciales = strtoupper(substr($usuarioPrimerNombre, 0, 2));
?>

<!-- TopNavBar -->
<header class="bg-surface-container-lowest border-b border-outline-variant shadow-sm flex justify-between items-center w-full px-margin-mobile md:px-margin-desktop h-16 sticky top-0 z-40">
    <!-- Left: Mobile menu + Search -->
    <div class="flex items-center gap-md flex-1">
        <!-- Mobile Menu Toggle -->
        <button class="md:hidden text-on-surface hover:bg-surface-container-low p-2 rounded-full transition-colors" onclick="toggleSidebar()">
            <span class="material-symbols-outlined">menu</span>
        </button>
        <!-- Mobile Brand -->
        <h2 class="md:hidden font-headline-sm text-headline-sm font-bold text-primary">ShopOnline Huila</h2>
        <!-- Desktop Search -->
        <div class="hidden md:flex relative w-64 lg:w-96">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">search</span>
            <input class="w-full bg-surface-container-low border border-outline-variant rounded-lg pl-10 pr-4 py-2 font-body-sm text-body-sm text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                   placeholder="<?php echo htmlspecialchars($searchPlaceholder); ?>"
                   type="text">
        </div>
    </div>
    <!-- Right: Actions & Profile -->
    <div class="flex items-center gap-md">
        <div class="flex items-center gap-2">
            <span class="hidden md:block font-label-sm text-label-sm text-on-surface font-medium"><?= htmlspecialchars($usuarioPrimerNombre . ' ' . $usuarioApellido) ?></span>
            <div class="w-8 h-8 rounded-full bg-secondary-container flex items-center justify-center text-on-secondary-container border border-outline-variant overflow-hidden font-bold text-xs" title="<?= htmlspecialchars($usuarioNombre) ?>">
                <?= $iniciales ?>
            </div>
        </div>
    </div>
</header>
