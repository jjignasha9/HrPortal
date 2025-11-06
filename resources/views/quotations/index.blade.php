<x-app-layout>
    <x-card :title="'Quotations'" :actions="view('quotations.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="quotations-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="quotation-modal" title="Quotation">
        <form id="quotation-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="q_code" value="Code" />
                    <x-text-input id="q_code" name="code" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="q_type" value="Type" />
                    <select id="q_type" name="type" class="mt-1 block w-full rounded-xl border-slate-200">
                        <option value="standard">Standard</option>
                        <option value="premium">Premium</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="q_client" value="Client Name" />
                    <x-text-input id="q_client" name="client_name" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="q_client_email" value="Client Email" />
                    <x-text-input id="q_client_email" name="client_email" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="q_amount" value="Amount" />
                    <x-text-input id="q_amount" name="amount" type="number" step="0.01" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="q_status" value="Status" />
                    <x-text-input id="q_status" name="status" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="q_notes" value="Notes" />
                    <textarea id="q_notes" name="notes" class="mt-1 block w-full rounded-xl border-slate-200" rows="3"></textarea>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-quotation-modal')">Cancel</x-button>
                <x-button id="quotation-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="quotation-followup-modal" title="Follow-Ups">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <table id="q-followups-table" class="display w-full"></table>
            </div>
            <div>
                <form id="q-followup-form">
                    <input type="hidden" id="qf_id" />
                    <div>
                        <x-input-label for="qf_date" value="Next Date" />
                        <x-text-input id="qf_date" type="date" class="mt-1 block w-full" />
                    </div>
                    <div class="mt-3">
                        <x-input-label for="qf_status" value="Status" />
                        <select id="qf_status" class="mt-1 block w-full rounded-xl border-slate-200">
                            <option value="pending">Pending</option>
                            <option value="sent">Sent</option>
                            <option value="won">Won</option>
                            <option value="lost">Lost</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <x-input-label for="qf_notes" value="Notes" />
                        <textarea id="qf_notes" class="mt-1 block w-full rounded-xl border-slate-200" rows="4"></textarea>
                    </div>
                    <div class="mt-4 flex items-center justify-end">
                        <x-button id="q-followup-submit">Add Follow-Up</x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>

    @push('scripts')
    <script>
        const openQ = () => window.dispatchEvent(new CustomEvent('open-quotation-modal'));
        const closeQ = () => window.dispatchEvent(new CustomEvent('close-quotation-modal'));
        const openQF = () => window.dispatchEvent(new CustomEvent('open-quotation-followup-modal'));
        const closeQF = () => window.dispatchEvent(new CustomEvent('close-quotation-followup-modal'));

        const t = $('#quotations-table').DataTable({
            processing:true, serverSide:true, ajax:'{{ route('quotations.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Code', data:'code', name:'code' },
                { title:'Type', data:'type', name:'type' },
                { title:'Client', data:'client_name', name:'client_name' },
                { title:'Amount', data:'amount', name:'amount' },
                { title:'Status', data:'status', name:'status' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:220 },
            ]
        });

        $(document).on('click', '#add-quotation', function(){
            $('#quotation-form')[0].reset();
            $('#quotation-submit').data('id','');
            openQ();
        });
        $(document).on('click', '.btn-edit', function(){
            const r = $(this).data('row');
            $('#q_code').val(r.code);
            $('#q_type').val(r.type);
            $('#q_client').val(r.client_name);
            $('#q_client_email').val(r.client_email);
            $('#q_amount').val(r.amount);
            $('#q_status').val(r.status);
            $('#q_notes').val(r.notes);
            $('#quotation-submit').data('id', r.id);
            openQ();
        });
        $('#quotation-submit').on('click', function(e){
            e.preventDefault();
            const id = $(this).data('id');
            const body = new URLSearchParams(new FormData(document.getElementById('quotation-form')));
            const url = id ? ('{{ url('quotations') }}/'+id) : '{{ route('quotations.store') }}';
            if (id) body.append('_method','PUT');
            fetch(url,{ method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body })
                .then(r=>r.json()).then(res=>{ toastr.success(res.message || 'Saved'); closeQ(); t.ajax.reload(null,false); });
        });

        $(document).on('click', '.btn-follow', function(){
            const r = $(this).data('row');
            $('#qf_id').val(r.id); loadQF(r.id); openQF();
        });
        function loadQF(id){
            fetch(`{{ url('quotations') }}/${id}/followups`).then(r=>r.json()).then(rows => {
                const el = $('#q-followups-table');
                if ($.fn.dataTable.isDataTable(el)) el.DataTable().clear().rows.add(rows).draw();
                else el.DataTable({ data: rows, columns:[
                    { title:'Date', data:'follow_up_date' },
                    { title:'Status', data:'status' },
                    { title:'Notes', data:'notes' },
                ]});
            });
        }
        $('#q-followup-submit').on('click', function(e){
            e.preventDefault();
            const id = $('#qf_id').val();
            const body = new URLSearchParams({ follow_up_date: $('#qf_date').val(), status: $('#qf_status').val(), notes: $('#qf_notes').val() });
            fetch(`{{ url('quotations') }}/${id}/followups`, { method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body })
                .then(r=>r.json()).then(res=>{ toastr.success(res.message || 'Added'); loadQF(id); $('#qf_notes').val(''); });
        });
    </script>
    @endpush
</x-app-layout>


