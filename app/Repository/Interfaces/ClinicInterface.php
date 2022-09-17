<?php

namespace App\Repository\Interfaces;

use App\Domain\DataTransferObjects\ClinicData;
use App\Models\Clinic;

interface ClinicInterface
{
    public function createClinic(ClinicData $clinicData): Clinic;

    public function getClinic(string $name, ?int $clinic_id);
}
