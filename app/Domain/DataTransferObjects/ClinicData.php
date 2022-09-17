<?php

namespace App\Domain\DataTransferObjects;

use Spatie\LaravelData\Data;

class ClinicData extends Data
{
    public function __construct(
        public readonly string $city,
        public readonly string $name,
        public readonly string $inn,
        public readonly ?string $address,
        public readonly ?string $site,
    )
    {
    }
}
