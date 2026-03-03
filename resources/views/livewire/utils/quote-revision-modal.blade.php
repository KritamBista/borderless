<div>
    @if($showRevisionModal)
<div class="fixed inset-0 z-[999] flex items-center justify-center">
    <div class="absolute inset-0 bg-black/70" wire:click="$set('showRevisionModal', false)"></div>

    <div class="relative w-[92%] max-w-md glass rounded-3xl p-6 space-y-4">
        <h2 class="text-xl font-extrabold text-white">
            Request Revision
        </h2>
        <p class="text-xs text-gray-500 mt-4 text-start">
    Tap outside the modal to close.
</p>


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
            <label class="text-xs text-gray-400">Phone</label>
            <input wire:model="revision_phone"
                class="w-full mt-1 bg-transparent border border-white/10 rounded-xl px-4 py-3 text-white">
            @error('revision_phone') <div class="text-red-400 text-xs mt-1">{{ $message }}</div> @enderror

        </div>

        {{-- <button wire:click="submitRevision"
            class="btn-gold w-full py-3 rounded-2xl">
            Submit Revision
        </button> --}}
        <button
    wire:click="submitRevision"
    wire:loading.attr="disabled"
    wire:target="submitRevision"
    class="btn-gold w-full py-3 rounded-2xl flex items-center justify-center gap-2 disabled:opacity-60 disabled:cursor-not-allowed"
>
    <span wire:loading.remove wire:target="submitRevision">
        Submit Revision
    </span>

    <span wire:loading.flex wire:target="submitRevision" class="flex items-center gap-2">
        <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24" fill="none">
            <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-80" d="M4 12a8 8 0 018-8" stroke="currentColor" stroke-width="4"
                stroke-linecap="round"></path>
        </svg>
        Submitting...
    </span>
</button>
    </div>
</div>
@endif

</div>
