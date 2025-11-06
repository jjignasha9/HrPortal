<x-app-layout>
    @if(session('status'))
        <div class="mb-4 px-4 py-2 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800">{{ session('status') }}</div>
    @endif

    <x-card title="General Settings">
        <form action="{{ route('settings.update', 1) }}" method="post" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="site_title" value="Site Title" />
                    <x-text-input id="site_title" name="site_title" value="{{ $data['site_title'] }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="theme_color" value="Theme Color" />
                    <x-text-input id="theme_color" name="theme_color" value="{{ $data['theme_color'] }}" class="mt-1 block w-full" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="logo" value="Logo" />
                    @if($data['logo_path'])
                        <img src="{{ asset('storage/'.$data['logo_path']) }}" class="h-10 mb-2" />
                    @endif
                    <input id="logo" name="logo" type="file" class="mt-1 block w-full text-sm" />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <x-input-label for="mail_host" value="Mail Host" />
                    <x-text-input id="mail_host" name="mail_host" value="{{ $data['mail_host'] }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="mail_port" value="Mail Port" />
                    <x-text-input id="mail_port" name="mail_port" value="{{ $data['mail_port'] }}" class="mt-1 block w-full" />
                </div>
                <div>
                    <x-input-label for="mail_username" value="Mail Username" />
                    <x-text-input id="mail_username" name="mail_username" value="{{ $data['mail_username'] }}" class="mt-1 block w-full" />
                </div>
            </div>

            <div class="pt-2">
                <x-button>Save Settings</x-button>
            </div>
        </form>
    </x-card>
</x-app-layout>


