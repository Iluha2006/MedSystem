<?php

namespace App\Providers\Filament;


use App\Filament\Admin\Resources\Beds\BedResource;
use App\Filament\Admin\Resources\BuildingResource;
use App\Filament\Admin\Resources\Departments\DepartmentResource;
use App\Filament\Admin\Resources\DoctorFacilityResource;
use App\Filament\Admin\Resources\Doctors\DoctorResource; 
use App\Filament\Admin\Resources\Facilities\FacilityResource;
use App\Filament\Admin\Resources\GrudOperations\GrudOperationResource;
use App\Filament\Admin\Resources\LaboratoryResource;
use App\Filament\Admin\Resources\OutpatientVisits\OutpatientVisitResource;
use App\Filament\Admin\Resources\Patients\PatientResource;
use App\Filament\Admin\Widgets\StatsOverview;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
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
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->authGuard('admin')
            ->brandName('MedSystem')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => Color::Amber,
            ])
         
             ->resources([
              BedResource::class,
               DepartmentResource::class,
               FacilityResource::class,
            
              PatientResource::class,
             DoctorResource::class,
               LaboratoryResource::class,
               OutpatientVisitResource::class,
               DoctorFacilityResource::class,
              BuildingResource::class
             ])
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                StatsOverview::class
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