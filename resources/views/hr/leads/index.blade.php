@php
    $pageTitle = 'Hiring Lead Master';
@endphp

<x-app-layout pageTitle="Hiring Lead Master">
    <div class="max-w-7xl mx-auto">
        {{-- Main Card --}}
        <div class="bg-white rounded-[30px] p-6 md:p-8" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08), 0 0 0 1px rgba(0,0,0,0.04);">
            {{-- Header with Add Button --}}
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-slate-900">Hiring Lead Master</h2>
                <button id="add-lead" class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-xl text-sm font-medium transition-all shadow-sm">
                    <x-heroicon-o-plus class="w-4 h-4 inline mr-1" />
                    Add New Hiring Lead
                </button>
            </div>

            {{-- Filters Section --}}
            <div class="mb-6 grid grid-cols-1 md:grid-cols-5 gap-3 p-4 bg-slate-50 rounded-xl border border-slate-200">
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1.5">From: dd/mm/yyyy</label>
                    <input type="date" id="filter-from" class="w-full rounded-lg border-slate-200 bg-white px-3 py-2 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500" />
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1.5">To: dd/mm/yyyy</label>
                    <input type="date" id="filter-to" class="w-full rounded-lg border-slate-200 bg-white px-3 py-2 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500" />
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Select Gender</label>
                    <select id="filter-gender" class="w-full rounded-lg border-slate-200 bg-white px-3 py-2 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                        <option value="">All</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-medium text-slate-600 mb-1.5">Select Experience</label>
                    <select id="filter-experience" class="w-full rounded-lg border-slate-200 bg-white px-3 py-2 text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                        <option value="">All</option>
                        <option value="0-2">0-2 Years</option>
                        <option value="2-5">2-5 Years</option>
                        <option value="5+">5+ Years</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button id="filter-search" class="w-full px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-all shadow-sm">
                        <x-heroicon-o-magnifying-glass class="w-4 h-4 inline mr-1" />
                        Search
                    </button>
                </div>
            </div>

            {{-- DataTable --}}
            <div class="overflow-x-auto">
                <table id="leads-table" class="display w-full" style="width:100%"></table>
            </div>

            {{-- Breadcrumbs and Pagination --}}
            <div class="mt-6 pt-4 border-t border-slate-200">
                <x-breadcrumbs :items="[
                    ['label' => 'Dashboard', 'route' => 'dashboard'],
                    ['label' => 'Hiring Lead Master']
                ]" />
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <x-modal name="lead-modal" title="Add New Hiring Lead">
        <form id="lead-form" enctype="multipart/form-data">
            <input type="hidden" name="_method" id="lead-method" value="POST" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Left Column --}}
                <div class="space-y-5">
                    <div>
                        <label for="code" class="block text-sm font-medium text-slate-700 mb-2">Unique Code</label>
                        <input type="text" id="code" name="code" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all" placeholder="CMS/LEAD/0022" />
                    </div>
                    <div>
                        <label for="mobile" class="block text-sm font-medium text-slate-700 mb-2">Mobile No</label>
                        <input type="text" id="mobile" name="mobile" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all" placeholder="XXXXX XXXXX" />
                    </div>
                    <div>
                        <label for="position" class="block text-sm font-medium text-slate-700 mb-2">Position</label>
                        <input type="text" id="position" name="position" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all" placeholder="Enter Position" />
                    </div>
                    <div>
                        <label for="experience_years" class="block text-sm font-medium text-slate-700 mb-2">Experience Count</label>
                        <input type="number" id="experience_years" name="experience_years" step="0.1" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all" placeholder="Enter No of Exp. Like: 2.5" />
                    </div>
                    <div>
                        <label for="expected_salary" class="block text-sm font-medium text-slate-700 mb-2">Previous Salary</label>
                        <input type="number" id="expected_salary" name="expected_salary" step="0.01" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all" placeholder="Enter Salary" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">Gender</label>
                        <div class="flex gap-4">
                            <label class="radio-sky flex items-center gap-2 cursor-pointer px-5 py-2.5 rounded-xl bg-white transition-all">
                                <input type="radio" name="gender" value="male" id="gender-male" class="w-4 h-4 text-sky-500 focus:ring-sky-500" checked />
                                <span class="text-sm font-medium text-slate-700">Male</span>
                            </label>
                            <label class="radio-sky flex items-center gap-2 cursor-pointer px-5 py-2.5 rounded-xl bg-white transition-all">
                                <input type="radio" name="gender" value="female" id="gender-female" class="w-4 h-4 text-sky-500 focus:ring-sky-500" />
                                <span class="text-sm font-medium text-slate-700">Female</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Right Column --}}
                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-2">Person Name</label>
                        <input type="text" id="name" name="name" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all" placeholder="Please Enter Calendar Year Name" />
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-medium text-slate-700 mb-2">Address</label>
                        <textarea id="address" name="address" rows="3" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all resize-none" placeholder="Enter Your Address"></textarea>
                    </div>
                    <div>
                        <label for="has_experience" class="block text-sm font-medium text-slate-700 mb-2">Is experience?</label>
                        <select id="has_experience" name="has_experience" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all">
                            <option value="">Select your Option</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div>
                        <label for="previous_company" class="block text-sm font-medium text-slate-700 mb-2">Experience previous Company</label>
                        <input type="text" id="previous_company" name="previous_company" class="form-input-sky w-full rounded-xl bg-white px-4 py-3 text-sm transition-all" placeholder="Enter Experience Previous Company Name" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Resume Upload</label>
                        <div class="flex items-center gap-3">
                            <label for="resume" class="btn-file-sky px-5 py-2.5 rounded-xl bg-white text-sm font-medium text-slate-700 cursor-pointer transition-all">
                                Choose File
                            </label>
                            <input type="file" id="resume" name="resume" class="hidden" accept=".pdf,.doc,.docx" />
                            <span id="resume-name" class="text-sm text-slate-500">No File Chosen</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 flex items-center justify-end">
                <button type="button" id="lead-submit" class="btn-green-sky px-8 py-3 rounded-xl font-medium text-sm text-white transition-all">
                    Add Hiring Lead Master
                </button>
            </div>
        </form>
    </x-modal>

    @push('scripts')
    <style>
        /* Sky Blue Form Inputs */
        .form-input-sky {
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            outline: none;
        }
        .form-input-sky:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1), 0 1px 3px rgba(0,0,0,0.05);
            background-color: #ffffff;
        }

        /* Sky Blue Radio Buttons */
        .radio-sky {
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .radio-sky:hover {
            border-color: #0ea5e9;
            box-shadow: 0 2px 4px rgba(14, 165, 233, 0.15);
        }
        .radio-sky input:checked ~ span,
        .radio-sky:has(input:checked) {
            border-color: #0ea5e9;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            box-shadow: 0 2px 4px rgba(14, 165, 233, 0.2);
        }

        /* Sky Blue File Button */
        .btn-file-sky {
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .btn-file-sky:hover {
            border-color: #0ea5e9;
            background: #f0f9ff;
            box-shadow: 0 2px 4px rgba(14, 165, 233, 0.15);
        }

        /* Green Button */
        .btn-green-sky {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25), 0 2px 4px rgba(0,0,0,0.1);
            border: none;
        }
        .btn-green-sky:hover {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35), 0 2px 4px rgba(0,0,0,0.1);
            transform: translateY(-1px);
        }

        /* DataTable Custom Styling */
        #leads-table_wrapper {
            font-family: 'Poppins', sans-serif;
        }
        #leads-table thead th {
            background-color: #f8fafc !important;
            color: #334155 !important;
            font-weight: 600 !important;
            font-size: 0.875rem;
            padding: 12px 16px;
            border-bottom: 2px solid #e2e8f0;
            text-align: left;
        }
        #leads-table tbody td {
            background-color: #ffffff !important;
            color: #475569;
            font-size: 0.875rem;
            padding: 12px 16px;
            border-bottom: 1px solid #f1f5f9;
        }
        #leads-table tbody tr:hover {
            background-color: #f8fafc !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 0.75rem;
            margin: 0 0.125rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: white;
            color: #475569 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #ef4444 !important;
            color: white !important;
            border-color: #ef4444;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #f1f5f9 !important;
            border-color: #cbd5e1;
        }
    </style>
    <script>
        const modalOpen = () => {
            window.dispatchEvent(new CustomEvent('open-modal', { detail: 'lead-modal' }));
            window.dispatchEvent(new CustomEvent('open-lead-modal'));
        };
        const modalClose = () => {
            window.dispatchEvent(new CustomEvent('close-modal', { detail: 'lead-modal' }));
            window.dispatchEvent(new CustomEvent('close-lead-modal'));
        };

        // File upload click handler
        $(document).on('click', 'label[for="resume"]', function(e) {
            e.preventDefault();
            $('#resume').click();
        });

        // File name display
        $('#resume').on('change', function(){
            const fileName = $(this)[0].files[0]?.name || 'No File Chosen';
            $('#resume-name').text(fileName);
        });

        // DataTable initialization
        let table = $('#leads-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('leads.index') }}',
                data: function(d) {
                    d.filter_from = $('#filter-from').val();
                    d.filter_to = $('#filter-to').val();
                    d.filter_gender = $('#filter-gender').val();
                    d.filter_experience = $('#filter-experience').val();
                }
            },
            order: [[2, 'desc']],
            pageLength: 25,
            lengthMenu: [[25, 50, 100], [25, 50, 100]],
            columns: [
                { title: 'Action', data: 'action', orderable: false, searchable: false, width: 120 },
                { title: 'Serial No.', data: 'DT_RowIndex', orderable: false, searchable: false, width: 80 },
                { title: 'Hiring Lead Code', data: 'code', name: 'code' },
                { title: 'Person Name', data: 'name', name: 'name' },
                { title: 'Mo. No.', data: 'mobile', name: 'mobile' },
                { title: 'Address', data: 'address', name: 'address' },
                { title: 'Position', data: 'position', name: 'position' },
                { title: 'Is Exp.?', data: 'is_experience', orderable: false, searchable: false },
                { title: 'Exp.', data: 'experience_years', name: 'experience_years' },
                { title: 'Pre. Company', data: 'previous_company', orderable: false, searchable: false },
                { title: 'Pre. Salary', data: 'expected_salary', name: 'expected_salary' },
                { title: 'Gender', data: 'gender', name: 'gender' },
            ],
            language: {
                processing: '<div class="flex items-center justify-center p-4"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-sky-500"></div></div>',
                emptyTable: 'No data available in table',
            },
            drawCallback: function(settings) {
                // Custom styling already applied via CSS
            }
        });

        // Filter search
        $('#filter-search').on('click', function(){
            table.ajax.reload();
        });

        // Add Lead Button
        $(document).on('click', '#add-lead', function(){
            $('#lead-form')[0].reset();
            $('#lead-method').val('POST');
            $('#lead-submit').data('id', '').text('Add Hiring Lead Master');
            $('#gender-male').prop('checked', true);
            $('#resume-name').text('No File Chosen');
            modalOpen();
        });

        // Edit Lead Button
        $(document).on('click', '.btn-edit', function(){
            const row = $(this).data('row');
            $('#lead-method').val('POST');
            $('#code').val(row.code);
            $('#name').val(row.name);
            $('#mobile').val(row.mobile);
            $('#position').val(row.position);
            $('#experience_years').val(row.experience_years);
            $('#expected_salary').val(row.expected_salary);
            $('input[name="gender"][value="' + (row.gender || 'male') + '"]').prop('checked', true);
            $('#address').val(row.address);
            $('#has_experience').val(row.has_experience || '');
            $('#previous_company').val(row.previous_company || '');
            $('#resume-name').text('No File Chosen');
            $('#lead-submit').data('id', row.id).text('Update Hiring Lead Master');
            modalOpen();
        });

        // Form Submit
        $('#lead-submit').on('click', function(e){
            e.preventDefault();
            const id = $(this).data('id');
            const form = document.getElementById('lead-form');
            const formData = new FormData(form);
            const url = id ? ('{{ url('leads') }}/' + id) : '{{ route('leads.store') }}';
            if (id) formData.append('_method','PUT');
            
            fetch(url, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
            .then(async r => {
                const res = await r.json();
                if (r.ok) {
                    window.toastr.success(res.message || 'Saved successfully');
                    modalClose();
                    table.ajax.reload(null, false);
                } else {
                    if (res.errors) {
                        Object.keys(res.errors).forEach(key => {
                            window.toastr.error(res.errors[key][0]);
                        });
                    } else {
                        window.toastr.error(res.message || 'Validation error');
                    }
                }
            })
            .catch(err => {
                console.error(err);
                window.toastr.error('An error occurred. Please try again.');
            });
        });

        // Delete Lead
        $(document).on('click', '.btn-delete', function(){
            const id = $(this).data('id');
            window.Swal.fire({ 
                title: 'Are you sure?', 
                text: 'This action cannot be undone!',
                icon: 'warning', 
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!'
            }).then(res => {
                if (!res.isConfirmed) return;
                fetch('{{ url('leads') }}/' + id, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                    body: new URLSearchParams({ _method: 'DELETE' })
                })
                .then(async r => {
                    const res = await r.json();
                    if (r.ok) {
                        window.toastr.success(res.message || 'Deleted successfully');
                        table.ajax.reload(null, false);
                    } else {
                        window.toastr.error(res.message || 'Delete failed');
                    }
                })
                .catch(err => {
                    window.toastr.error('An error occurred');
                });
            });
        });

        // Print Lead
        $(document).on('click', '.btn-print', function(){
            const id = $(this).data('id');
            window.open('{{ url('leads') }}/' + id + '/print', '_blank');
        });
    </script>
    @endpush
</x-app-layout>
