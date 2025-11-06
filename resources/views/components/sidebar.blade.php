@props(['mobile' => false])

@php
    $groups = [
        ['label' => 'Dashboard', 'icon' => 'o-home', 'route' => 'dashboard'],
        ['label' => 'HRM', 'icon' => 'o-user-group', 'children' => [
            ['label' => 'Add New Hiring Lead', 'route' => 'leads.create'],
            ['label' => 'List of Hiring Lead', 'route' => 'leads.index'],
            ['label' => 'Employee List', 'route' => 'employees.index'],
        ]],
        ['label' => 'Leave Mgmt.', 'icon' => 'o-briefcase', 'route' => 'attendance.index'],
        ['label' => 'Payroll Mgmt.', 'icon' => 'o-currency-rupee', 'route' => 'attendance.index'],
        ['label' => 'Project & Task Mgmt.', 'icon' => 'o-clipboard-document-list', 'route' => 'projects.index'],
        ['label' => 'Inquiry Mgmt.', 'icon' => 'o-chat-bubble-oval-left-ellipsis', 'route' => 'inquiries.index'],
        ['label' => 'Quotation Mgmt.', 'icon' => 'o-document-currency-rupee', 'route' => 'quotations.index'],
        ['label' => 'Invoice Mgmt.', 'icon' => 'o-document-text', 'route' => 'invoices.index'],
        ['label' => 'Voucher Mgmt.', 'icon' => 'o-receipt-percent', 'route' => 'vouchers.index'],
        ['label' => 'Ticket Support System', 'icon' => 'o-ticket', 'route' => 'tickets.index'],
        ['label' => 'Event Mgmt.', 'icon' => 'o-sparkles', 'route' => 'events.index'],
        ['label' => 'Company Info.', 'icon' => 'o-building-office', 'route' => 'companies.index'],
        ['label' => 'Rules & Regulations', 'icon' => 'o-document-check', 'route' => 'settings.index'],
    ];
@endphp

<aside class="{{ $mobile ? 'fixed md:hidden inset-y-0 left-0 w-72 p-4 z-50' : 'hidden md:flex md:w-64 lg:w-72 xl:w-80 p-4 sticky top-0 h-screen' }} bg-white rounded-r-[30px]" style="box-shadow: 4px 0 12px rgba(0,0,0,0.08); border-right: 1px solid #e2e8f0;">
    <div class="w-full flex flex-col gap-2">
        {{-- Window Controls (three colored circles) --}}
        <div class="flex items-center gap-2 mb-2 px-3">
            <div class="w-3 h-3 rounded-full bg-red-500"></div>
            <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
            <div class="w-3 h-3 rounded-full bg-green-500"></div>
            <div class="ml-auto w-4 h-4 rounded bg-blue-500"></div>
        </div>
        
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-gradient-to-r from-sky-500 to-indigo-600 text-white shadow-sm">
            @php($logo = \App\Models\Setting::get('logo_path'))
            @if($logo)
                <img src="{{ asset('storage/'.$logo) }}" alt="logo" class="w-5 h-5 rounded" />
            @else
                <x-heroicon-o-bolt class="w-5 h-5" />
            @endif
            <span class="font-semibold">{{ \App\Models\Setting::get('site_title','HR Portal') }}</span>
        </a>

        <nav class="mt-2 space-y-1 overflow-y-auto pr-2">
            @foreach ($groups as $item)
                @php($active = isset($item['route']) && request()->routeIs($item['route']))
                @php($childActive = isset($item['children']) && collect($item['children'])->contains(fn($c) => request()->routeIs($c['route'])))
                @if (isset($item['children']))
                    <div class="px-3 pt-3 text-[11px] uppercase tracking-wide font-semibold {{ $childActive ? 'text-red-600' : 'text-slate-500' }}">{{ $item['label'] }}</div>
                    @foreach ($item['children'] as $child)
                        @php($childActive = request()->routeIs($child['route']))
                        <a href="{{ route($child['route']) }}" class="group relative flex items-center gap-3 px-3 py-2 rounded-[20px] transition-all {{ $childActive ? 'bg-red-50' : 'hover:bg-slate-50' }}" style="{{ $childActive ? 'box-shadow: inset 2px 2px 4px rgba(0,0,0,0.08), inset -2px -2px 4px rgba(255,255,255,0.9);' : '' }}">
                            @if($childActive)
                                <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-red-500 rounded-r-full"></span>
                            @endif
                            <span class="w-6 h-6 grid place-items-center">
                                <x-heroicon-o-chevron-right class="w-4 h-4 {{ $childActive ? 'text-red-600' : 'text-slate-400 group-hover:text-slate-600' }}" />
                            </span>
                            <span class="text-sm font-medium {{ $childActive ? 'text-red-600' : 'text-slate-700' }}">{{ $child['label'] }}</span>
                        </a>
                    @endforeach
                @else
                    <a href="{{ route($item['route']) }}" class="group relative flex items-center gap-3 px-3 py-2 rounded-[20px] transition-all {{ $active ? 'bg-red-50' : 'hover:bg-slate-50' }}" style="{{ $active ? 'box-shadow: inset 2px 2px 4px rgba(0,0,0,0.08), inset -2px -2px 4px rgba(255,255,255,0.9);' : '' }}">
                        @if($active)
                            <span class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-6 bg-red-500 rounded-r-full"></span>
                        @endif
                        <span class="w-6 h-6 grid place-items-center {{ $active ? 'text-red-600' : 'text-slate-500 group-hover:text-slate-700' }}">
                            <x-dynamic-component :component="'heroicon-'.$item['icon']" class="w-5 h-5" />
                        </span>
                        <span class="text-sm font-medium {{ $active ? 'text-red-600' : 'text-slate-700' }}">{{ $item['label'] }}</span>
                    </a>
                @endif
            @endforeach
        </nav>
    </div>
</aside>


