<x-app-layout>
    <x-card :title="'Companies'" :actions="view('companies.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="companies-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="company-modal" title="Company">
        <form id="company-form" enctype="multipart/form-data">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="c_code" value="Code" />
                    <x-text-input id="c_code" name="code" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="c_name" value="Name" />
                    <x-text-input id="c_name" name="name" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="c_email" value="Email" />
                    <x-text-input id="c_email" name="email" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="c_phone" value="Phone" />
                    <x-text-input id="c_phone" name="phone" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="c_website" value="Website" />
                    <x-text-input id="c_website" name="website" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="c_city" value="City" />
                    <x-text-input id="c_city" name="city" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="c_country" value="Country" />
                    <x-text-input id="c_country" name="country" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="c_address" value="Address" />
                    <textarea id="c_address" name="address" class="mt-1 block w-full rounded-xl border-slate-200" rows="2"></textarea>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="c_logo" value="Logo" />
                    <input id="c_logo" name="logo" type="file" class="mt-1 block w-full text-sm" />
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-company-modal')">Cancel</x-button>
                <x-button id="company-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const openC = () => window.dispatchEvent(new CustomEvent('open-company-modal'));
        const closeC = () => window.dispatchEvent(new CustomEvent('close-company-modal'));

        const t = $('#companies-table').DataTable({
            processing:true, serverSide:true, ajax:'{{ route('companies.index') }}', order:[[0,'desc']],
            columns:[
                { title:'ID', data:'id', name:'id', width:60 },
                { title:'Logo', data:'logo', orderable:false, searchable:false, width:60 },
                { title:'Code', data:'code', name:'code' },
                { title:'Name', data:'name', name:'name' },
                { title:'Email', data:'email', name:'email' },
                { title:'Phone', data:'phone', name:'phone' },
                { title:'City', data:'city', name:'city' },
                { title:'Country', data:'country', name:'country' },
                { title:'Actions', data:'action', orderable:false, searchable:false, width:180 },
            ]
        });

        $(document).on('click','#add-company', function(){
            $('#company-form')[0].reset();
            $('#company-submit').data('id',''); openC();
        });
        $(document).on('click','.btn-edit', function(){
            const r = $(this).data('row');
            $('#c_code').val(r.code); $('#c_name').val(r.name); $('#c_email').val(r.email); $('#c_phone').val(r.phone);
            $('#c_website').val(r.website); $('#c_city').val(r.city); $('#c_country').val(r.country); $('#c_address').val(r.address);
            $('#company-submit').data('id', r.id); openC();
        });
        $('#company-submit').on('click', function(e){
            e.preventDefault();
            const id = $(this).data('id'); const form = document.getElementById('company-form');
            const body = new FormData(form);
            const url = id ? ('{{ url('companies') }}/'+id) : '{{ route('companies.store') }}';
            if (id) body.append('_method','PUT');
            fetch(url, { method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body })
                .then(r=>r.json()).then(res=>{ toastr.success(res.message || 'Saved'); closeC(); t.ajax.reload(null,false); });
        });
        $(document).on('click','.btn-delete', function(){
            const id = $(this).data('id');
            Swal.fire({ title:'Delete?', icon:'warning', showCancelButton:true }).then(res => {
                if (!res.isConfirmed) return;
                fetch('{{ url('companies') }}/'+id, { method:'POST', headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }, body: new URLSearchParams({ _method:'DELETE' }) })
                    .then(r=>r.json()).then(res=>{ toastr.success(res.message || 'Deleted'); t.ajax.reload(null,false); });
            });
        });
    </script>
    @endpush
</x-app-layout>


