<div class="rounded-lg border border-green-100 bg-green-50/50 p-4 text-left">
    @if ($feedback !== '')
        <p class="text-xs font-medium mb-2 {{ $feedbackIsError ? 'text-amber-800' : 'text-green-700' }}">{{ $feedback }}</p>
    @endif
    <p class="text-xs font-semibold text-gray-800 mb-1">Testimonial for <span class="font-medium text-[#0f3d34]">/ban-investors</span></p>
    <p class="text-xs text-gray-600 mb-3">Optional quote from this member about BAN. Only appears publicly if you enable the checkbox below.</p>
    <textarea
        wire:model.defer="body"
        rows="3"
        maxlength="1200"
        placeholder="What they said about Bangladesh Angels Network…"
        class="w-full text-sm border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500"
    ></textarea>
    @error('body')
        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
    @enderror
    <label class="flex items-start gap-2 mt-3 text-sm text-gray-700 cursor-pointer">
        <input type="checkbox" wire:model.defer="showPublic" class="mt-0.5 rounded border-gray-300 text-green-600 focus:ring-green-500">
        <span>Show testimonial quote on the public investors page</span>
    </label>
    <button
        type="button"
        wire:click="save"
        wire:loading.attr="disabled"
        class="mt-3 px-3 py-1.5 bg-green-600 text-white text-xs font-semibold rounded-lg hover:bg-green-700 disabled:opacity-60"
    >
        <span wire:loading.remove wire:target="save">Save testimonial</span>
        <span wire:loading wire:target="save">Saving…</span>
    </button>
</div>
