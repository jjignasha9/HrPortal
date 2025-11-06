<header class="sticky top-0 z-40" style="background: linear-gradient(180deg, #fff5f5 0%, #ffffff 60%); box-shadow: 0 6px 16px rgba(0,0,0,0.06); border-bottom: 1px solid #e2e8f0;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4 flex items-center gap-4">
        <button class="md:hidden inline-flex items-center justify-center w-9 h-9 rounded-lg bg-white shadow-sm border border-slate-200" x-data="{}" aria-label="Open menu" onclick="window.dispatchEvent(new CustomEvent('toggle-sidebar'))">
            <x-heroicon-o-bars-3 class="w-5 h-5" />
        </button>
        <div class="flex-1 min-w-0">
            <h1 class="text-2xl font-semibold text-slate-900" style="font-weight: 600; font-family: 'Poppins', sans-serif;">{{ $title ?? (isset($slot) ? trim($slot) : 'Profile') }}</h1>
        </div>
        <div class="relative hidden sm:block flex-1 max-w-md">
            <input type="text" placeholder="Search here." class="w-full rounded-xl bg-white border border-slate-200 px-4 py-2.5 text-sm transition-all" style="box-shadow: 0 1px 3px rgba(0,0,0,0.05);" onfocus="this.style.borderColor='#0ea5e9'; this.style.boxShadow='0 0 0 3px rgba(14, 165, 233, 0.1), 0 1px 3px rgba(0,0,0,0.05)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.05)'" />
            <x-heroicon-o-magnifying-glass class="w-5 h-5 absolute right-3 top-3 text-slate-400 pointer-events-none" />
        </div>
        <button class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white shadow-sm hover:bg-slate-50 transition">
            <x-heroicon-o-bell class="w-5 h-5 text-slate-600" />
            <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-white"></span>
        </button>
        <div class="flex items-center gap-3">
            <button class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-sky-500 hover:bg-sky-600 text-white text-xs font-medium transition-all" style="box-shadow: 0 2px 4px rgba(14, 165, 233, 0.3);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"/></svg>
                IN/OUT
            </button>
            <div x-data="{ open: false }" class="relative flex items-center gap-2">
                <button @click="open = !open" class="flex items-center gap-2 hover:opacity-80 transition">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'User') }}&background=0ea5e9&color=fff" alt="avatar" class="w-9 h-9 rounded-xl shadow-sm border-2 border-white" />
                    <div class="hidden sm:block text-left">
                        <div class="text-sm font-semibold text-slate-900">{{ auth()->user()->name ?? 'Guest' }}</div>
                        <div class="text-xs text-slate-500">{{ auth()->user()->getRoleNames()->first() ?? 'User' }}</div>
                    </div>
                    <span class="hidden sm:block transition-transform" x-bind:class="open ? 'rotate-180' : ''">
                        <x-heroicon-o-chevron-down class="w-4 h-4 text-slate-400" />
                    </span>
                </button>
                <div x-show="open" @click.away="open = false" x-cloak class="absolute right-0 top-full mt-2 w-48 rounded-xl bg-white shadow-xl border border-slate-200 py-2 z-50">
                    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>


