<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Diagnosis Types
        $types = [
            1 => 'Type 1',
            2 => 'Type 2',
            3 => 'Type 3'
        ];
        foreach ($types as $id => $name) {
            \App\Models\DiagnosisType::firstOrCreate(['id' => $id], ['name' => $name]);
        }

        // Categories
        $catFile = fopen('c:/Users/harin/Desktop/NHM-Hridyam/t_chd_category.csv', 'r');
        if ($catFile !== false) {
            fgetcsv($catFile); // skip header
            while (($data = fgetcsv($catFile)) !== false) {
                if(count($data) >= 5) {
                    \App\Models\Category::firstOrCreate(
                        ['id' => $data[0]],
                        [
                            'name' => $data[1],
                            'parent_id' => empty($data[2]) ? null : $data[2],
                            'days' => $data[3] ?? 0,
                            'status' => $data[4] ?? 1,
                            'description' => $data[5] ?? null
                        ]
                    );
                }
            }
            fclose($catFile);
        }

        // Diagnoses
        $diagFile = fopen('c:/Users/harin/Desktop/NHM-Hridyam/t_surgical _procedure.csv', 'r');
        if ($diagFile !== false) {
            fgetcsv($diagFile); // skip header
            while (($data = fgetcsv($diagFile)) !== false) {
                if(count($data) >= 8) {
                    \App\Models\Diagnosis::firstOrCreate(
                        ['id' => $data[0]],
                        [
                            'name' => $data[1],
                            'icd_code' => $data[2] ?? null,
                            'diagnosis_type_id' => !empty($data[7]) && in_array($data[7], [1,2,3]) ? $data[7] : 1,
                            'category_id' => 1 // Default
                        ]
                    );
                }
            }
            fclose($diagFile);
        }
    }
}
