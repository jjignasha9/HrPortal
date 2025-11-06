@props(['pageTitle' => null])

@php
    $title = $pageTitle ?? ucfirst(str_replace('.', ' ', request()->route()->getName() ?? ''));
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>

    {{-- Tailwind CSS --}}
    @vite(['resources/css/app.css'])
    
    {{-- New Theme CSS Files --}}
    @if (file_exists(public_path('new_theme/css/visby-fonts.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/css/visby-fonts.css') }}">
    @endif
    @if (file_exists(public_path('new_theme/css/macos.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/css/macos.css') }}">
    @endif
    @if (file_exists(public_path('new_theme/css/style.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/css/style.css') }}">
    @endif
    
    {{-- Bootstrap from bower_components --}}
    @if (file_exists(public_path('new_theme/bower_components/bootstrap/dist/css/bootstrap.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    @endif
    
    {{-- Font Awesome --}}
    @if (file_exists(public_path('new_theme/bower_components/font-awesome/css/font-awesome.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/bower_components/font-awesome/css/font-awesome.min.css') }}">
    @endif
    
    {{-- Ionicons --}}
    @if (file_exists(public_path('new_theme/bower_components/Ionicons/css/ionicons.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/bower_components/Ionicons/css/ionicons.min.css') }}">
    @endif
    
    {{-- AdminLTE Theme --}}
    @if (file_exists(public_path('new_theme/dist/css/AdminLTE.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/dist/css/AdminLTE.min.css') }}">
    @endif
    @if (file_exists(public_path('new_theme/dist/css/skins/_all-skins.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/dist/css/skins/_all-skins.min.css') }}">
    @endif
    
    {{-- Datepicker --}}
    @if (file_exists(public_path('new_theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    @endif
    
    {{-- Daterange Picker --}}
    @if (file_exists(public_path('new_theme/bower_components/bootstrap-daterangepicker/daterangepicker.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    @endif
    
    {{-- Select2 --}}
    @if (file_exists(public_path('new_theme/dist/css/select2.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/dist/css/select2.min.css') }}">
    @endif
    
    {{-- DataTables CSS --}}
    @if (file_exists(public_path('new_theme/css/jquery.dataTables.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/css/jquery.dataTables.min.css') }}">
    @endif
    @if (file_exists(public_path('new_theme/css/buttons.dataTables.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/css/buttons.dataTables.min.css') }}">
    @endif
    @if (file_exists(public_path('new_theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    @endif
    
    {{-- Toastr CSS --}}
    @if (file_exists(public_path('new_theme/include/ext_resource/toastr.min.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/include/ext_resource/toastr.min.css') }}">
    @endif
    
    {{-- External CDN fallbacks (CSS in head) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-dt@2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
</head>
<body class="font-sans antialiased" style="font-family: 'Poppins', 'Visby', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">

<div x-data="{ sidebarOpen: false }" x-on:toggle-sidebar.window="sidebarOpen = !sidebarOpen" class="min-h-screen {{ request()->routeIs('leads.create') ? 'bg-gradient-to-br from-[#e6f5fb] to-[#f6fbff]' : 'bg-slate-50' }} text-slate-900">
    <div class="flex">
        {{-- Mobile overlay --}}
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black/40 z-40 md:hidden" x-on:click="sidebarOpen = false"></div>

        {{-- Mobile Sidebar --}}
        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="-translate-x-full opacity-0" class="transform md:hidden z-50">
            <x-sidebar mobile="true" />
        </div>

        {{-- Desktop Sidebar --}}
        <x-sidebar />

        <main class="flex-1 min-w-0">
            <x-header>
                {{ $title }}
            </x-header>

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 pb-28">
                {{ $slot }}
            </div>
        </main>
    </div>

    <x-footer-dock />
    @stack('modals')
    
    {{-- jQuery from bower_components (load first) --}}
    @if (file_exists(public_path('new_theme/bower_components/jquery/dist/jquery.min.js')))
        <script src="{{ asset('new_theme/bower_components/jquery/dist/jquery.min.js') }}"></script>
    @endif
    
    {{-- jQuery UI --}}
    @if (file_exists(public_path('new_theme/bower_components/jquery-ui/jquery-ui.min.js')))
        <script src="{{ asset('new_theme/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    @endif
    
    {{-- Bootstrap JS --}}
    @if (file_exists(public_path('new_theme/bower_components/bootstrap/dist/js/bootstrap.min.js')))
        <script src="{{ asset('new_theme/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    @endif
    
    {{-- FastClick --}}
    @if (file_exists(public_path('new_theme/bower_components/fastclick/lib/fastclick.js')))
        <script src="{{ asset('new_theme/bower_components/fastclick/lib/fastclick.js') }}"></script>
    @endif
    
    {{-- DataTables Core --}}
    @if (file_exists(public_path('new_theme/bower_components/datatables.net/js/jquery.dataTables.min.js')))
        <script src="{{ asset('new_theme/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    @endif
    @if (file_exists(public_path('new_theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')))
        <script src="{{ asset('new_theme/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    @endif
    
    {{-- DataTables Buttons and Extensions --}}
    @if (file_exists(public_path('new_theme/include/ext_resource/dataTables.buttons.min.js')))
        <script src="{{ asset('new_theme/include/ext_resource/dataTables.buttons.min.js') }}"></script>
    @endif
    @if (file_exists(public_path('new_theme/include/ext_resource/buttons.flash.min.js')))
        <script src="{{ asset('new_theme/include/ext_resource/buttons.flash.min.js') }}"></script>
    @endif
    @if (file_exists(public_path('new_theme/include/ext_resource/jszip.min.js')))
        <script src="{{ asset('new_theme/include/ext_resource/jszip.min.js') }}"></script>
    @endif
    @if (file_exists(public_path('new_theme/include/ext_resource/pdfmake.min.js')))
        <script src="{{ asset('new_theme/include/ext_resource/pdfmake.min.js') }}"></script>
    @endif
    @if (file_exists(public_path('new_theme/include/ext_resource/vfs_fonts.js')))
        <script src="{{ asset('new_theme/include/ext_resource/vfs_fonts.js') }}"></script>
    @endif
    @if (file_exists(public_path('new_theme/include/ext_resource/buttons.html5.min.js')))
        <script src="{{ asset('new_theme/include/ext_resource/buttons.html5.min.js') }}"></script>
    @endif
    @if (file_exists(public_path('new_theme/include/ext_resource/buttons.print.min.js')))
        <script src="{{ asset('new_theme/include/ext_resource/buttons.print.min.js') }}"></script>
    @endif
    
    {{-- Select2 --}}
    @if (file_exists(public_path('new_theme/bower_components/select2/dist/js/select2.full.min.js')))
        <script src="{{ asset('new_theme/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    @elseif (file_exists(public_path('new_theme/dist/js/select2.min.js')))
        <script src="{{ asset('new_theme/dist/js/select2.min.js') }}"></script>
    @endif
    
    {{-- Moment.js (required for daterangepicker) --}}
    @if (file_exists(public_path('new_theme/bower_components/moment/min/moment.min.js')))
        <script src="{{ asset('new_theme/bower_components/moment/min/moment.min.js') }}"></script>
    @elseif (file_exists(public_path('new_theme/bower_components/moment/moment.js')))
        <script src="{{ asset('new_theme/bower_components/moment/moment.js') }}"></script>
    @endif
    
    {{-- Datepicker --}}
    @if (file_exists(public_path('new_theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')))
        <script src="{{ asset('new_theme/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    @endif
    
    {{-- Daterange Picker --}}
    @if (file_exists(public_path('new_theme/bower_components/bootstrap-daterangepicker/daterangepicker.js')))
        <script src="{{ asset('new_theme/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    @endif
    
    {{-- jQuery Slimscroll --}}
    @if (file_exists(public_path('new_theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')))
        <script src="{{ asset('new_theme/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    @endif
    
    {{-- CKEditor --}}
    @if (file_exists(public_path('new_theme/bower_components/ckeditor/ckeditor.js')))
        <script src="{{ asset('new_theme/bower_components/ckeditor/ckeditor.js') }}"></script>
    @endif
    
    {{-- Chart.js / Flot Charts --}}
    @if (file_exists(public_path('new_theme/bower_components/Flot/jquery.flot.js')))
        <script src="{{ asset('new_theme/bower_components/Flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('new_theme/bower_components/Flot/jquery.flot.resize.js') }}"></script>
        <script src="{{ asset('new_theme/bower_components/Flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('new_theme/bower_components/Flot/jquery.flot.categories.js') }}"></script>
    @endif
    @if (file_exists(public_path('new_theme/bower_components/morris.js/morris.min.js')))
        <script src="{{ asset('new_theme/bower_components/morris.js/morris.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('new_theme/bower_components/morris.js/morris.css') }}">
    @endif
    
    {{-- FullCalendar --}}
    @if (file_exists(public_path('new_theme/bower_components/fullcalendar/dist/fullcalendar.min.js')))
        <script src="{{ asset('new_theme/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('new_theme/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
    @endif
    
    {{-- Toastr --}}
    @if (file_exists(public_path('new_theme/include/ext_resource/toastr.min.js')))
        <script src="{{ asset('new_theme/include/ext_resource/toastr.min.js') }}"></script>
    @endif
    
    {{-- AdminLTE App --}}
    @if (file_exists(public_path('new_theme/dist/js/adminlte.min.js')))
        <script src="{{ asset('new_theme/dist/js/adminlte.min.js') }}"></script>
    @endif
    
    {{-- AdminLTE Dashboard Demo (optional) --}}
    @if (file_exists(public_path('new_theme/dist/js/pages/dashboard.js')))
        <script src="{{ asset('new_theme/dist/js/pages/dashboard.js') }}"></script>
    @endif
    
    {{-- jQuery UI bridge for Bootstrap compatibility --}}
    <script>
        if (typeof $.widget !== 'undefined' && typeof $.ui !== 'undefined' && typeof $.ui.button !== 'undefined') {
            $.widget.bridge('uibutton', $.ui.button);
        }
    </script>
    
    {{-- External CDN fallbacks (only if local files not found) --}}
    @if (!file_exists(public_path('new_theme/bower_components/jquery/dist/jquery.min.js')))
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    @endif
    @if (!file_exists(public_path('new_theme/bower_components/datatables.net/js/jquery.dataTables.min.js')))
        <script src="https://cdn.jsdelivr.net/npm/datatables.net@2.1.8/js/dataTables.min.js"></script>
    @endif
    @if (!file_exists(public_path('new_theme/include/ext_resource/toastr.min.js')))
        <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js" defer></script>
    
    {{-- Optional theme JS from new_theme --}}
    @if (file_exists(public_path('new_theme/build/app.js')))
        <script src="{{ asset('new_theme/build/app.js') }}" defer></script>
    @endif
    
    <script>
        // Ensure global variables are available
        window.$ = window.jQuery = $;
        window.Swal = Swal;
        window.toastr = toastr;
        window.Chart = Chart;
    </script>
    @stack('scripts')
    <script>
        window.toastr && (toastr.options = {
            positionClass: 'toast-bottom-right',
            timeOut: 3000,
            progressBar: true,
        });
        window.toast = (type, msg) => { try { window.toastr && toastr[type || 'info'](msg); } catch(e) { console && console.log(msg); } };
        window.addEventListener('unhandledrejection', function (e) {
            e.preventDefault();
            const reason = (e.reason && (e.reason.message || e.reason)) || 'Something went wrong';
            window.toast('error', reason);
        });
        window.handleFetch = async function(promise){
            const res = await promise;
            if (!res.ok) {
                let message = 'Request failed';
                try {
                    const j = await res.clone().json();
                    if (j && j.errors) message = Object.values(j.errors).flat().join('\n');
                    else if (j && j.message) message = j.message;
                } catch (_) { /* ignore */ }
                window.toast('error', message);
                throw new Error(message);
            }
            return res;
        }
    </script>
</div>

</body>
</html>
