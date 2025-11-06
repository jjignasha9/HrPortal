<x-app-layout>
    <x-card :title="'Inquiries'" :actions="view('inquiries.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="inquiries-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="inquiry-modal" title="Inquiry">
        <form id="inquiry-form">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="q_code" value="Code" />
                    <x-text-input id="q_code" name="code" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="q_name" value="Name" />
                    <x-text-input id="q_name" name="name" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="q_email" value="Email" />
                    <x-text-input id="q_email" name="email" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="q_phone" value="Phone" />
                    <x-text-input id="q_phone" name="phone" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="q_message" value="Message" />
                    <textarea id="q_message" name="message" class="mt-1 block w-full rounded-xl border-slate-200" rows="3"></textarea>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-inquiry-modal')">Cancel</x-button>
                <x-button id="inquiry-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    <x-modal name="followup-modal" title="Follow-Ups">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <table id="followups-table" class="display w-full"></table>
            </div>
            <div>
                <form id="followup-form">
                    <input type="hidden" id="f_inquiry_id" />
                    <div>
                        <x-input-label for="f_date" value="Next Date" />
                        <x-text-input id="f_date" type="date" class="mt-1 block w-full" />
                    </div>
                    <div class="mt-3">
                        <x-input-label for="f_status" value="Status" />
                        <select id="f_status" class="mt-1 block w-full rounded-xl border-slate-200">
                            <option value="pending">Pending</option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <x-input-label for="f_notes" value="Notes" />
                        <textarea id="f_notes" class="mt-1 block w-full rounded-xl border-slate-200" rows="4"></textarea>
                    </div>
                    <div class="mt-4 flex items-center justify-end">
                        <x-button id="followup-submit">Add Follow-Up</x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-modal>

    @push('scripts')
    <script>
        const openInquiry = () => window.dispatchEvent(new CustomEvent('open-inquiry-modal'));
        const closeInquiry = () => window.dispatchEvent(new CustomEvent('close-inquiry-modal'));
        const openFollow = () => window.dispatchEvent(new CustomEvent('open-followup-modal'));
        const closeFollow = () => window.dispatchEvent(new CustomEvent('close-followup-modal'));

        const t = $('#inquiries-table').DataTable({
            processing:true, serverSide:true, ajax:'{{ route('inquiries.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Code', data:'code', name:'code' },
                { title:'Name', data:'name', name:'name' },
                { title:'Email', data:'email', name:'email' },
                { title:'Phone', data:'phone', name:'phone' },
                { title:'Status', data:'status', name:'status' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:200 },
            ]
        });

        $(document).on('click', '#add-inquiry', function(){
            $('#inquiry-form')[0].reset();
            $('#inquiry-submit').data('id','');
            openInquiry();
        });
        $(document).on('click', '.btn-edit', function(){
            const r = $(this).data('row');
            $('#q_code').val(r.code);
            $('#q_name').val(r.name);
            $('#q_email').val(r.email);
            $('#q_phone').val(r.phone);
            $('#q_message').val(r.message);
            $('#inquiry-submit').data('id', r.id);
            openInquiry();
        });
        $('#inquiry-submit').on('click', function(e){
            e.preventDefault();
            const id = $(this).data('id');
            const body = new URLSearchParams(new FormData(document.getElementById('inquiry-form')));
            const url = id ? ('{{ url('inquiries') }}/'+id) : '{{ route('inquiries.store') }}';
            if (id) body.append('_method','PUT');
            fetch(url, { method:'POST', headers:{ 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body }).then(r=>r.json()).then(res=>{ toastr.success(res.message || 'Saved'); closeInquiry(); t.ajax.reload(null,false); });
        });

        // follow-ups
        $(document).on('click', '.btn-follow', function(){
            const r = $(this).data('row');
            $('#f_inquiry_id').val(r.id);
            loadFollowups(r.id);
            openFollow();
        });
        function loadFollowups(id){
            fetch(`{{ url('inquiries') }}/${id}/followups`).then(r=>r.json()).then(rows => {
                const tbl = $('#followups-table');
                if ($.fn.dataTable.isDataTable(tbl)) tbl.DataTable().clear().rows.add(rows).draw();
                else tbl.DataTable({ data: rows, columns:[
                    { title:'Date', data:'follow_up_date' },
                    { title:'Status', data:'status' },
                    { title:'Notes', data:'notes' },
                ]});
            });
        }
        $('#followup-submit').on('click', function(e){
            e.preventDefault();
            const id = $('#f_inquiry_id').val();
            const body = new URLSearchParams({
                follow_up_date: $('#f_date').val(),
                status: $('#f_status').val(),
                notes: $('#f_notes').val(),
            });
            fetch(`{{ url('inquiries') }}/${id}/followups`, { method:'POST', headers:{ 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body })
                .then(r=>r.json()).then(res=>{ toastr.success(res.message || 'Added'); loadFollowups(id); $('#f_notes').val(''); });
        });
    </script>
    @endpush
</x-app-layout>


