<?php

namespace App\Filament\Pages;

use App\Models\Post;
use Filament\Pages\Page;

class PostView extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static bool $shouldRegisterNavigation = false;
    protected static string $view = 'filament.pages.post';
    protected static ?string $slug = 'posts/{postSlug?}';

    public $post;

    public function mount(string $postSlug): void
    {
        $this->post = Post::where('slug', $postSlug)
            ->withCount('replies')
            ->with([
                'author',
                'replies' => fn($q) => $q
                    ->with(['user', 'children.user'])
                    ->whereNull('parent_id')
                    ->latest()
            ])
            ->firstOrFail();
    }

    public function getTitle(): string
    {
        return $this->post->title;
    }
}
