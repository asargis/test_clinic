<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Services\v1\User\UserService;

class UserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return UserService::class;
    }

}
