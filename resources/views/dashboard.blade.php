<x-app-layout>
    <div x-data class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
        <x-card title="Clock">
            <div id="live-clock" class="text-3xl font-bold tracking-wide">--:--:--</div>
        </x-card>
        <x-card title="Calendar">
            <div id="calendar" class="text-slate-600">{{ now()->toFormattedDateString() }}</div>
        </x-card>
        <x-card title="Notes">
            <textarea class="w-full rounded-xl border-slate-200" rows="4" placeholder="Write a note..."></textarea>
            <div class="mt-3">
                <x-button>Save</x-button>
            </div>
        </x-card>
        <x-card title="Summary">
            <div class="grid grid-cols-2 gap-3 text-sm">
                <div class="rounded-xl border border-slate-200 p-3">
                    <div class="text-slate-500">Employees</div>
                    <div class="text-xl font-semibold">{{ $summary['employees'] ?? 0 }}</div>
                </div>
                <div class="rounded-xl border border-slate-200 p-3">
                    <div class="text-slate-500">Companies</div>
                    <div class="text-xl font-semibold">{{ $summary['companies'] ?? 0 }}</div>
                </div>
                <div class="rounded-xl border border-slate-200 p-3">
                    <div class="text-slate-500">Tickets (Open)</div>
                    <div class="text-xl font-semibold">{{ $summary['tickets_open'] ?? 0 }}</div>
                </div>
                <div class="rounded-xl border border-slate-200 p-3">
                    <div class="text-slate-500">Tickets (Resolved)</div>
                    <div class="text-xl font-semibold">{{ $summary['tickets_resolved'] ?? 0 }}</div>
                </div>
            </div>
        </x-card>
    </div>

    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-card title="Company Summary">
            <canvas id="companyChart" height="120"></canvas>
        </x-card>
        <x-card title="Recent Inquiries">
            <ul class="divide-y">
                @forelse(($recentInquiries ?? []) as $rq)
                    <li class="py-2 flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $rq->code }}</div>
                            <div class="text-xs text-slate-500">{{ $rq->name }}</div>
                        </div>
                        <span class="text-xs px-2 py-1 rounded-lg border border-slate-200">{{ $rq->status }}</span>
                    </li>
                @empty
                    <li class="py-2 text-sm text-slate-500">No inquiries</li>
                @endforelse
            </ul>
        </x-card>
    </div>

    <div class="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-4">
        <x-card title="Recent Tickets">
            <ul class="divide-y">
                @forelse(($recentTickets ?? []) as $tk)
                    <li class="py-2 flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $tk->code }}</div>
                            <div class="text-xs text-slate-500">{{ $tk->title }}</div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs px-2 py-1 rounded-lg border border-slate-200">{{ $tk->priority }}</span>
                            <span class="text-xs px-2 py-1 rounded-lg border border-slate-200">{{ $tk->status }}</span>
                        </div>
                    </li>
                @empty
                    <li class="py-2 text-sm text-slate-500">No tickets</li>
                @endforelse
            </ul>
        </x-card>
    </div>

    @push('scripts')
    <script type="module">
        const ctx = document.getElementById('companyChart');
        if (ctx) {
            const labels = @json($chart['labels'] ?? []);
            const values = @json($chart['data'] ?? []);
            new window.Chart(ctx, { type: 'bar', data: { labels, datasets: [{ label: 'Companies / month', data: values, backgroundColor: '#38bdf8'}] }, options: { scales: { y: { beginAtZero: true }}} });
        }
        const clock = document.getElementById('live-clock');
        if (clock) {
            setInterval(() => { const d=new Date(); clock.textContent = d.toLocaleTimeString(); }, 1000);
        }
    </script>
    @endpush
</x-app-layout>
