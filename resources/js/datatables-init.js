import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';
import 'datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';

document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('documents-table');
    if (table) {
        const dataTable = new DataTable(table, {
            error: function (xhr, error, thrown) {
                console.error('Erreur DataTables:', error, thrown);
                const errorDiv = document.createElement('div');
                errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4';
                errorDiv.innerHTML = `
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Erreur lors du chargement des données. Veuillez rafraîchir la page.
                    </div>
                `;
                table.parentNode.insertBefore(errorDiv, table);
            },
            responsive: true,
            language: {
                processing: "Traitement en cours...",
                search: "Rechercher :",
                lengthMenu: "Afficher _MENU_ éléments",
                info: "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
                infoEmpty: "Aucun élément à afficher",
                infoFiltered: "(filtré de _MAX_ éléments au total)",
                infoPostFix: "",
                loadingRecords: "Chargement en cours...",
                zeroRecords: "Aucun élément à afficher",
                emptyTable: "Aucune donnée disponible dans le tableau",
                paginate: {
                    first: "Premier",
                    previous: "Précédent",
                    next: "Suivant",
                    last: "Dernier"
                },
                aria: {
                    sortAscending: ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            },
            
            columns: [
                { data: 'document', orderable: true, searchable: true },
                { data: 'type', orderable: true, searchable: true },
                { data: 'author', orderable: true, searchable: true },
                { data: 'date', orderable: true, searchable: false },
                { data: 'size', orderable: true, searchable: false },
                { data: 'actions', orderable: false, searchable: false }
            ],
            
            pageLength: 10,
            lengthMenu: [[5, 10, 25, 50], [5, 10, 25, 50]],
            
            order: [[3, 'desc']], 
            
            dom: '<"flex flex-col sm:flex-row justify-between items-center mb-4"lf>rt<"flex flex-col sm:flex-row justify-between items-center mt-4"ip>',
            
            initComplete: function() {
                this.api().table().container().classList.add('dataTables-container');
                
                const searchBox = this.api().table().container().querySelector('.dataTables_filter input');
                if (searchBox) {
                    searchBox.classList.add('mt-1', 'block', 'w-full', 'border-zinc-300', 'rounded-xl', 'shadow-sm', 'focus:ring-4', 'focus:ring-blue-500/30', 'focus:border-blue-500', 'dark:bg-zinc-700', 'dark:border-zinc-600', 'dark:text-white', 'sm:text-sm', 'transition-all', 'duration-300', 'ease-in-out', 'hover:border-zinc-400', 'focus:scale-[1.02]', 'ml-2');
                    searchBox.placeholder = 'Rechercher dans les documents...';
                }
                
                const lengthSelect = this.api().table().container().querySelector('.dataTables_length select');
                if (lengthSelect) {
                    lengthSelect.classList.add('mt-1', 'block', 'w-full', 'border-zinc-300', 'rounded-xl', 'shadow-sm', 'focus:ring-4', 'focus:ring-blue-500/30', 'focus:border-blue-500', 'dark:bg-zinc-700', 'dark:border-zinc-600', 'dark:text-white', 'sm:text-sm', 'transition-all', 'duration-300', 'ease-in-out', 'hover:border-zinc-400', 'focus:scale-[1.02]', 'ml-2');
                }
            },
            
            rowCallback: function(row, data, index) {
                row.classList.add('table-row-modern');
                
                row.style.animationDelay = `${index * 0.05}s`;
                row.classList.add('animate-fade-in-up');
            },
            
            drawCallback: function(settings) {
                const pagination = this.api().table().container().querySelector('.dataTables_paginate');
                if (pagination) {
                    pagination.classList.add('pagination-container');
                    
                    const paginationButtons = pagination.querySelectorAll('a');
                    paginationButtons.forEach(btn => {
                        btn.classList.add('px-4', 'py-2', 'text-sm', 'font-medium', 'text-zinc-700', 'bg-white', 'border', 'border-zinc-300', 'rounded-lg', 'hover:bg-zinc-50', 'dark:bg-zinc-700', 'dark:border-zinc-600', 'dark:text-zinc-300', 'dark:hover:bg-zinc-600', 'transition-all', 'duration-300', 'ease-in-out', 'hover:scale-105', 'hover:shadow-md');
                    });
                }
            }
        });
        
        if (window.Livewire) {
            window.Livewire.on('documentsUpdated', () => {
                dataTable.ajax.reload();
            });
        }
        
        customizeDataTablesAppearance();
        
        window.dataTableInstance = dataTable;
    }
});

function customizeDataTablesAppearance() {
    const searchContainer = document.querySelector('.dataTables_filter');
    if (searchContainer) {
        searchContainer.classList.add('mb-4');
        searchContainer.innerHTML = `
            <label class="flex items-center text-sm font-medium text-zinc-700 dark:text-zinc-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Rechercher:
                <input type="search" class="mt-1 block w-full border-zinc-300 rounded-xl shadow-sm focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm transition-all duration-300 ease-in-out hover:border-zinc-400 focus:scale-[1.02] ml-2" placeholder="Rechercher dans les documents...">
            </label>
        `;
    }
    
    const lengthContainer = document.querySelector('.dataTables_length');
    if (lengthContainer) {
        lengthContainer.classList.add('mb-4');
        lengthContainer.innerHTML = `
            <label class="flex items-center text-sm font-medium text-zinc-700 dark:text-zinc-300">
                Afficher
                <select class="mt-1 block w-full border-zinc-300 rounded-xl shadow-sm focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm transition-all duration-300 ease-in-out hover:border-zinc-400 focus:scale-[1.02] mx-2">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                entrées
            </label>
        `;
    }
    
    const infoContainer = document.querySelector('.dataTables_info');
    if (infoContainer) {
        infoContainer.classList.add('text-sm', 'text-zinc-600', 'dark:text-zinc-400');
    }
}

window.refreshDataTable = function() {
    if (window.dataTableInstance) {
        window.dataTableInstance.ajax.reload();
    }
};

window.exportTableData = function(format) {
    if (window.dataTableInstance) {
        switch(format) {
            case 'excel':
                console.log('Export Excel...');
                break;
            case 'csv':
                console.log('Export CSV...');
                break;
            case 'pdf':
                console.log('Export PDF...');
                break;
            case 'print':
                window.print();
                break;
        }
    }
};
