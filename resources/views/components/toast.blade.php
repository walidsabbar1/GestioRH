{{-- Toast Notifications --}}
@if(session('success'))
    <div class="toast toast-success" id="toast-success">
        <svg class="w-5 h-5 flex-shrink-0" style="color: var(--color-success);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-sm font-medium flex-1" style="color: var(--color-text);">{{ session('success') }}</p>
        <button class="toast-close p-1 rounded-lg hover:bg-gray-100" style="color: var(--color-text-lighter);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="toast toast-error" id="toast-error">
        <svg class="w-5 h-5 flex-shrink-0" style="color: var(--color-danger);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="text-sm font-medium flex-1" style="color: var(--color-text);">{{ session('error') }}</p>
        <button class="toast-close p-1 rounded-lg hover:bg-gray-100" style="color: var(--color-text-lighter);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
@endif
