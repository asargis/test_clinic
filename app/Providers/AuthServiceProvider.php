<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\v1\AuthService;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthService::class, function()
        {
            return new AuthService();
        });
    }
}
