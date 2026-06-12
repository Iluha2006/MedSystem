<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Override;

class AppServiceProvider extends ServiceProvider
{

   #[Override]
   public function register()
   {
      $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
   }

    public function boot(): void
    {
        Auth::provider('admin_eloquent', function ($app, array $config) {
            return new AdminUserProvider($app['hash'], $config['model']);
        });
    }
}