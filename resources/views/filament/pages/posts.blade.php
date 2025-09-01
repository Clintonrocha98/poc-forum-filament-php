<x-filament-panels::page>
    <div class="flex gap-4 flex-col">
        @if(auth()->check())
            <div x-data="{ open: false }" class="space-y-4">
                <x-filament::button
                    @click="open = !open"
                    class="ml-auto px-4 py-2 text-sm dark:bg-gray-800 bg-gray-800 text-white rounded-xl ">
                    Criar post
                </x-filament::button>

                <div x-show="open"
                     x-transition
                     x-cloak>
                    <form wire:submit="createPost">
                        {{ $this->form }}
                        <x-filament::button
                            type="submit" form="submit"
                            class="mt-2 dark:bg-gray-800 hover:bg-gray-700 rounded-xl">
                            Postar
                        </x-filament::button>
                    </form>
                </div>
            </div>
        @endif
        <livewire:community-posts-list :community="$community"/>
    </div>
</x-filament-panels::page>
