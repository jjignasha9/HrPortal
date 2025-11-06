<x-app-layout>
    <x-card :title="'Employees'" :actions="view('hr.employees.partials.header-actions')">
        <div class="overflow-x-auto">
            <table id="employees-table" class="display w-full"></table>
        </div>
    </x-card>

    <x-modal name="employee-modal" title="Employee">
        <form id="employee-form" enctype="multipart/form-data">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="e_code" value="Code" />
                    <x-text-input id="e_code" name="code" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="e_email" value="Email" />
                    <x-text-input id="e_email" name="email" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="e_first_name" value="First name" />
                    <x-text-input id="e_first_name" name="first_name" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="e_last_name" value="Last name" />
                    <x-text-input id="e_last_name" name="last_name" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="e_mobile" value="Mobile" />
                    <x-text-input id="e_mobile" name="mobile" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="e_gender" value="Gender" />
                    <select id="e_gender" name="gender" class="mt-1 block w-full rounded-xl border-slate-200">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <x-input-label for="e_designation" value="Designation" />
                    <x-text-input id="e_designation" name="designation" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="e_salary" value="Salary" />
                    <x-text-input id="e_salary" type="number" step="0.01" name="salary" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="e_photo" value="Photo" />
                    <input id="e_photo" name="photo" type="file" class="mt-1 block w-full text-sm" />
                </div>
            </div>
            <div class="mt-4 flex items-center justify-end gap-2">
                <x-button variant="secondary" x-on:click="$dispatch('close-employee-modal')">Cancel</x-button>
                <x-button id="employee-submit">Save</x-button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <script>
        const modalOpen = () => window.dispatchEvent(new CustomEvent('open-employee-modal'));
        const modalClose = () => window.dispatchEvent(new CustomEvent('close-employee-modal'));

        const table = $('#employees-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('employees.index') }}',
            order: [[0, 'desc']],
            columns: [
                { title: 'ID', data: 'id', name: 'id', width: 60 },
                { title: 'Photo', data: 'photo', orderable: false, searchable: false, width: 60 },
                { title: 'Code', data: 'code', name: 'code' },
                { title: 'Name', data: 'name', name: 'name' },
                { title: 'Email', data: 'email', name: 'email' },
                { title: 'Designation', data: 'designation', name: 'designation' },
                { title: 'Salary', data: 'salary', name: 'salary' },
                { title: 'Actions', data: 'action', orderable: false, searchable: false, width: 160 },
            ]
        });

        $(document).on('click', '#add-employee', function(){
            $('#employee-form')[0].reset();
            $('#employee-submit').data('id','');
            modalOpen();
        });

        $(document).on('click', '.btn-edit', function(){
            const r = $(this).data('row');
            $('#e_code').val(r.code);
            $('#e_email').val(r.email);
            $('#e_first_name').val(r.first_name);
            $('#e_last_name').val(r.last_name);
            $('#e_mobile').val(r.mobile);
            $('#e_gender').val(r.gender);
            $('#e_designation').val(r.designation);
            $('#e_salary').val(r.salary);
            $('#employee-submit').data('id', r.id);
            modalOpen();
        });

        $('#employee-submit').on('click', function(e){
            e.preventDefault();
            const id = $(this).data('id');
            const form = document.getElementById('employee-form');
            const body = new FormData(form);
            const url = id ? ('{{ url('employees') }}/' + id) : '{{ route('employees.store') }}';
            if (id) body.append('_method','PUT');
            fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body })
                .then(r => r.json())
                .then(res => { window.toastr.success(res.message || 'Saved'); modalClose(); table.ajax.reload(null,false); });
        });

        $(document).on('click','.btn-delete', function(){
            const id = $(this).data('id');
            Swal.fire({ title: 'Delete?', icon:'warning', showCancelButton:true }).then(res => {
                if (!res.isConfirmed) return;
                fetch('{{ url('employees') }}/' + id, { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: new URLSearchParams({ _method: 'DELETE' }) })
                    .then(r => r.json()).then(res => { toastr.success(res.message || 'Deleted'); table.ajax.reload(null,false); });
            });
        });
    </script>
    @endpush
</x-app-layout>


