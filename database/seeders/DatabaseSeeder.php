<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'deic_tvm@hridyam.gov.in'],
            [
                'name' => 'DEIC User TVM',
                'password' => bcrypt('password'),
                'district' => 'Thiruvananthapuram',
                'role' => 'deic',
            ]
        );

        User::firstOrCreate(
            ['email' => 'ped_tvm@hridyam.gov.in'],
            [
                'name' => 'Dr. Pediatrician TVM',
                'password' => bcrypt('password'),
                'district' => 'Thiruvananthapuram',
                'role' => 'pediatrician',
            ]
        );

        $this->call([
            MasterTableSeeder::class,
        ]);
    }
}
