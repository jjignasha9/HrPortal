@props(['items' => []])

<div class="flex items-center justify-between px-3 py-2 text-xs text-slate-500">
    <div class="flex items-center gap-1">
        @foreach ($items as $i => $item)
            @if ($i > 0)
                <span class="mx-1">›</span>
            @endif
            @if (isset($item['route']))
                <a href="{{ route($item['route']) }}" class="hover:text-slate-700">{{ $item['label'] }}</a>
            @else
                <span class="font-medium text-slate-700">{{ $item['label'] }}</span>
            @endif
        @endforeach
    </div>
    <div class="flex items-center gap-3">
        <div class="hidden sm:flex items-center gap-1">
            <span>Entries</span>
            <select class="rounded-lg border-slate-200 bg-white/80 text-slate-600">
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="flex items-center gap-1">
            <a class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium text-white transition-all" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); box-shadow: 3px 3px 6px rgba(239, 68, 68, 0.3), -2px -2px 4px rgba(255,255,255,0.2);" href="#">01</a>
            <a class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium text-slate-600 hover:text-slate-900 transition-all" style="background: #f8fafc; box-shadow: 3px 3px 6px rgba(0,0,0,0.08), -3px -3px 6px rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.3);" href="#">02</a>
            <a class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium text-slate-600 hover:text-slate-900 transition-all" style="background: #f8fafc; box-shadow: 3px 3px 6px rgba(0,0,0,0.08), -3px -3px 6px rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.3);" href="#">03</a>
            <a class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium text-slate-600 hover:text-slate-900 transition-all" style="background: #f8fafc; box-shadow: 3px 3px 6px rgba(0,0,0,0.08), -3px -3px 6px rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.3);" href="#">04</a>
            <a class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium text-slate-600 hover:text-slate-900 transition-all" style="background: #f8fafc; box-shadow: 3px 3px 6px rgba(0,0,0,0.08), -3px -3px 6px rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.3);" href="#">05</a>
            <a class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium text-slate-600 hover:text-slate-900 transition-all" style="background: #f8fafc; box-shadow: 3px 3px 6px rgba(0,0,0,0.08), -3px -3px 6px rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.3);" href="#">…</a>
            <a class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium text-slate-600 hover:text-slate-900 transition-all" style="background: #f8fafc; box-shadow: 3px 3px 6px rgba(0,0,0,0.08), -3px -3px 6px rgba(255,255,255,0.9); border: 1px solid rgba(255,255,255,0.3);" href="#">20</a>
        </div>
    </div>
</div>


