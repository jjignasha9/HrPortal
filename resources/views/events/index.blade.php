<x-app-layout>
    <x-card :title="'Events'" :actions="view('events.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="events-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="event-modal" title="Event">
        <form id="event-form" enctype="multipart/form-data">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><x-input-label for="e_title" value="Title" /><x-text-input id="e_title" name="title" class="mt-1 block w-full" /></div>
                <div><x-input-label for="e_date" value="Date" /><x-text-input id="e_date" name="event_date" type="date" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="e_desc" value="Description" /><textarea id="e_desc" name="description" class="mt-1 block w-full rounded-xl border-slate-200" rows="3"></textarea></div>
                <div class="sm:col-span-2"><x-input-label for="e_media" value="Media (images/videos, multiple)" /><input id="e_media" name="media[]" type="file" class="mt-1 block w-full text-sm" multiple /></div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-event-modal')">Cancel</x-button>
                <x-button id="event-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openE = () => window.dispatchEvent(new CustomEvent('open-event-modal'));
        const closeE = () => window.dispatchEvent(new CustomEvent('close-event-modal'));
        const t = $('#events-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('events.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Title', data:'title', name:'title' },
                { title:'Date', data:'event_date', name:'event_date' },
                { title:'Media', data:'media', orderable:false, searchable:false, width:120 },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:200 },
            ]
        });
        $(document).on('click','#add-event', function(){ $('#event-form')[0].reset(); $('#event-submit').data('id',''); openE(); });
        $(document).on('click','.btn-edit', function(){ const r=$(this).data('row'); $('#e_title').val(r.title); $('#e_date').val(r.event_date); $('#e_desc').val(r.description); $('#event-submit').data('id', r.id); openE(); });
        $('#event-submit').on('click', function(e){ e.preventDefault(); const id=$(this).data('id'); const fd=new FormData(document.getElementById('event-form')); const url=id? ('{{ url('events') }}/'+id):'{{ route('events.store') }}'; if(id) fd.append('_method','PUT'); fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body:fd }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Saved'); closeE(); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-delete', function(){ const id=$(this).data('id'); Swal.fire({title:'Delete?',icon:'warning',showCancelButton:true}).then(res=>{ if(!res.isConfirmed) return; fetch('{{ url('events') }}/'+id,{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ _method:'DELETE' }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Deleted'); t.ajax.reload(null,false); }); }); });
    </script>
    @endpush
</x-app-layout>


