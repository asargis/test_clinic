<?php
namespace App\Facades;

use App\Services\v1\Clinic\ClinicService;
use Illuminate\Support\Facades\Facade;

class ClinicFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ClinicService::class;
    }

}
