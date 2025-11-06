@props(['name', 'title' => null])

<div x-data="{ open: false }" 
     x-on:open-{{ str_replace('-', '_', $name) }}.window="open = true" 
     x-on:close-{{ str_replace('-', '_', $name) }}.window="open = false"
     x-on:open-modal.window="$event.detail === '{{ $name }}' ? open = true : null"
     x-on:close-modal.window="$event.detail === '{{ $name }}' ? open = false : null">
    <div x-show="open" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/40 z-50" 
         x-on:click="open = false"></div>
    <div x-show="open" 
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-50 grid place-items-center p-4"
         x-on:click.self="open = false">
        <div class="w-full max-w-4xl rounded-2xl bg-white shadow-2xl ring-1 ring-slate-200 overflow-hidden max-h-[90vh] overflow-y-auto">
            @if($title)
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 bg-slate-50">
                <h3 class="text-lg font-semibold text-slate-900">{{ $title }}</h3>
                <button class="w-9 h-9 grid place-items-center rounded-lg hover:bg-slate-100 transition-colors" x-on:click="open = false">
                    <x-heroicon-o-x-mark class="w-5 h-5 text-slate-600" />
                </button>
            </div>
            @endif
            <div class="p-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
