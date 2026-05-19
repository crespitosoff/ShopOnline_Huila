/**
 * Table Search and Filtering Utility
 * ShopOnline Huila
 */

document.addEventListener('DOMContentLoaded', function() {
    // 1. Global Search (Topbar)
    const globalSearchInput = document.querySelector('header input[type="text"]');
    if (globalSearchInput) {
        globalSearchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            // Find the main table in the current view
            const mainTable = document.querySelector('main table tbody');
            if (mainTable) {
                filterTableRows(mainTable, query);
            }
        });
    }

    // 2. Specific View Searches
    const localSearchInputs = document.querySelectorAll('.local-search-input');
    localSearchInputs.forEach(input => {
        input.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const tableBody = document.querySelector('table tbody');
            if (tableBody) {
                filterTableRows(tableBody, query);
            }
        });
    });

    function filterTableRows(tbody, query) {
        tbody.querySelectorAll('tr').forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(query) ? '' : 'none';
        });
    }

    // 3. Status Tabs Filtering (Pedidos, Despachos)
    const filterTabs = document.querySelectorAll('.filter-tab');
    if (filterTabs.length > 0) {
        filterTabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Update active state
                filterTabs.forEach(t => {
                    t.classList.remove('bg-primary', 'text-on-primary');
                    t.classList.add('bg-surface-container-high', 'text-on-surface-variant', 'hover:bg-surface-container-highest');
                });
                this.classList.remove('bg-surface-container-high', 'text-on-surface-variant', 'hover:bg-surface-container-highest');
                this.classList.add('bg-primary', 'text-on-primary');

                const statusId = this.dataset.statusId;
                const tbody = document.querySelector('table tbody');
                if (tbody) {
                    tbody.querySelectorAll('tr').forEach(row => {
                        if (statusId === 'all') {
                            row.style.display = '';
                        } else {
                            row.style.display = row.dataset.estado === statusId ? '' : 'none';
                        }
                    });
                }
            });
        });
    }

    // 4. Select Dropdown Filtering (Productos, Empleados)
    const filterSelects = document.querySelectorAll('.filter-select');
    filterSelects.forEach(select => {
        select.addEventListener('change', function() {
            const filterType = this.dataset.filterType; // e.g. 'categoria', 'cargo', 'stock'
            const filterValue = this.value.toLowerCase();
            const tbody = document.querySelector('table tbody');
            
            if (tbody) {
                tbody.querySelectorAll('tr').forEach(row => {
                    const rowValue = row.getAttribute('data-' + filterType)?.toLowerCase() || '';
                    if (!filterValue || filterValue === 'all') {
                        row.style.display = '';
                    } else {
                        row.style.display = rowValue === filterValue ? '' : 'none';
                    }
                });
            }
        });
    });
});
