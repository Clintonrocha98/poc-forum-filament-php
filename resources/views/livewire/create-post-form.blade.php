<div class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow border dark:border-gray-700 space-y-4">
    <form wire:submit.prevent="submit" class="space-y-4">
        <div>
            <input wire:model.defer="title" type="text"
                class="w-full p-2 rounded-xl border dark:bg-gray-800 dark:border-gray-600 text-sm"
                placeholder="Título da postagem" />
            @error('title') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <textarea wire:model.defer="content" rows="5"
                class="w-full p-2 rounded-xl border dark:bg-gray-800 dark:border-gray-600 text-sm"
                placeholder="Escreva seu conteúdo aqui..."></textarea>
            @error('content') <p class="text-sm text-red-500">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end border-t pt-4 dark:border-gray-700">
            <button type="submit"
                class="px-4 py-2 text-sm rounded-xl dark:bg-gray-600 bg-gray-400 dark:hover:bg-gray-500 hover:bg-gray-700 text-white">
                Publicar
            </button>
        </div>
    </form>

    @if (session()->has('success'))
        <p class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}</p>
    @endif
</div>
