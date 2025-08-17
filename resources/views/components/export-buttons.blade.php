@if(auth()->user()->isAdminOrRH())
<div class="export-buttons-container mb-4">
    <div class="flex flex-wrap items-center gap-3">
        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">
            {{ __('Exporter :') }}
        </span>
        
        <div class="flex flex-wrap gap-2">
            <a 
                href="{{ route('documents.export.csv', ['search' => $search ?? '', 'selectedType' => $selectedType ?? '']) }}" 
                class="export-btn export-csv"
                title="{{ __('Exporter en CSV') }}"
            >
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                </svg>
                CSV
            </a>
            
            <a 
                href="{{ route('documents.export.pdf', ['search' => $search ?? '', 'selectedType' => $selectedType ?? '']) }}" 
                class="export-btn export-pdf"
                title="{{ __('Exporter en PDF') }}"
            >
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20,2H8A2,2 0 0,0 6,4V16A2,2 0 0,0 8,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M20,16H8V4H20V16M16,20V22H4A2,2 0 0,1 2,20V6H4V20H16Z"/>
                </svg>
                PDF
            </a>
        </div>
    </div>
</div>
@endif
