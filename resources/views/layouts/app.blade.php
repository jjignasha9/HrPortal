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
    @vite(['resources/css/app.css'])
    {{-- Optional theme CSS from new_theme (auto-copied to public/new_theme) --}}
    @if (file_exists(public_path('new_theme/css/visby-fonts.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/css/visby-fonts.css') }}">
    @endif
    @if (file_exists(public_path('new_theme/css/style.css')))
        <link rel="stylesheet" href="{{ asset('new_theme/css/style.css') }}">
    @endif
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/datatables.net@2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/datatables.net-dt@2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
</head>
<body class="font-sans antialiased" style="font-family: 'Poppins', 'Visby', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">

{{-- Main Layout Structure --}}
<div class="min-h-screen {{ request()->routeIs('leads.create') ? 'bg-gradient-to-br from-[#e6f5fb] to-[#f6fbff]' : 'bg-slate-50' }} text-slate-900">
    <div class="flex">
        {{-- Sidebar Component - Defined in resources/views/components/sidebar.blade.php --}}
        <x-sidebar />

        {{-- Main Content Area --}}
        <main class="flex-1 min-w-0">
            {{-- Header Component - Defined in resources/views/components/header.blade.php --}}
            <x-header>
                {{ $pageTitle ?? ucfirst(str_replace('.', ' ', request()->route()->getName() ?? '')) }}
            </x-header>

            {{-- Page Content Slot --}}
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 pb-28">
                {{ $slot }}
            </div>
        </main>
    </div>

    {{-- Footer Dock Component - Defined in resources/views/components/footer-dock.blade.php --}}
    <x-footer-dock />
    @stack('modals')
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


