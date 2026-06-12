<?php

use App\Providers\AuthServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    
    AuthServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
];
