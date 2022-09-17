<?php

namespace App\Repository;

use App\Domain\DataTransferObjects\ClinicData;
use App\Models\Clinic;
use App\Repository\Interfaces\ClinicInterface;

class ClinicRepository implements ClinicInterface
{

    public function createClinic(ClinicData $clinicData): Clinic
    {
        try {
            $clinic = Clinic::create($clinicData->toArray());
        } catch (\Exception $e) {
            throw new \Exception('Ошибка, не удалось создать клинику');
        }

        return $clinic;
    }


    public function getClinic(string $name, ?int $clinic_id)
    {
        try {
            if ($name !== null) {
                $clinic = Clinic::where(['name' => $name])
                    ->select('clinics.*')
                    ->first();
            } else if ($clinic_id !== null) {
                $clinic = Clinic::find($clinic_id);
            } else {
                throw new \Exception('Ошибка, отсутствуют данные для поиска клиники');
            }
        } catch (\Exception $e) {
            throw new \Exception('Ошибка, не удалось найти клинику');
        }

        return $clinic;
    }
}
