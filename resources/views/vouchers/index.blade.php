<x-app-layout>
    <x-card :title="'Vouchers'" :actions="view('vouchers.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="vouchers-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="voucher-modal" title="Voucher">
        <form id="voucher-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><x-input-label for="v_number" value="Number" /><x-text-input id="v_number" name="number" class="mt-1 block w-full" /></div>
                <div><x-input-label for="v_date" value="Date" /><x-text-input id="v_date" type="date" name="date" class="mt-1 block w-full" /></div>
                <div><x-input-label for="v_payee" value="Payee Name" /><x-text-input id="v_payee" name="payee_name" class="mt-1 block w-full" /></div>
                <div><x-input-label for="v_amount" value="Amount" /><x-text-input id="v_amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" /></div>
                <div><x-input-label for="v_mode" value="Mode" /><x-text-input id="v_mode" name="mode" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="v_ref" value="Reference" /><x-text-input id="v_ref" name="reference" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="v_notes" value="Notes" /><textarea id="v_notes" name="notes" class="mt-1 block w-full rounded-xl border-slate-200" rows="2"></textarea></div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-voucher-modal')">Cancel</x-button>
                <x-button id="voucher-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openV = () => window.dispatchEvent(new CustomEvent('open-voucher-modal'));
        const closeV = () => window.dispatchEvent(new CustomEvent('close-voucher-modal'));
        const t = $('#vouchers-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('vouchers.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Number', data:'number', name:'number' },
                { title:'Date', data:'date', name:'date' },
                { title:'Payee', data:'payee_name', name:'payee_name' },
                { title:'Amount', data:'amount', name:'amount' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:220 },
            ]
        });
        $(document).on('click','#add-voucher', function(){ $('#voucher-form')[0].reset(); $('#voucher-submit').data('id',''); openV(); });
        $(document).on('click','.btn-edit', function(){ const r=$(this).data('row'); $('#v_number').val(r.number); $('#v_date').val(r.date); $('#v_payee').val(r.payee_name); $('#v_amount').val(r.amount); $('#v_mode').val(r.mode); $('#v_ref').val(r.reference); $('#v_notes').val(r.notes); $('#voucher-submit').data('id', r.id); openV(); });
        $('#voucher-submit').on('click', function(e){ e.preventDefault(); const id=$(this).data('id'); const body=new URLSearchParams(new FormData(document.getElementById('voucher-form'))); const url=id? ('{{ url('vouchers') }}/'+id):'{{ route('vouchers.store') }}'; if(id) body.append('_method','PUT'); fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Saved'); closeV(); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-delete', function(){ const id=$(this).data('id'); Swal.fire({title:'Delete?',icon:'warning',showCancelButton:true}).then(res=>{ if(!res.isConfirmed) return; fetch('{{ url('vouchers') }}/'+id,{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ _method:'DELETE' }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Deleted'); t.ajax.reload(null,false); }); }); });
    </script>
    @endpush
</x-app-layout>


