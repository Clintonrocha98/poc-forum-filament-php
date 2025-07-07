<x-filament-panels::page>
  <div class="bg-white dark:border-gray-700 dark:bg-gray-900 p-6 rounded-lg shadow border  space-y-4">

    <div class="flex items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
      <img src="https://placehold.co/40x40?text={{ urlencode($post->author->name) }}"
        class="w-[50px] h-[50px] rounded-full object-cover" />
      <div class="flex items-center gap-2">
        <div class="font-semibold text-gray-900 dark:text-white">{{ $post->author->name }}</div>
        <div class="text-xs">{{ $post->created_at->diffForHumans() }}</div>
      </div>
    </div>

    <div class="text-gray-800 dark:text-gray-200">
      {!! nl2br(e($post->content)) !!}
    </div>

    <livewire:reply-form :post-id="$post->id" :replies_count="$post->replies_count" />

    <div class="mt-6 border-t pt-4 dark:border-gray-700">
      <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 inline-block">Todas as respsotas</h2>

      @forelse ($post->replies as $reply)
      @include('components.reply', ['reply' => $reply, 'level' => 0, 'post' => $post])
    @empty
      <p class="text-gray-500 dark:text-gray-400">Nenhuma resposta ainda.</p>
    @endforelse
    </div>
  </div>
</x-filament-panels::page>