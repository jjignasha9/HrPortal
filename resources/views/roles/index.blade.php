<x-app-layout>
    <x-card :title="'Roles & Permissions'" :actions="view('roles.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="roles-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="role-modal" title="Role">
        <form id="role-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="role_name" value="Role Name" />
                    <x-text-input id="role_name" name="name" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="role_perms" value="Permissions" />
                    <select id="role_perms" name="permissions[]" multiple class="mt-1 block w-full rounded-xl border-slate-200 h-40">
                        @foreach($permissions as $p)
                            <option value="{{ $p }}">{{ $p }}</option>
                        @endforeach
                    </select>
                    <div class="text-xs text-slate-500 mt-1">Hold Ctrl/Cmd to select multiple</div>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-role-modal')">Cancel</x-button>
                <x-button id="role-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openR = () => window.dispatchEvent(new CustomEvent('open-role-modal'));
        const closeR = () => window.dispatchEvent(new CustomEvent('close-role-modal'));
        const t = $('#roles-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('roles.index') }}', order:[[0,'asc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Name', data:'name', name:'name' },
                { title:'Permissions', data:'permissions', orderable:false, searchable:false },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:180 },
            ]
        });
        $(document).on('click','#add-role', function(){ $('#role-form')[0].reset(); $('#role_perms option').prop('selected', false); $('#role-submit').data('id',''); openR(); });
        $(document).on('click','.btn-edit', function(){ const r=$(this).data('row'); $('#role_name').val(r.name); $('#role_perms option').prop('selected', false); (r.permissions || '').split(',').map(s=>s.trim()).filter(Boolean).forEach(v=>{ $('#role_perms option[value="'+v.replaceAll('"','\"')+'"]').prop('selected', true); }); $('#role-submit').data('id', r.id); openR(); });
        $('#role-submit').on('click', function(e){ e.preventDefault(); const id=$(this).data('id'); const form=document.getElementById('role-form'); const body=new FormData(form); const url=id? ('{{ url('roles') }}/'+id):'{{ route('roles.store') }}'; if(id) body.append('_method','PUT'); fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Saved'); closeR(); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-delete', function(){ const id=$(this).data('id'); Swal.fire({title:'Delete?',icon:'warning',showCancelButton:true}).then(res=>{ if(!res.isConfirmed) return; fetch('{{ url('roles') }}/'+id,{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ _method:'DELETE' }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Deleted'); t.ajax.reload(null,false); }); }); });
    </script>
    @endpush
</x-app-layout>


