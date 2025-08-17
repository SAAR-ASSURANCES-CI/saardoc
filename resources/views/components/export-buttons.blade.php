<div class="export-buttons-container mb-4">
    <div class="flex flex-wrap items-center gap-3">
        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
            {{ __('Exporter :') }}
        </span>
        
        <div class="flex flex-wrap gap-2">
            <button 
                onclick="exportTableData('excel')" 
                class="export-btn export-excel"
                title="{{ __('Exporter en Excel') }}"
            >
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                </svg>
                Excel
            </button>
            
            <button 
                onclick="exportTableData('csv')" 
                class="export-btn export-csv"
                title="{{ __('Exporter en CSV') }}"
            >
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                </svg>
                CSV
            </button>
            
            <button 
                onclick="exportTableData('pdf')" 
                class="export-btn export-pdf"
                title="{{ __('Exporter en PDF') }}"
            >
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20,2H8A2,2 0 0,0 6,4V16A2,2 0 0,0 8,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M20,16H8V4H20V16M16,20V22H4A2,2 0 0,1 2,20V6H4V20H16Z"/>
                </svg>
                PDF
            </button>
            
            <button 
                onclick="exportTableData('print')" 
                class="export-btn export-print"
                title="{{ __('Imprimer') }}"
            >
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19,8H5A3,3 0 0,0 2,11V17H6V21L13,17H19A3,3 0 0,0 22,14V11A3,3 0 0,0 19,8M19,14H13L9,17V14H5V11A1,1 0 0,1 6,10H18A1,1 0 0,1 19,11M18,2H6V6H18V2M18,0H6A2,2 0 0,0 4,2V6A2,2 0 0,0 6,8H18A2,2 0 0,0 20,6V2A2,2 0 0,0 18,0Z"/>
                </svg>
                {{ __('Imprimer') }}
            </button>
        </div>
        
        <button 
            onclick="refreshDataTable()" 
            class="export-btn export-refresh"
            title="{{ __('Rafraîchir') }}"
        >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            {{ __('Rafraîchir') }}
        </button>
    </div>
</div>
