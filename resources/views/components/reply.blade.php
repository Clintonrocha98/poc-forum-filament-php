@props(['reply', 'level' => 0, 'post'])

@php
  $indent = min($level * 6, 32);
@endphp

<div class="ml-{{ $indent }} mb-4 p-4 rounded border dark:border-gray-700 bg-gray-100 dark:bg-gray-800 mt-3">
  <div class="flex items-start justify-between gap-3 w-full">
    <div class="flex items-start gap-2 w-full ">
      <img src="https://placehold.co/40x40?text={{ urlencode($reply->user->name) }}" class="w-8 h-8 rounded-full" />
      <div class="w-full">
        <div class="flex items-center gap-2 text-sm">
          <span class="font-semibold text-gray-800 dark:text-gray-200">{{ $reply->user->name }}</span>

          <span class="text-xs text-gray-500 dark:text-gray-400">
            {{ $reply->created_at->diffForHumans() }}
          </span>
        </div>

        <div class="text-sm text-gray-800 dark:text-gray-200">
          {!! nl2br(e($reply->content)) !!}
        </div>

        <div x-data="{ open: false }" class="mt-2 w-full ">
          <button @click="open = !open"
            class="flex items-center gap-2 text-sm dark:bg-primary-500 bg-gray-200 px-2 py-1 rounded-xl">
            <x-heroicon-o-chat-bubble-left class="w-4 h-4" /> Responder
          </button>

          <div x-show="open" x-cloak class="pt-2 block">
            <livewire:reply-form :post-id="$post->id" :parent-id="$reply->id" />
          </div>
        </div>

      </div>
    </div>
  </div>

  @foreach ($reply->children as $child)
    @include('components.reply', ['reply' => $child, 'level' => $level + 1, 'post' => $post])
  @endforeach
</div>