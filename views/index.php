<?php require_once __DIR__ . '/layouts/header.php'; ?>

<div class="glass-card" style="text-align: center; padding: 4rem 2rem; margin-top: 2rem;">
    <h1 class="text-gradient" style="font-size: 3rem;">Bienvenido a ShopOnline Huila</h1>
    <p style="color: var(--text-muted); font-size: 1.2rem; margin-bottom: 2rem; max-width: 600px; margin-left: auto; margin-right: auto;">
        El sistema de gestión de comercio electrónico más moderno y eficiente para la región del Huila.
    </p>
    <div style="display: flex; gap: 1rem; justify-content: center;">
        <a href="clientes/" class="btn-primary">Gestionar Clientes</a>
        <a href="empleados/" class="btn-primary" style="background: var(--surface); border: 1px solid var(--border);">Gestionar Empleados</a>
    </div>
</div>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
