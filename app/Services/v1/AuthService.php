<?php

namespace App\Services\v1;

use App\Domain\DataTransferObjects\ClinicData;
use App\Domain\DataTransferObjects\UserData;
use App\Facades\ClinicFacade;
use App\Facades\UserFacade;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function step1(ClinicData $clinicData, UserData $userData): bool
    {
        try {
            DB::beginTransaction();
            $code = null;
            $userData->phone = $this->changePhoneFormat($userData->phone);

            $clinic = ClinicFacade::getClinic($clinicData->name, null);
            if (null === $clinic) {
                $clinic = ClinicFacade::createClinic($clinicData);
            }

            $user = UserFacade::getUser($userData->phone, null);
            if (null === $user) {
                $userData->clinic_id = $clinic->id;
                $user = UserFacade::createUser($userData);
            }
            $sms_code = UserFacade::createUserSmsCode($user->id, $code);

            // @TODO: сервис отправки смс
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Ошибка, не удалось создать код для аутентификации');
        }

        return true;
    }

    public function changePhoneFormat(string $phone): string
    {
        $first_number = substr($phone, 0, 1);
        if ((int)$first_number === 8) {
            $phone = substr_replace($phone, '7', 0, 1);
        }
        $phone = str_replace(['(', ')', '+'], '', $phone);

        return $phone;
    }
}
