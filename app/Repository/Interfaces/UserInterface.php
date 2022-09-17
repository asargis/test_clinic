<?php

namespace App\Repository\Interfaces;

use App\Domain\DataTransferObjects\UserData;
use App\Models\User;

interface UserInterface
{
    public function createUser(UserData $userData): User;

    public function getUser(?string $phone, ?int $user_id);

    public function createUserSmsCode(int $user_id, string $code): string;
}
