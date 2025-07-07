<x-filament-panels::page>
  <div class="grid grid-cols-4 md:grid-cols-2 gap-4">
    @foreach ($communities as $community)
    <a href="{{App\Filament\Pages\Posts::getUrl(['community' => $community->slug]) }}"
      class="rounded-2xl shadow hover:shadow-lg transition overflow-hidden p-4 block bg-white dark:border-gray-700 dark:bg-gray-900 ">
      <div class="flex items-center justify-between gap-2">
      <div class="flex items-center gap-2">
        <img src="https://placehold.co/50x50?text={{ urlencode($community->name) }}" alt="{{ $community->name }}"
        class="w-[50px] h-[50px] rounded-full object-cover">

        <h2 class="text-lg font-semibold dark:text-white">
        {{ $community->name }}
        </h2>
      </div>

      <x-filament::badge color="primary">
        {{ $community->posts_count }}
      </x-filament::badge>
      </div>
    </a>
  @endforeach
  </div>
</x-filament-panels::page>