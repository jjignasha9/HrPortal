<x-app-layout>
    <x-card :title="'Receipts'" :actions="view('receipts.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="receipts-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="receipt-modal" title="Receipt">
        <form id="receipt-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div><x-input-label for="r_number" value="Number" /><x-text-input id="r_number" name="number" class="mt-1 block w-full" /></div>
                <div><x-input-label for="r_date" value="Date" /><x-text-input id="r_date" type="date" name="date" class="mt-1 block w-full" /></div>
                <div><x-input-label for="r_name" value="Payer Name" /><x-text-input id="r_name" name="payer_name" class="mt-1 block w-full" /></div>
                <div><x-input-label for="r_email" value="Payer Email" /><x-text-input id="r_email" name="payer_email" class="mt-1 block w-full" /></div>
                <div><x-input-label for="r_amount" value="Amount" /><x-text-input id="r_amount" type="number" step="0.01" name="amount" class="mt-1 block w-full" /></div>
                <div><x-input-label for="r_mode" value="Mode" /><x-text-input id="r_mode" name="mode" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="r_ref" value="Reference" /><x-text-input id="r_ref" name="reference" class="mt-1 block w-full" /></div>
                <div class="sm:col-span-2"><x-input-label for="r_notes" value="Notes" /><textarea id="r_notes" name="notes" class="mt-1 block w-full rounded-xl border-slate-200" rows="2"></textarea></div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-receipt-modal')">Cancel</x-button>
                <x-button id="receipt-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openR = () => window.dispatchEvent(new CustomEvent('open-receipt-modal'));
        const closeR = () => window.dispatchEvent(new CustomEvent('close-receipt-modal'));
        const t = $('#receipts-table').DataTable({ processing:true, serverSide:true, ajax:'{{ route('receipts.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Number', data:'number', name:'number' },
                { title:'Date', data:'date', name:'date' },
                { title:'Payer', data:'payer_name', name:'payer_name' },
                { title:'Amount', data:'amount', name:'amount' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:220 },
            ]
        });
        $(document).on('click','#add-receipt', function(){ $('#receipt-form')[0].reset(); $('#receipt-submit').data('id',''); openR(); });
        $(document).on('click','.btn-edit', function(){ const r=$(this).data('row'); $('#r_number').val(r.number); $('#r_date').val(r.date); $('#r_name').val(r.payer_name); $('#r_email').val(r.payer_email); $('#r_amount').val(r.amount); $('#r_mode').val(r.mode); $('#r_ref').val(r.reference); $('#r_notes').val(r.notes); $('#receipt-submit').data('id', r.id); openR(); });
        $('#receipt-submit').on('click', function(e){ e.preventDefault(); const id=$(this).data('id'); const body=new URLSearchParams(new FormData(document.getElementById('receipt-form'))); const url=id? ('{{ url('receipts') }}/'+id):'{{ route('receipts.store') }}'; if(id) body.append('_method','PUT'); fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Saved'); closeR(); t.ajax.reload(null,false); }); });
        $(document).on('click','.btn-delete', function(){ const id=$(this).data('id'); Swal.fire({title:'Delete?',icon:'warning',showCancelButton:true}).then(res=>{ if(!res.isConfirmed) return; fetch('{{ url('receipts') }}/'+id,{ method:'POST', headers:{'X-CSRF-TOKEN':'{{ csrf_token() }}'}, body:new URLSearchParams({ _method:'DELETE' }) }).then(r=>r.json()).then(res=>{ toastr.success(res.message||'Deleted'); t.ajax.reload(null,false); }); }); });
    </script>
    @endpush
</x-app-layout>


