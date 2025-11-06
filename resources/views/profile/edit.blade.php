<x-app-layout>
    <div class="space-y-4">
        <div class="bg-white/80 backdrop-blur supports-[backdrop-filter]:bg-white/60 rounded-2xl border border-slate-200 shadow-sm p-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="flex items-center gap-4">
                    <img class="w-14 h-14 rounded-xl shadow-sm" src="{{ $employee?->photo_path ? asset('storage/'.$employee->photo_path) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=0ea5e9&color=fff' }}" alt="avatar">
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="text-lg font-semibold">{{ $employee?->first_name ? ($employee->first_name.' '.($employee->last_name ?? '')) : ($user->name) }}</h1>
                            <span class="inline-flex items-center text-xs px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700">● Active</span>
                        </div>
                        <div class="text-xs text-slate-500 flex flex-wrap gap-3 mt-1">
                            <span class="font-medium">Employee ID:</span> <span>{{ $employee?->code ?? 'N/A' }}</span>
                            <span class="font-medium">Designation:</span> <span>{{ $employee?->designation ?? '—' }}</span>
                            <span class="font-medium">Email:</span> <span>{{ $employee?->email ?? $user->email }}</span>
                            <span class="font-medium">Phone:</span> <span>{{ $employee?->mobile ?? '—' }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('employees.index') }}" class="inline-flex items-center gap-2 px-3 py-2 text-sm rounded-xl border border-slate-200 bg-white hover:bg-slate-50">
                        <x-heroicon-o-user-group class="w-4 h-4" /> Employees
                    </a>
                    <button class="inline-flex items-center gap-2 px-3 py-2 text-sm rounded-xl bg-sky-600 text-white hover:bg-sky-700" onclick="window.dispatchEvent(new CustomEvent('open-edit-profile'))">
                        <x-heroicon-o-pencil-square class="w-4 h-4" /> Edit Profile
                    </button>
                </div>
            </div>
        </div>

        <div x-data="{ tab: 'personal' }" class="bg-white/80 backdrop-blur supports-[backdrop-filter]:bg-white/60 rounded-2xl border border-slate-200 shadow-sm">
            <div class="px-4 pt-4">
                <nav class="flex flex-wrap gap-2">
                    <button @click="tab='personal'" :class="tab==='personal' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600'" class="px-3 py-1.5 rounded-full text-sm border border-slate-200">Personal Information</button>
                    <button @click="tab='payroll'" :class="tab==='payroll' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600'" class="px-3 py-1.5 rounded-full text-sm border border-slate-200">Payroll</button>
                    <button @click="tab='attendance'" :class="tab==='attendance' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600'" class="px-3 py-1.5 rounded-full text-sm border border-slate-200">Attendance Mana.</button>
                    <button @click="tab='documents'" :class="tab==='documents' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600'" class="px-3 py-1.5 rounded-full text-sm border border-slate-200">Document</button>
                    <button @click="tab='bank'" :class="tab==='bank' ? 'bg-slate-900 text-white' : 'bg-white text-slate-600'" class="px-3 py-1.5 rounded-full text-sm border border-slate-200">Bank Details</button>
                </nav>
            </div>
            <div class="p-4">
                <div x-show="tab==='personal'" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="space-y-4">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <div x-show="tab==='payroll'" x-cloak>
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table id="payroll-table" class="display w-full"></table>
                    </div>
                    @push('scripts')
                    <script>
                        $(function(){
                            const table = $('#payroll-table').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: '{{ isset($employee) ? route('employees.payrolls.index', $employee) : '' }}',
                                searching: false,
                                lengthChange: false,
                                order: [[0,'desc']],
                                columns: [
                                    { title: 'Action', data: 'action', orderable:false, searchable:false, width: 60 },
                                    { title: 'Serial No', data: 'serial_no', name:'serial_no', width: 90 },
                                    { title: 'Unique No', data: 'unique_no', name:'unique_no' },
                                    { title: 'Salary Month', data: 'salary_month', name:'salary_month' },
                                    { title: 'Format Type', data: 'format_type', name:'format_type' },
                                    { title: 'Payment Date', data: 'payment_date', name:'payment_date' },
                                    { title: 'Payment Amount', data: 'payment_amount', name:'payment_amount' },
                                ]
                            });
                        });
                    </script>
                    @endpush
                    <x-breadcrumbs :items="[
                        ['label' => 'Dashboard', 'route' => 'dashboard'],
                        ['label' => 'Profile', 'route' => 'profile.edit'],
                        ['label' => 'Payroll']
                    ]" />
                </div>

                <div x-show="tab==='attendance'" x-cloak>
                    <div class="text-sm text-slate-600">Attendance module integration coming from Attendance pages. Use the module to manage detailed reports and exports.</div>
                </div>

                <div x-show="tab==='documents'" x-cloak>
                    <div class="text-sm text-slate-600">Upload and view employee documents here.</div>
                </div>

                <div x-show="tab==='bank'" x-cloak>
                    <div class="text-sm text-slate-600">Bank details will appear here.</div>
                </div>
            </div>
        </div>

        <div class="bg-white/80 backdrop-blur supports-[backdrop-filter]:bg-white/60 rounded-2xl border border-slate-200 shadow-sm p-4">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>
