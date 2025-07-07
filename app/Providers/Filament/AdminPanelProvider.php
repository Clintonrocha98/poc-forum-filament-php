<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Communities;
use Filament\Facades\Filament;
use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use App\Models\Community;
use Filament\PanelProvider;
use App\Filament\Pages\Posts;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Schema;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{


    public function panel(Panel $panel): Panel
    {

        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration()
            ->colors([
                'primary' => Color::Gray,
                // ...Color::all()
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Communities::class,
            ])
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Communities')
                    ->icon('heroicon-o-users')
            ])
            ->navigationItems($this->getNavigationItems())
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->viteTheme('resources/css/app.css')
            ->widgets([
                Widgets\AccountWidget::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public function getNavigationItems(): array
    {
        if (!Schema::hasTable('communities')) {
            return [];
        }
        $communities = Community::withCount('posts')->get();

        return $communities->map(function ($community) {
            return NavigationItem::make(label: $community->name)
                ->group('Communities')
                ->label($community->name)
                ->url(fn() => Posts::getUrl(['community' => $community->slug]))
                ->badge($community->posts_count)
                ->sort(10);
        })->toArray();
    }

}
