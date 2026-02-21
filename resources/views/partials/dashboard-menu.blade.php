<div>

    {{-- User Info --}}
    <div class="flex items-center gap-3 mb-6">
        <div class="h-10 w-10 rounded-2xl flex items-center justify-center"
             style="background: rgba(214,177,94,.12); border: 1px solid rgba(214,177,94,.25);">
            <span class="font-black text-gold">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </span>
        </div>
        <div>
            <div class="font-extrabold text-white">
                {{ auth()->user()->name }}
            </div>
            <div class="text-xs text-gray-400">
                {{ auth()->user()->email }}
            </div>
        </div>
    </div>

    {{-- Nav --}}
    <div class="space-y-2">

        <a href="{{ route('user.orders') }}"
           class="block px-4 py-3 rounded-2xl transition
           {{ request()->routeIs('user.orders') ? 'bg-white/5 border border-white/10' : 'hover:bg-white/5' }}">
            📦 <span class="font-semibold text-white">My Orders</span>
        </a>

        <a href="{{ route('user.profile') }}"
           class="block px-4 py-3 rounded-2xl transition
           {{ request()->routeIs('user.profile') ? 'bg-white/5 border border-white/10' : 'hover:bg-white/5' }}">
            👤 <span class="font-semibold text-white">My Profile</span>
        </a>

    </div>

    {{-- Logout --}}
    <div class="mt-6 border-t border-white/10 pt-4">
   <a href="{{ route('logout.confirm') }}"
   class="text-gold font-bold">
    Logout
</a>
    </div>

</div>
