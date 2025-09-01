<?php

namespace App\Filament\Shared\Pages;

use App\Models\Community;
use Filament\Pages\Page;

class Communities extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'All Communities';

    protected static string $view = 'filament.pages.communities';

    protected static ?string $slug = 'communities';

    public $communities;

    public function mount(): void
    {
        $this->communities = Community::withCount('posts')->get();
    }
}
