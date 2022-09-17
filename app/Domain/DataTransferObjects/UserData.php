<?php

namespace App\Domain\DataTransferObjects;

use Spatie\LaravelData\Data;

class UserData extends Data
{
    public function __construct(
        public ?int $clinic_id,
        public readonly string $fio,
        public readonly string $job_title,
        public string $phone,
        public readonly ?string $email,
        public readonly string $role,
    )
    {
    }
}
