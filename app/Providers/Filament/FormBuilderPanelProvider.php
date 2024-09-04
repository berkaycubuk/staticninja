<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class FormBuilderPanelProvider extends PanelProvider
{
    protected static ?string $title = "Static Ninja Forms";

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('form-builder')
            ->path('form-builder')
            ->registration()
            ->login()
            ->profile()
            ->passwordReset()
            ->emailVerification()
            ->brandName('Static Ninja Forms')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/FormBuilder/Resources'), for: 'App\\Filament\\FormBuilder\\Resources')
            ->discoverPages(in: app_path('Filament/FormBuilder/Pages'), for: 'App\\Filament\\FormBuilder\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/FormBuilder/Widgets'), for: 'App\\Filament\\FormBuilder\\Widgets')
            ->widgets([
            ])
            ->renderHook(
                'panels::head.start',
                fn () => view('analyticsHead'),
            )
            ->renderHook(
                'panels::head.end',
                fn () => Blade::render('<link href="/prism.css" rel="stylesheet" />'),
            )
            ->renderHook(
                'panels::body.end',
                fn () => Blade::render('<script src="/prism.js"></script>'),
            )
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
