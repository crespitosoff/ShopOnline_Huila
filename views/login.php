<?php
session_start();
if (isset($_SESSION['empleado_id'])) {
    header("Location: /ShopOnline_Huila/views/dashboard/");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - ShopOnline Huila</title>
    <link rel="icon" type="image/png" href="/ShopOnline_Huila/assets/favicon.png">
    <link rel="shortcut icon" href="/ShopOnline_Huila/assets/favicon.png">
    <link rel="apple-touch-icon" href="/ShopOnline_Huila/assets/logo.png">
    <!-- Tailwind CSS (via CDN for standalone page) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Outfit', sans-serif; }
        .bg-login { background: linear-gradient(135deg, #164e63 0%, #083344 100%); }
    </style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen">

    <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-white rounded-2xl shadow-xl flex-col">
        <div class="px-8 pt-10 pb-8 bg-login text-white text-center flex flex-col items-center">
            <div class="flex items-center gap-4 mb-2">
                <img src="/ShopOnline_Huila/assets/logo.png" alt="ShopOnline Huila" class="w-20 h-20 rounded-full object-cover flex-shrink-0">
                <div class="text-left">
                    <h1 class="text-3xl font-black leading-tight">ShopOnline</h1>
                    <h2 class="text-2xl font-medium text-cyan-200 leading-tight">Huila</h2>
                </div>
            </div>
            <p class="text-sm text-cyan-100 opacity-80">Portal de Gestión Interna</p>
        </div>

        <div class="px-8 py-8 bg-white">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Iniciar Sesión</h3>
            
            <?php if (isset($_GET['error'])): ?>
            <div class="mb-6 p-3 rounded-lg bg-red-50 text-red-700 border border-red-200 flex items-start gap-2 text-sm">
                <span class="material-symbols-outlined text-[18px]">error</span>
                <p><?= htmlspecialchars($_GET['error']) ?></p>
            </div>
            <?php endif; ?>

            <form action="/ShopOnline_Huila/controllers/auth/LoginController.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Correo Electrónico</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">mail</span>
                        <input type="email" name="email" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all" placeholder="ej. carlos.h@shop.com" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">lock</span>
                        <input type="password" name="password" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-600 focus:border-cyan-600 outline-none transition-all" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full bg-cyan-700 hover:bg-cyan-800 text-white font-semibold py-2.5 rounded-lg shadow-md transition-colors flex justify-center items-center gap-2">
                        <span>Ingresar al Sistema</span>
                        <span class="material-symbols-outlined text-[20px]">login</span>
                    </button>
                </div>
            </form>
        </div>
        
        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center">
            <p class="text-xs text-gray-500">¿Problemas para acceder? Contacte a soporte técnico.</p>
        </div>
    </div>

</body>
</html>
