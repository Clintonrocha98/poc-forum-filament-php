<?php

namespace App\Filament\Pages;

use App\Models\Community;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Posts extends Page
{
    protected static string $view = 'filament.pages.posts';

    protected static ?string $slug = 'communities/{community?}/posts';

    protected static bool $shouldRegisterNavigation = false;

    protected ?string $subheading = 'Veja os últimos posts da comunidade';

    public $posts;

    public $community;

    public function mount(string $community): void
    {
        $this->community = Community::whereSlug($community)
            ->firstOrFail();

        $this->posts = $this->community
            ->posts()
            ->with('author')
            ->withCount('replies')
            ->latest()
            ->get();
    }

    public function getTitle(): string|Htmlable
    {
        return 'r/' . $this->community->name;
    }
}
