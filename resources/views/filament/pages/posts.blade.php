<x-filament-panels::page>
  <div class="flex gap-4 flex-col">
    <div x-data="{ open: false }" class="space-y-4">
      
      <button @click="open = !open" class="block ml-auto px-4 py-2 text-sm dark:bg-gray-600 bg-gray-400 dark:hover:bg-gray-500 hover:bg-gray-700 text-white rounded ">
        Criar post
      </button>

      <div x-show="open" x-transition x-cloak>
        <livewire:create-post-form :community-id="$community->id" />
      </div>
    </div>
    @foreach ($posts as $post)
    <a href="{{ App\Filament\Pages\PostView::getUrl(['postSlug' => $post->slug]) }}"
      class="duration-200 ease-in-out cursor-pointer flex flex-col gap-2 p-4 rounded-lg shadow-md border transition-colors bg-white hover:bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-900 dark:border-gray-700">

      <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">

      <div class="flex items-center gap-2">
        <img src="https://placehold.co/40x40?text={{ urlencode($post->author->name) }}" alt="Avatar"
        class="w-8 h-8 rounded-full">
        <span class="font-bold text-base text-gray-900 dark:text-white">u/{{ $post->author->name }}</span>
        <span>{{ $post->created_at->diffForHumans(null, true) }}</span>
      </div>


      </div>

      <div>
      <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
        {{ $post->title }}
      </h2>
      <p class="text-gray-700 dark:text-gray-300 text-sm line-clamp-3">
        {{ Str::limit(strip_tags($post->content), 100) }}
      </p>
      </div>

      <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
      <div class="flex items-center gap-1">
        <x-heroicon-o-chat-bubble-left class="w-4 h-4" />
        <span>{{ $post->replies_count }}</span>
      </div>
      </div>

    </a>
  @endforeach
  </div>
</x-filament-panels::page>