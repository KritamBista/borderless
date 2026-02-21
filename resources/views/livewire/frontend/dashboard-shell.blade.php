<div class="min-h-screen bg-app">
    {{-- Topbar (mobile) --}}
    <div class="lg:hidden border-b border-white/10 backdrop-blur-md"
         style="background: rgba(11,15,20,.65);">
        <div class="px-4 py-3 flex items-center justify-between">
            <button wire:click="toggleSidebar"
                    class="border border-white/15 rounded-xl px-3 py-2 text-white">
                ☰
            </button>

            <div class="font-extrabold text-white">Dashboard</div>

            <a href="" class="text-gold font-bold">Home</a>
        </div>
    </div>

    <div class="max-w-7xl mx-auto flex">
        {{-- Sidebar (desktop) --}}
        <aside class="hidden lg:flex w-72 min-h-screen p-5">
            <div class="w-full glass rounded-3xl p-5">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-2xl flex items-center justify-center"
                         style="background: rgba(214,177,94,.12); border: 1px solid rgba(214,177,94,.25);">
                        <span class="font-black text-gold">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                    </div>
                    <div class="leading-tight">
                        <div class="font-extrabold text-white">{{ auth()->user()->name }}</div>
                        <div class="text-xs text-gray-400">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <div class="mt-6 space-y-2">
                    @foreach($nav as $item)
                        <a href="{{ route($item['route']) }}"
                           class="flex items-center gap-3 px-4 py-3 rounded-2xl border border-white/0 hover:border-white/10 hover:bg-white/5 transition
                           {{ request()->routeIs($item['route']) ? 'bg-white/5 border-white/10' : '' }}">
                            <span class="text-lg">{{ $item['icon'] }}</span>
                            <span class="font-semibold text-white">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>

                <div class="mt-6 border-t border-white/10 pt-4">
                    <form method="POST" action="">
                        @csrf
                        <button class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/5 transition text-gray-200">
                            <span class="text-lg">🚪</span>
                            <span class="font-semibold">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Mobile Sidebar Drawer --}}
        @if($sidebarOpen)
            <div class="lg:hidden fixed inset-0 z-[999]">
                <div class="absolute inset-0 bg-black/70" wire:click="closeSidebar"></div>

                <div class="absolute left-0 top-0 h-full w-[85%] max-w-sm p-4">
                    <div class="glass rounded-3xl p-5 h-full">
                        <div class="flex items-center justify-between">
                            <div class="font-extrabold text-white">Menu</div>
                            <button wire:click="closeSidebar" class="text-gray-400 hover:text-white">✕</button>
                        </div>

                        <div class="mt-4 flex items-center gap-3">
                            <div class="h-10 w-10 rounded-2xl flex items-center justify-center"
                                 style="background: rgba(214,177,94,.12); border: 1px solid rgba(214,177,94,.25);">
                                <span class="font-black text-gold">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
                            </div>
                            <div class="leading-tight">
                                <div class="font-extrabold text-white">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-400">{{ auth()->user()->email }}</div>
                            </div>
                        </div>

                        <div class="mt-6 space-y-2">
                            @foreach($nav as $item)
                                <a href="{{ route($item['route']) }}"
                                   wire:click="closeSidebar"
                                   class="flex items-center gap-3 px-4 py-3 rounded-2xl border border-white/0 hover:border-white/10 hover:bg-white/5 transition
                                   {{ request()->routeIs($item['route']) ? 'bg-white/5 border-white/10' : '' }}">
                                    <span class="text-lg">{{ $item['icon'] }}</span>
                                    <span class="font-semibold text-white">{{ $item['label'] }}</span>
                                </a>
                            @endforeach
                        </div>

                        <div class="mt-6 border-t border-white/10 pt-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-2xl hover:bg-white/5 transition text-gray-200">
                                    <span class="text-lg">🚪</span>
                                    <span class="font-semibold">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Main Content Area --}}
        <main class="flex-1 p-4 lg:p-8">
            {{ $slot ?? '' }}
        </main>
    </div>
</div>
