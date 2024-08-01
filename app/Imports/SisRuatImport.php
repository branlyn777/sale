<?php

namespace App\Imports;

use App\Models\SisRuat;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SisRuatImport implements ToModel, WithHeadingRow
{
    /**
     * Specify the heading row start position.
     */
    public function headingRow(): int
    {
        return 1; // Cambia este valor según la fila donde comiencen los encabezados en tu archivo Excel
    }

    public function model(array $row)
    {
        return new SisRuat([
            'image' => $row['image'] ?? null,
            'file' => $row['file'] ?? null,
            'license_plate' => $row['license_plate'] ?? null,
            'class' => $row['class'] ?? null,
            'mark' => $row['mark'] ?? null,
            'vehicle_type' => $row['vehicle_type'] ?? null,
            'vehicle_subtype' => $row['vehicle_subtype'] ?? null,
            'engine_number' => $row['engine_number'] ?? null,
            'chassis_number' => $row['chassis_number'] ?? null,
            'model' => $row['model'] ?? null,
            'service' => $row['service'] ?? null,
            'policy_type' => $row['policy_type'] ?? null,
            'policy_date' => $row['policy_date'] ?? null,
            'country' => $row['country'] ?? null,
            'customs_import' => $row['customs_import'] ?? null,
            'policy_number' => $row['policy_number'] ?? null,
            'tax_start_year' => $row['tax_start_year'] ?? null,
            'origin' => $row['origin'] ?? null,
            'displacement' => $row['displacement'] ?? null,
            'traction' => $row['traction'] ?? null,
            'number_of_wheels' => $row['number_of_wheels'] ?? null,
            'number_of_doors' => $row['number_of_doors'] ?? null,
            'color' => $row['color'] ?? null,
            'number_of_places' => $row['number_of_places'] ?? null,
            'fuel' => $row['fuel'] ?? null,
            'chassis_type' => $row['chassis_type'] ?? null,
            'motor_type' => $row['motor_type'] ?? null,
            'motor_turbo' => $row['motor_turbo'] ?? null,
            'weight' => $row['weight'] ?? null,
            'towing_capacity' => $row['towing_capacity'] ?? null,
            'observations' => $row['observations'] ?? null,
            'is_print' => $row['is_print'] ?? null,
            'status' => $row['status'] ?? null,
        ]);
    }
}
