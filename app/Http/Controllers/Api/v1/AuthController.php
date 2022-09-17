<?php

namespace App\Http\Controllers\Api\v1;

use App\Domain\DataTransferObjects\ClinicData;
use App\Domain\DataTransferObjects\UserData;
use App\Facades\AuthFacade;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

class AuthController extends Controller
{
    public function step1(Request $request)
    {
        $result = [];
        try {
            $request->validate([
                'city' => ['required'],
                'name' => ['required'],
                'inn' => ['required'],
                'fio' => ['required'],
                'job_title' => ['required'],
                'phone' => ['required', 'regex:/^(\+7|8)[\s(]?(\d{3})[\s)]?(\d{3})[\s-]?(\d{2})[\s-]?(\d{2})+/'],
                'email' => ['nullable', 'regex:/\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+/'],
            ]);

            $clinicData = ClinicData::from($request);
            $userData = UserData::from($request);

            if (AuthFacade::step1($clinicData, $userData) === false) {
                throw new \Exception('Ошибка, не удалось создать код для аутентификации');
            }
            $result = [
                'status' => 'ok',
                'data' => [
                    'message' => 'Код для аутентификации создан успешно'
                ]
            ];
        } catch (ValidationException $e) {
            $result = [
                'status' => 'error',
                'data' => [
                    'message' => "Ошибка, некорректный номер телефона",
                    'error_code' => $e->getCode()
                ]
            ];
        }
        return new JsonResponse($result);
    }
}
