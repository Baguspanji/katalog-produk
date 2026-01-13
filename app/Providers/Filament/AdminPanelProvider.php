<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\DashboardStatsWidget;
use App\Filament\Widgets\ProductClicksChartWidget;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Joaopaulolndev\FilamentEditProfile\FilamentEditProfilePlugin;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->darkMode(false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->plugins([
                FilamentEditProfilePlugin::make()
                    ->slug('profile')
                    ->setTitle('Profil Saya')
                    // ->setNavigationLabel('Profil Saya')
                    // ->setIcon('heroicon-o-user')
                    // ->setSort(10)
                    ->canAccess(fn () => Auth::user()->id === 1)
                    ->shouldRegisterNavigation(value: false)
                    ->shouldShowEmailForm()
                    // ->shouldShowThemeColorForm(rules: 'required') // optional validation rules for the theme color field
                    ->shouldShowDeleteAccountForm(false)
                    // ->shouldShowSanctumTokens()
                    ->shouldShowBrowserSessionsForm()
            ])
            ->userMenuItems([
                'profile' => Action::make('profil')
                    ->label('Pengaturan')
                    ->url(fn (): string => EditProfilePage::getUrl())
                    ->icon('heroicon-o-cog-6-tooth')
                    //If you are using tenancy need to check with the visible method where ->company() is the relation between the user and tenancy model as you called
            ])
            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
                DashboardStatsWidget::class,
                ProductClicksChartWidget::class,
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
}
