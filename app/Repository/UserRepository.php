<?php

namespace App\Repository;

use App\Domain\DataTransferObjects\UserData;
use App\Models\User;
use App\Models\UserSmsCode;
use App\Repository\Interfaces\UserInterface;

class UserRepository implements UserInterface
{

    public function createUser(UserData $userData): User
    {
        try {
            $user = User::create($userData->toArray());
        } catch (\Exception $e) {
            throw new \Exception('Ошибка, не удалось создать пользователя');
        }

        return $user;
    }

    public function getUser(?string $phone, ?int $user_id)
    {
        try {
            if ($phone !== null) {
                $user = User::where(['phone' => $phone])
                    ->select('users.*')
                    ->first();
            } else if ($user_id !== null) {
                $user = User::find($user_id);
            } else {
                throw new \Exception('Ошибка, отсутствуют данные для поиска пользователя');
            }
        } catch (\Exception $e) {
            throw new \Exception('Ошибка, не удалось найти пользователя');
        }

        return $user;
    }

    public function createUserSmsCode(int $user_id, string $code): string
    {
        try {
            $sms_code = UserSmsCode::create(
                ['user_id' => $user_id, 'code' => $code, 'status' => UserSmsCode::STATUS_NEW] // 0 первый статус, положительный, 1 уже использован или удален, 2 заблокирован
            );
        } catch (\Exception $e) {
            throw new \Exception('Ошибка, не удалось создать код для пользователя');
        }

        return $sms_code;
    }
}
