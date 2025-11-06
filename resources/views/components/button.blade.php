@props(['variant' => 'primary', 'size' => 'md', 'icon' => null, 'type' => 'button'])

@php
    $base = 'inline-flex items-center justify-center gap-2 font-medium rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 transition';
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-5 py-2.5 text-sm',
    ];
    $variants = [
        'primary' => 'bg-sky-600 text-white hover:bg-sky-700 focus:ring-sky-500',
        'secondary' => 'bg-white text-slate-700 ring-1 ring-slate-200 hover:bg-slate-50 focus:ring-slate-400',
        'danger' => 'bg-rose-600 text-white hover:bg-rose-700 focus:ring-rose-500',
    ];
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $base.' '.$sizes[$size].' '.$variants[$variant]]) }}>
    @if($icon)
        @if($icon === 'heroicon-o-plus')
            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        @else
            <span class="w-4 h-4">{{ $icon }}</span>
        @endif
    @endif
    {{ $slot }}
  </button>


