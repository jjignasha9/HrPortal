<x-app-layout>
    <x-card :title="'Performa Invoices'" :actions="view('performas.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="performas-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="performa-modal" title="Performa">
        <form id="performa-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="pf_number" value="Number" />
                    <x-text-input id="pf_number" name="number" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="pf_date" value="Date" />
                    <x-text-input id="pf_date" name="date" type="date" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="pf_client" value="Client Name" />
                    <x-text-input id="pf_client" name="client_name" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="pf_email" value="Client Email" />
                    <x-text-input id="pf_email" name="client_email" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="pf_phone" value="Client Phone" />
                    <x-text-input id="pf_phone" name="client_phone" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="pf_address" value="Client Address" />
                    <textarea id="pf_address" name="client_address" class="mt-1 block w-full rounded-xl border-slate-200" rows="2"></textarea>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label value="Items (JSON)" />
                    <textarea id="pf_items" name="items" class="mt-1 block w-full rounded-xl border-slate-200" rows="4" placeholder='[{"name":"Design","qty":1,"price":1000}]'></textarea>
                </div>
                <div>
                    <x-input-label for="pf_subtotal" value="Subtotal" />
                    <x-text-input id="pf_subtotal" name="subtotal" type="number" step="0.01" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="pf_tax" value="Tax" />
                    <x-text-input id="pf_tax" name="tax" type="number" step="0.01" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="pf_total" value="Total" />
                    <x-text-input id="pf_total" name="total" type="number" step="0.01" class="mt-1 block w-full" />
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-performa-modal')">Cancel</x-button>
                <x-button id="performa-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openPF = () => window.dispatchEvent(new CustomEvent('open-performa-modal'));
        const closePF = () => window.dispatchEvent(new CustomEvent('close-performa-modal'));
        const t = $('#performas-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('performas.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Number', data:'number', name:'number' },
                { title:'Date', data:'date', name:'date' },
                { title:'Client', data:'client_name', name:'client_name' },
                { title:'Total', data:'total', name:'total' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:220 },
            ]
        });
        $(document).on('click','#add-performa', function(){ $('#performa-form')[0].reset(); $('#performa-submit').data('id',''); openPF(); });
        $(document).on('click','.btn-edit', function(){ const r=$(this).data('row');
            $('#pf_number').val(r.number); $('#pf_date').val(r.date); $('#pf_client').val(r.client_name); $('#pf_email').val(r.client_email); $('#pf_phone').val(r.client_phone); $('#pf_address').val(r.client_address); $('#pf_items').val(JSON.stringify(r.items||[],null,0)); $('#pf_subtotal').val(r.subtotal); $('#pf_tax').val(r.tax); $('#pf_total').val(r.total); $('#performa-submit').data('id', r.id); openPF(); });
        $('#performa-submit').on('click', function(e){ e.preventDefault(); const id=$(this).data('id'); const form=document.getElementById('performa-form'); const fd=new FormData(form); try{ const items=JSON.parse($('#pf_items').val()||'[]'); fd.set('items', JSON.stringify(items)); }catch{}; const url=id? ('{{ url('performas') }}/'+id):'{{ route('performas.store') }}'; if(id) fd.append('_method','PUT'); fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body:fd}).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Saved'); closePF(); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-delete', function(){ const id=$(this).data('id'); Swal.fire({title:'Delete?',icon:'warning',showCancelButton:true}).then(res=>{ if(!res.isConfirmed) return; fetch('{{ url('performas') }}/'+id,{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ _method:'DELETE' }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Deleted'); t.ajax.reload(null,false); }); }); });
    </script>
    @endpush
</x-app-layout>


