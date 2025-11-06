<x-app-layout>
    <x-card :title="'Attendance Report'" :actions="view('attendance.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="attendance-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-card class="mt-4" title="Leave Approvals">
        <div id="leave-list"></div>
    </x-card>

    @push('scripts')
    <script>
        $('#attendance-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('attendance.index') }}',
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Employee', data:'employee_id', name:'employee_id' },
                { title:'Date', data:'date', name:'date' },
                { title:'Check In', data:'check_in', name:'check_in' },
                { title:'Check Out', data:'check_out', name:'check_out' },
                { title:'Hours', data:'hours', name:'hours' },
                { title:'Status', data:'status', name:'status' },
            ]
        });

        // simple leave list
        fetch('{{ url('api/leaves') }}').then(r=>r.json()).then(rows => {
            const c = document.getElementById('leave-list');
            c.innerHTML = rows.map(r => `<div class="flex items-center justify-between border border-slate-200 rounded-xl p-3 mb-2">
                <div><div class="font-semibold">${r.employee_id} - ${r.type}</div><div class="text-xs text-slate-500">${r.from_date} → ${r.to_date}</div></div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-1 rounded-lg border border-emerald-200 text-emerald-700 hover:bg-emerald-50" onclick="updateLeave(${r.id}, true)">Approve</button>
                    <button class="px-3 py-1 rounded-lg border border-rose-200 text-rose-600 hover:bg-rose-50" onclick="updateLeave(${r.id}, false)">Reject</button>
                </div>
            </div>`).join('');
        });
        function updateLeave(id, approve){
            fetch(`{{ url('attendance/leave') }}/${id}`, { method:'POST', headers:{ 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: new URLSearchParams({ approve: approve ? 1 : 0 }) })
                .then(r=>r.json()).then(res=>{ toastr.success(res.message || 'Updated'); location.reload(); });
        }
    </script>
    @endpush
</x-app-layout>


