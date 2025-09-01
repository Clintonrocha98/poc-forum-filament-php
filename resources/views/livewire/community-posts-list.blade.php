<div class="space-y-3">
    @foreach ($posts as $post)
        <a
            wire:listen="post-created"
            href="{{ App\Filament\Shared\Pages\PostView::getUrl(['postSlug' => $post->slug]) }}"
            class="duration-200 ease-in-out cursor-pointer flex flex-col gap-2 p-4 rounded-lg shadow-md border transition-colors bg-white hover:bg-gray-100 dark:bg-gray-900 dark:hover:bg-gray-900 dark:border-gray-700">

            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">

                <div class="flex items-center gap-2">
                    <img src="https://placehold.co/40x40?text={{ urlencode($post->author->name) }}" alt="Avatar"
                         class="w-8 h-8 rounded-full">
                    <span
                        class="font-bold text-base text-gray-900 dark:text-white">u/{{ $post->author->name }}</span>
                    <span>{{ $post->created_at->diffForHumans(null, true) }}</span>
                </div>

            </div>

            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $post->title }}
                </h2>
                <p class="dark:text-primary-500 text-primary-400 text-sm line-clamp-3">
                    {{ Str::limit(strip_tags($post->content), 100) }}
                </p>
            </div>

            <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                <div class="flex items-center gap-1">
                    <x-heroicon-o-chat-bubble-left class="w-4 h-4"/>
                    <span>{{ $post->replies_count }}</span>
                </div>
            </div>
        </a>
    @endforeach
</div>
