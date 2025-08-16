@props(['type' => 'info', 'message', 'id' => null])

@php
$id = $id ?? 'toast-' . uniqid();
$typeClasses = [
    'success' => 'toast-success',
    'error' => 'toast-error',
    'info' => 'toast-info',
    'warning' => 'toast-warning'
][$type] ?? 'toast-info';

$icons = [
    'success' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'error' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'info' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'warning' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"></path></svg>'
][$type] ?? $icons['info'];
@endphp

<div id="{{ $id }}" class="toast-notification {{ $typeClasses }} animate-in slide-in-from-right duration-300" x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-full" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform translate-x-full">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            <div class="text-{{ $type === 'success' ? 'green' : ($type === 'error' ? 'red' : ($type === 'warning' ? 'yellow' : 'blue')) }}-400">
                {!! $icons !!}
            </div>
        </div>
        <div class="ml-3 flex-1">
            <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">
                {{ $message }}
            </p>
        </div>
        <div class="ml-4 flex-shrink-0">
            <button @click="show = false; setTimeout(() => $el.remove(), 200)" class="inline-flex text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 focus:outline-none focus:text-zinc-600 dark:focus:text-zinc-300 transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Barre de progression -->
    <div class="mt-2 h-1 bg-zinc-200 dark:bg-zinc-700 rounded-full overflow-hidden">
        <div class="h-full bg-{{ $type === 'success' ? 'green' : ($type === 'error' ? 'red' : ($type === 'warning' ? 'yellow' : 'blue')) }}-500 transition-all duration-5000 ease-linear" style="width: 100%"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide après 5 secondes
    setTimeout(() => {
        const toast = document.getElementById('{{ $id }}');
        if (toast) {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 200);
        }
    }, 5000);
});
</script>
