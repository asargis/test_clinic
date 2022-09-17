<?php
namespace App\Facades;

use App\Services\v1\AuthService;
use Illuminate\Support\Facades\Facade;

class AuthFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return AuthService::class;
    }

}
