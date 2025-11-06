<x-app-layout>
    <x-card :title="'Projects'" :actions="view('projects.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="projects-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="project-modal" title="Project">
        <form id="project-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="p_code" value="Code" />
                    <x-text-input id="p_code" name="code" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="p_name" value="Name" />
                    <x-text-input id="p_name" name="name" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="p_company_id" value="Company ID" />
                    <x-text-input id="p_company_id" name="company_id" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="p_budget" value="Budget" />
                    <x-text-input id="p_budget" name="budget" type="number" step="0.01" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="p_start" value="Start Date" />
                    <x-text-input id="p_start" name="start_date" type="date" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="p_end" value="End Date" />
                    <x-text-input id="p_end" name="end_date" type="date" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="p_status" value="Status" />
                    <x-text-input id="p_status" name="status" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="p_desc" value="Description" />
                    <textarea id="p_desc" name="description" class="mt-1 block w-full rounded-xl border-slate-200" rows="3"></textarea>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-project-modal')">Cancel</x-button>
                <x-button id="project-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openP = () => window.dispatchEvent(new CustomEvent('open-project-modal'));
        const closeP = () => window.dispatchEvent(new CustomEvent('close-project-modal'));
        const t = $('#projects-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('projects.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Code', data:'code', name:'code' },
                { title:'Name', data:'name', name:'name' },
                { title:'Company', data:'company_id', name:'company_id' },
                { title:'Budget', data:'budget', name:'budget' },
                { title:'Status', data:'status', name:'status' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:180 }
            ]
        });
        $(document).on('click','#add-project', function(){ $('#project-form')[0].reset(); $('#project-submit').data('id',''); openP(); });
        $(document).on('click','.btn-edit', function(){ const r=$(this).data('row');
            $('#p_code').val(r.code); $('#p_name').val(r.name); $('#p_company_id').val(r.company_id); $('#p_budget').val(r.budget);
            $('#p_start').val(r.start_date); $('#p_end').val(r.end_date); $('#p_status').val(r.status); $('#p_desc').val(r.description);
            $('#project-submit').data('id', r.id); openP(); });
        $('#project-submit').on('click', function(e){ e.preventDefault(); const id=$(this).data('id'); const body = new URLSearchParams(new FormData(document.getElementById('project-form')));
            const url = id ? ('{{ url('projects') }}/'+id) : '{{ route('projects.store') }}'; if (id) body.append('_method','PUT');
            fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Saved'); closeP(); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-delete', function(){ const id=$(this).data('id'); Swal.fire({title:'Delete?',icon:'warning',showCancelButton:true}).then(res=>{ if(!res.isConfirmed) return; fetch('{{ url('projects') }}/'+id,{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ _method:'DELETE' }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Deleted'); t.ajax.reload(null,false); }); }); });
    </script>
    @endpush
</x-app-layout>


