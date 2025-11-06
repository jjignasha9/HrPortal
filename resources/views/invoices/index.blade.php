<x-app-layout>
    <x-card :title="'Invoices'" :actions="view('invoices.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="invoices-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="invoice-modal" title="Invoice">
        <form id="invoice-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><x-input-label for="iv_number" value="Number" /><x-text-input id="iv_number" name="number" class="mt-1 block w-full" /></div>
                <div><x-input-label for="iv_date" value="Date" /><x-text-input id="iv_date" name="date" type="date" class="mt-1 block w-full" /></div>
                <div><x-input-label for="iv_client" value="Client Name" /><x-text-input id="iv_client" name="client_name" class="mt-1 block w-full" /></div>
                <div><x-input-label for="iv_email" value="Client Email" /><x-text-input id="iv_email" name="client_email" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="iv_phone" value="Client Phone" /><x-text-input id="iv_phone" name="client_phone" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="iv_address" value="Client Address" /><textarea id="iv_address" name="client_address" class="mt-1 block w-full rounded-xl border-slate-200" rows="2"></textarea></div>
                <div class="sm:col-span-2"><x-input-label value="Items (JSON)" /><textarea id="iv_items" name="items" class="mt-1 block w-full rounded-xl border-slate-200" rows="4" placeholder='[{"name":"Design","qty":1,"price":1000}]'></textarea></div>
                <div><x-input-label for="iv_subtotal" value="Subtotal" /><x-text-input id="iv_subtotal" name="subtotal" type="number" step="0.01" class="mt-1 block w-full" /></div>
                <div><x-input-label for="iv_tax" value="Tax" /><x-text-input id="iv_tax" name="tax" type="number" step="0.01" class="mt-1 block w-full" /></div>
                <div><x-input-label for="iv_total" value="Total" /><x-text-input id="iv_total" name="total" type="number" step="0.01" class="mt-1 block w-full" /></div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-invoice-modal')">Cancel</x-button>
                <x-button id="invoice-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openIV = () => window.dispatchEvent(new CustomEvent('open-invoice-modal'));
        const closeIV = () => window.dispatchEvent(new CustomEvent('close-invoice-modal'));
        const t = $('#invoices-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('invoices.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Number', data:'number', name:'number' },
                { title:'Date', data:'date', name:'date' },
                { title:'Client', data:'client_name', name:'client_name' },
                { title:'Total', data:'total', name:'total' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:220 },
            ]
        });
        $(document).on('click','#add-invoice', function(){ $('#invoice-form')[0].reset(); $('#invoice-submit').data('id',''); openIV(); });
        $(document).on('click','.btn-edit', function(){ const r=$(this).data('row'); $('#iv_number').val(r.number); $('#iv_date').val(r.date); $('#iv_client').val(r.client_name); $('#iv_email').val(r.client_email); $('#iv_phone').val(r.client_phone); $('#iv_address').val(r.client_address); $('#iv_items').val(JSON.stringify(r.items||[],null,0)); $('#iv_subtotal').val(r.subtotal); $('#iv_tax').val(r.tax); $('#iv_total').val(r.total); $('#invoice-submit').data('id', r.id); openIV(); });
        $('#invoice-submit').on('click', function(e){ e.preventDefault(); const id=$(this).data('id'); const fd=new FormData(document.getElementById('invoice-form')); try{ fd.set('items', JSON.stringify(JSON.parse($('#iv_items').val()||'[]'))); }catch{}; const url=id? ('{{ url('invoices') }}/'+id):'{{ route('invoices.store') }}'; if(id) fd.append('_method','PUT'); fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body:fd }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Saved'); closeIV(); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-delete', function(){ const id=$(this).data('id'); Swal.fire({title:'Delete?',icon:'warning',showCancelButton:true}).then(res=>{ if(!res.isConfirmed) return; fetch('{{ url('invoices') }}/'+id,{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ _method:'DELETE' }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Deleted'); t.ajax.reload(null,false); }); }); });
    </script>
    @endpush
</x-app-layout>


