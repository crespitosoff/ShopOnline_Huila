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
    </script>
    <?php if (!empty($extraScripts)): ?>
    <script><?php echo $extraScripts; ?></script>
    <?php endif; ?>
</body>
</html>
