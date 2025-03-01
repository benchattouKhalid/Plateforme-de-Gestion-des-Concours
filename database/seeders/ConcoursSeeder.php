<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Concours;

class ConcoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Concours::create([
            'nom' => 'Concours Informatique',
            'description' => 'Concours pour les étudiants en informatique',
            'specialiste' => 'Informatique',
            'dateDebut' => Carbon::create(2024, 5, 1),
            'dateFin' => Carbon::create(2024, 5, 15),
            'grade' => 'bac +2',
            'centre_id' => 1, // Assuming this centre ID exists
        ]);

        Concours::create([
            'nom' => 'Concours Biologie',
            'description' => 'Concours pour les étudiants en biologie',
            'specialiste' => 'Biologie',
            'dateDebut' => Carbon::create(2024, 6, 1),
            'dateFin' => Carbon::create(2024, 6, 15),
            'grade' => 'bac +3',
            'centre_id' => 2, // Assuming this centre ID exists
        ]);

        Concours::create([
            'nom' => 'Concours Chimie',
            'description' => 'Concours pour les étudiants en chimie',
            'specialiste' => 'Chimie',
            'dateDebut' => Carbon::create(2024, 7, 1),
            'dateFin' => Carbon::create(2024, 7, 15),
            'grade' => 'bac +5',
            'centre_id' => 3, // Assuming this centre ID exists
        ]);
    }
}
