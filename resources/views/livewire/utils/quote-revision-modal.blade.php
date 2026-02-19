<div>
    @if($showRevisionModal)
<div class="fixed inset-0 z-[999] flex items-center justify-center">
    <div class="absolute inset-0 bg-black/70" wire:click="$set('showRevisionModal', false)"></div>

    <div class="relative w-[92%] max-w-md glass rounded-3xl p-6 space-y-4">
        <h2 class="text-xl font-extrabold text-white">
            Request Revision
        </h2>

        <div>
            <label class="text-xs text-gray-400">Reason</label>
            <textarea wire:model="revision_reason"
                class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white"></textarea>
            @error('revision_reason') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
        </div>

        @guest
        <div>
            <label class="text-xs text-gray-400">Your Name</label>
            <input wire:model="revision_name"
                class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white">
            @error('revision_name') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="text-xs text-gray-400">Email</label>
            <input wire:model="revision_email"
                class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white">
            @error('revision_email') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror
        </div>
        @endguest

        <div>
            <label class="text-xs text-gray-400">Phone (optional)</label>
            <input wire:model="revision_phone"
                class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white">
        </div>

        <button wire:click="submitRevision"
            class="btn-gold w-full py-3 rounded-2xl">
            Submit Revision
        </button>
    </div>
</div>
@endif

</div>
