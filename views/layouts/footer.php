        </main>
    </div>

    <!-- Sidebar toggle script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('flex');
            overlay.classList.toggle('hidden');
        }
        }
        
        // Confirmaciones globales y validaciones (Fase 7)
        document.addEventListener('DOMContentLoaded', () => {
            // Confirmar antes de borrar (borrado lógico)
            const deleteForms = document.querySelectorAll('form[action*="Eliminar"]');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('¿Está seguro de que desea eliminar este registro? Esta acción no se puede deshacer.')) {
                        e.preventDefault();
                    }
                });
            });
            
            // Validar combos vacíos en despachos/pedidos
            const advanceForms = document.querySelectorAll('form[action*="Avanzar"]');
            advanceForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const select = this.querySelector('select');
                    if (select && select.value === '') {
                        e.preventDefault();
                        alert('Por favor, seleccione una opción válida (ej. Empleado) antes de continuar.');
                    }
                });
            });
        });
    </script>
    <?php if (!empty($extraScripts)): ?>
    <script><?php echo $extraScripts; ?></script>
    <?php endif; ?>
</body>
</html>
