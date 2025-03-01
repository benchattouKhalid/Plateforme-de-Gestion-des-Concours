<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Centre;

class CentreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Centre::create([
            'nom' => 'Centre A',
            'adresse' => '123 Main St, City A',
            'placesDisponibles' => 50,

            
        ]);

        Centre::create([
            'nom' => 'Centre B',
            'adresse' => '456 Broad St, City B',
            'placesDisponibles' => 30,


        ]);
    }
}
