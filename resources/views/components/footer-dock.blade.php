<footer class="fixed inset-x-0 bottom-4 z-50 pointer-events-none">
    <div class="mx-auto w-full px-4">
        <div class="pointer-events-auto mx-auto w-full max-w-[min(1200px,95vw)] rounded-3xl border border-white/30 bg-white/60 backdrop-blur-xl supports-[backdrop-filter]:bg-white/40 shadow-2xl shadow-black/20 p-3 hover:shadow-3xl hover:shadow-black/30 transition-all duration-300">
            <div class="flex items-center justify-center gap-3 flex-nowrap overflow-hidden">
                @php
                    $dock = [
                        ['icon' => 'o-home','label' => 'Dashboard','route' => 'dashboard','color' => 'from-blue-500 to-cyan-500','bg' => 'bg-blue-500'],
                        ['icon' => 'o-user-group','label' => 'HRM','route' => 'employees.index','color' => 'from-purple-500 to-pink-500','bg' => 'bg-purple-500'],
                        ['icon' => 'o-chat-bubble-oval-left-ellipsis','label' => 'Inquiries','route' => 'inquiries.index','color' => 'from-green-500 to-emerald-500','bg' => 'bg-green-500'],
                        ['icon' => 'o-document-currency-rupee','label' => 'Quotation','route' => 'quotations.index','color' => 'from-yellow-500 to-orange-500','bg' => 'bg-yellow-500'],
                        ['icon' => 'o-building-office','label' => 'Company','route' => 'companies.index','color' => 'from-indigo-500 to-blue-500','bg' => 'bg-indigo-500'],
                        ['icon' => 'o-clipboard-document-list','label' => 'Projects','route' => 'projects.index','color' => 'from-red-500 to-rose-500','bg' => 'bg-red-500'],
                        ['icon' => 'o-ticket','label' => 'Tickets','route' => 'tickets.index','color' => 'from-teal-500 to-cyan-500','bg' => 'bg-teal-500'],
                        ['icon' => 'o-sparkles','label' => 'Events','route' => 'events.index','color' => 'from-violet-500 to-purple-500','bg' => 'bg-violet-500'],
                        ['icon' => 'o-cog-6-tooth','label' => 'Settings','route' => 'settings.index','color' => 'from-slate-500 to-gray-600','bg' => 'bg-slate-500'],
                    ];
                @endphp
                @foreach ($dock as $d)
                    @php
                        $colorMap = [
                            'blue' => 'rgba(59, 130, 246, 0.4)',
                            'purple' => 'rgba(168, 85, 247, 0.4)',
                            'green' => 'rgba(34, 197, 94, 0.4)',
                            'yellow' => 'rgba(234, 179, 8, 0.4)',
                            'indigo' => 'rgba(99, 102, 241, 0.4)',
                            'red' => 'rgba(239, 68, 68, 0.4)',
                            'teal' => 'rgba(20, 184, 166, 0.4)',
                            'violet' => 'rgba(139, 92, 246, 0.4)',
                            'slate' => 'rgba(100, 116, 139, 0.4)',
                        ];
                        $shadowColor = $colorMap[explode('-', $d['bg'])[0]] ?? 'rgba(0, 0, 0, 0.2)';
                    @endphp
                    <a href="{{ route($d['route']) }}" class="group relative inline-flex flex-col items-center justify-center transition-all duration-300 hover:scale-125 hover:z-50 select-none">
                        <div class="relative inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br {{ $d['color'] }} border-2 border-white/50 transition-all duration-300 group-hover:w-16 group-hover:h-16 group-hover:rounded-3xl" style="box-shadow: 0 10px 25px {{ $shadowColor }}, 0 0 0 1px rgba(255,255,255,0.1);">
                            <x-dynamic-component :component="'heroicon-'.$d['icon']" class="w-7 h-7 text-white transition-transform duration-300 group-hover:w-9 group-hover:h-9 group-hover:rotate-12 drop-shadow-lg" />
                        </div>
                        <span class="pointer-events-none absolute -bottom-10 opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 text-xs font-bold px-3 py-1.5 rounded-lg bg-gradient-to-r from-slate-800 to-slate-900 text-white shadow-xl backdrop-blur-sm whitespace-nowrap border border-white/10">
                            {{ $d['label'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>


