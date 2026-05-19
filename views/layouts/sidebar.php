<?php
/**
 * Sidebar Navigation Component
 * 
 * Receives: $activePage (string) — the key of the currently active page.
 * Valid keys: 'dashboard', 'inventario', 'pedidos', 'despachos', 'empleados', 'reportes'
 * 
 * NOTE: "Clientes" does NOT appear in the sidebar.
 *       It is accessed from Reportes > Pedidos por Cliente.
 */
$activePage = $activePage ?? '';

$navItems = [
    ['key' => 'dashboard',  'icon' => 'dashboard',      'label' => 'Panel de Control', 'href' => '/ShopOnline_Huila/views/dashboard/'],
    ['key' => 'inventario', 'icon' => 'inventory_2',     'label' => 'Inventario',       'href' => '/ShopOnline_Huila/views/productos/'],
    ['key' => 'pedidos',    'icon' => 'shopping_cart',    'label' => 'Pedidos',          'href' => '/ShopOnline_Huila/views/pedidos/'],
    ['key' => 'despachos',  'icon' => 'local_shipping',   'label' => 'Despachos',        'href' => '/ShopOnline_Huila/views/despachos/'],
    ['key' => 'clientes',   'icon' => 'group',            'label' => 'Clientes',         'href' => '/ShopOnline_Huila/views/clientes/'],
    ['key' => 'empleados',  'icon' => 'badge',            'label' => 'Empleados',        'href' => '/ShopOnline_Huila/views/empleados/'],
    ['key' => 'reportes',   'icon' => 'bar_chart',        'label' => 'Reportes',         'href' => '/ShopOnline_Huila/views/reportes/'],
];
?>

<!-- SideNavBar (Desktop) -->
<nav id="sidebar" class="bg-secondary shadow-md fixed left-0 top-0 h-full flex flex-col pt-8 pb-4 z-50 w-64 hidden md:flex">
    <!-- Brand Header -->
    <div class="px-6 mb-8">
        <h1 class="font-headline-lg text-headline-lg font-black text-on-secondary">ShopOnline</h1>
        <h2 class="font-headline-lg text-headline-lg font-black text-on-primary-fixed">Huila</h2>
        <p class="font-label-sm text-label-sm text-on-secondary opacity-70 mt-1">Portal de Gestión</p>
    </div>

    <!-- Main Nav Links -->
    <div class="flex-1 overflow-y-auto px-2 space-y-2">
        <?php foreach ($navItems as $item): ?>
            <?php if ($activePage === $item['key']): ?>
                <a class="bg-primary-container text-on-primary-container border-l-4 border-primary-fixed flex items-center px-4 py-3 font-bold translate-x-1 transition-transform font-label-md text-label-md rounded-r-lg"
                   href="<?php echo $item['href']; ?>">
                    <span class="material-symbols-outlined mr-3" style="font-variation-settings: 'FILL' 1;"><?php echo $item['icon']; ?></span>
                    <span><?php echo $item['label']; ?></span>
                </a>
            <?php else: ?>
                <a class="text-on-secondary flex items-center px-4 py-3 opacity-80 hover:bg-primary/20 transition-all font-label-md text-label-md rounded-lg"
                   href="<?php echo $item['href']; ?>">
                    <span class="material-symbols-outlined mr-3"><?php echo $item['icon']; ?></span>
                    <span><?php echo $item['label']; ?></span>
                </a>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <!-- Footer Links -->
    <div class="mt-auto px-2 space-y-2 border-t border-secondary-container pt-4">
        <!-- Solo mantenemos Cerrar Sesión -->
        <a class="text-on-secondary flex items-center px-4 py-3 opacity-80 hover:bg-primary/20 transition-all font-label-md text-label-md rounded-lg" href="/ShopOnline_Huila/controllers/auth/LogoutController.php">
            <span class="material-symbols-outlined mr-3">logout</span>
            <span>Cerrar Sesión</span>
        </a>
    </div>
</nav>

<!-- Mobile Sidebar Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden" onclick="toggleSidebar()"></div>
