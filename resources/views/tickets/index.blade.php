<x-app-layout>
    <x-card :title="'Tickets'" :actions="view('tickets.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="tickets-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="ticket-modal" title="Ticket">
        <form id="ticket-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><x-input-label for="t_code" value="Code" /><x-text-input id="t_code" name="code" class="mt-1 block w-full" /></div>
                <div><x-input-label for="t_title" value="Title" /><x-text-input id="t_title" name="title" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="t_desc" value="Description" /><textarea id="t_desc" name="description" class="mt-1 block w-full rounded-xl border-slate-200" rows="3"></textarea></div>
                <div><x-input-label for="t_priority" value="Priority" /><x-text-input id="t_priority" name="priority" class="mt-1 block w-full" /></div>
                <div><x-input-label for="t_status" value="Status" /><x-text-input id="t_status" name="status" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="t_assigned" value="Assigned User ID" /><x-text-input id="t_assigned" name="assigned_to" class="mt-1 block w-full" /></div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-ticket-modal')">Cancel</x-button>
                <x-button id="ticket-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openT = () => window.dispatchEvent(new CustomEvent('open-ticket-modal'));
        const closeT = () => window.dispatchEvent(new CustomEvent('close-ticket-modal'));
        const t = $('#tickets-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('tickets.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Code', data:'code', name:'code' },
                { title:'Title', data:'title', name:'title' },
                { title:'Priority', data:'priority', name:'priority' },
                { title:'Status', data:'status', name:'status' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:260 },
            ]
        });
        $(document).on('click','#add-ticket', function(){ $('#ticket-form')[0].reset(); $('#ticket-submit').data('id',''); openT(); });
        $(document).on('click','.btn-edit', function(){ const r=$(this).data('row'); $('#t_code').val(r.code); $('#t_title').val(r.title); $('#t_desc').val(r.description); $('#t_priority').val(r.priority); $('#t_status').val(r.status); $('#t_assigned').val(r.assigned_to); $('#ticket-submit').data('id', r.id); openT(); });
        $('#ticket-submit').on('click', function(e){ e.preventDefault(); const id=$(this).data('id'); const body=new URLSearchParams(new FormData(document.getElementById('ticket-form'))); const url=id? ('{{ url('tickets') }}/'+id):'{{ route('tickets.store') }}'; if(id) body.append('_method','PUT'); fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Saved'); closeT(); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-delete', function(){ const id=$(this).data('id'); Swal.fire({title:'Delete?',icon:'warning',showCancelButton:true}).then(res=>{ if(!res.isConfirmed) return; fetch('{{ url('tickets') }}/'+id,{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ _method:'DELETE' }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Deleted'); t.ajax.reload(null,false); }); }); });
        $(document).on('click','.btn-assign', function(){ const id=$(this).data('id'); const to=prompt('Assign to User ID:'); if(!to) return; fetch('{{ url('tickets') }}/'+id+'/assign',{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ assigned_to: to }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Assigned'); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-resolve', function(){ const id=$(this).data('id'); fetch('{{ url('tickets') }}/'+id+'/resolve',{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'} }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Resolved'); t.ajax.reload(null,false); }); });
    </script>
    @endpush
</x-app-layout>


