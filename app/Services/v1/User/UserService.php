<?php

namespace App\Services\v1\User;

use App\Domain\DataTransferObjects\UserData;
use App\Models\User;
use App\Repository\Interfaces\UserInterface;
use App\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createUser(UserData $userData): User
    {
        $user = $this->userRepository->createUser($userData);
        return $user;
    }

    public function getUser(?string $phone, ?int $user_id)
    {
        return $this->userRepository->getUser($phone, $user_id);
    }


    public function createUserSmsCode(int $user_id, ?int $code)
    {
        $code = $code === null ? $this->generateCode() : $code;
        return $this->userRepository->createUserSmsCode($user_id, $code);
    }

    public function generateCode(): int
    {
        return rand(1000, 9999);
    }

}
