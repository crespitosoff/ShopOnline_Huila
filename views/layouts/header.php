<?php
session_start();
if (!isset($_SESSION['empleado_id'])) {
    header("Location: /ShopOnline_Huila/views/login.php");
    exit;
}
/**
 * Master Layout Wrapper
 * 
 * Usage in any page:
 *   $pageTitle = 'My Page - ShopOnline Huila';
 *   $activePage = 'dashboard';
 *   $searchPlaceholder = 'Buscar pedidos...';
 *   include __DIR__ . '/../layouts/header.php';
 *   // ... your page content here ...
 *   include __DIR__ . '/../layouts/footer.php';
 * 
 * This file assembles: head.php → sidebar.php → topbar.php → opens <main>
 */

// Defaults
$pageTitle = $pageTitle ?? 'ShopOnline Huila';
$activePage = $activePage ?? '';
$searchPlaceholder = $searchPlaceholder ?? 'Buscar...';

// 1. Head (HTML open, meta, Tailwind config, body open)
include __DIR__ . '/head.php';

// 2. Sidebar
include __DIR__ . '/sidebar.php';
?>

<!-- Main Content Area -->
<div class="flex-1 flex flex-col md:ml-64 w-full h-screen overflow-hidden">

<?php
// 3. TopBar
include __DIR__ . '/topbar.php';
?>

    <!-- Page Content (each module fills this) -->
    <main class="flex-1 p-margin-mobile md:p-margin-desktop bg-background overflow-y-auto">
