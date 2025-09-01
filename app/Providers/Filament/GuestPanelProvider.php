<?php

namespace App\Providers\Filament;

use App\Filament\Shared\Pages\Communities;
use App\Filament\Shared\Pages\Posts;
use App\Models\Community;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class GuestPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('guest')
            ->path('')
            ->colors([
                'primary' => Color::Gray,
            ])
            ->discoverResources(in: app_path('Filament/Guest/Resources'), for: 'App\\Filament\\Guest\\Resources')
            ->discoverPages(in: app_path('Filament/Shared/Pages'), for: 'App\\Filament\\Shared\\Pages')
            ->pages([
                Communities::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Communities')
                    ->icon('heroicon-o-users'),
            ])
            ->navigationItems($this->getNavigationItems())
            ->discoverWidgets(in: app_path('Filament/Guest/Widgets'), for: 'App\\Filament\\Guest\\Widgets')
            ->widgets([
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ]);
    }

    public function getNavigationItems(): array
    {
        if (! Schema::hasTable('communities')) {
            return [];
        }

        $communities = Community::withCount('posts')->get();

        return $communities->map(function ($community) {
            return NavigationItem::make(label: $community->name)
                ->group('Communities')
                ->label($community->name)
                ->url(fn () => Posts::getUrl(['community' => $community->slug]))
                ->badge($community->posts_count)
                ->sort(10);
        })->toArray();
    }
}
