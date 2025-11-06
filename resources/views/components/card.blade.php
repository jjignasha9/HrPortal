@props(['title' => null, 'actions' => null])

<div {{ $attributes->merge(['class' => 'rounded-2xl bg-white/80 backdrop-blur shadow-sm ring-1 ring-slate-200']) }}>
    @if($title || $actions)
        <div class="flex items-center justify-between px-4 sm:px-6 py-3 border-b border-slate-200">
            <h3 class="text-sm font-semibold text-slate-800">{{ $title }}</h3>
            <div class="flex items-center gap-2">
                @if(is_string($actions))
                    {!! $actions !!}
                @elseif($actions)
                    @include($actions)
                @endif
            </div>
        </div>
    @endif
    <div class="px-4 sm:px-6 py-4">{{ $slot }}</div>
</div>


