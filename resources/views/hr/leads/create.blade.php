<x-app-layout pageTitle="Add New Hiring Lead">
    <div class="max-w-6xl mx-auto mt-4">
        {{-- Main Form Card - Exact Match to Image --}}
        <div class="bg-white rounded-[30px] p-8" style="box-shadow: 0 4px 20px rgba(0,0,0,0.08), 0 0 0 1px rgba(0,0,0,0.04);">
            <form id="lead-form" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="_method" value="POST" />
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                {{-- Two Column Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
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

                {{-- Action Button --}}
                <div class="flex justify-end pt-6">
                    <button type="submit" id="lead-submit" class="btn-green-sky px-8 py-3 rounded-xl font-medium text-sm text-white transition-all">
                        Add Hiring Lead Master
                    </button>
                </div>
            </form>

            {{-- Breadcrumbs --}}
            <div class="mt-8 pt-6 border-t border-slate-200">
                <x-breadcrumbs :items="[
                    ['label' => 'Dashboard', 'route' => 'dashboard'],
                    ['label' => 'Add New Hiring Lead']
                ]" />
            </div>
        </div>
    </div>

    @push('scripts')
    <style>
        /* Sky Blue Form Inputs - Exact Match */
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

        /* Green Button with Sky Blue Accent */
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
        .btn-green-sky:active {
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
            transform: translateY(0);
        }
    </style>
    <script>
        // File upload click handler
        document.querySelector('label[for="resume"]').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('resume').click();
        });

        // File name display
        $('#resume').on('change', function(){
            const fileName = $(this)[0].files[0]?.name || 'No File Chosen';
            $('#resume-name').text(fileName);
        });

        // Form submission
        $('#lead-form').on('submit', function(e){
            e.preventDefault();
            const form = document.getElementById('lead-form');
            const formData = new FormData(form);
            
            fetch('{{ route('leads.store') }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            })
            .then(async r => {
                const res = await r.json();
                if (r.ok) {
                    window.toastr.success(res.message || 'Lead created successfully');
                    window.location.href = '{{ route('leads.index') }}';
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
    </script>
    @endpush
</x-app-layout>
