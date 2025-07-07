<form wire:submit.prevent="submit" class="space-y-2 mt-2">
    <textarea wire:model.defer="content" rows="3"
        class="w-full p-2 rounded border dark:bg-gray-800 dark:border-gray-600 text-sm"
        placeholder="Participe da conversa"></textarea>

    @error('content') <p class="text-sm text-red-500 dark:text-red-600">{{ $message }}</p> @enderror

    <div class="flex justify-between items-center">
        @if (is_null($parentId))
            <div class="p-2 rounded-full w-fit dark:bg-gray-600 bg-gray-800 flex items-center gap-1">
                <x-heroicon-o-chat-bubble-left class="w-4 h-4" />
                <span class="text-sm">{{ $replies_count }}</span>
            </div>
        @endif

        <button type="submit" class="px-3 py-2 text-sm dark:bg-gray-600 bg-gray-300 text-black rounded-full">
            Enviar
        </button>
    </div>
</form>