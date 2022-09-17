<?php

namespace App\Services\v1\Clinic;

use App\Domain\DataTransferObjects\ClinicData;
use App\Models\Clinic;
use App\Repository\ClinicRepository;

class ClinicService
{
    private $clinicRepository;

    public function __construct(ClinicRepository $clinicRepository)
    {
        $this->clinicRepository = $clinicRepository;
    }

    public function createClinic(ClinicData $clinicData): Clinic
    {
        $clinic = $this->clinicRepository->createClinic($clinicData);
        return $clinic;
    }

    public function getClinic(?string $name, ?int $clinic_id)
    {
        return $this->clinicRepository->getClinic($name, $clinic_id);
    }
}
