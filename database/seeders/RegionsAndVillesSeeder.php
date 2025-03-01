<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;
use App\Models\Ville;

class RegionsAndVillesSeeder extends Seeder
{
    public function run()
    {
        $regionsAndVilles = [
            'Tanger-Tétouan-Al Hoceïma' => [
                'Tanger', 'Tétouan', 'Al Hoceïma', 'Larache', 'Ouezzane', 'Chefchaouen', 'Fahs-Anjra'
            ],
            'L\'Oriental' => [
                'Oujda', 'Nador', 'Berkane', 'Taourirt', 'Jerada', 'Driouch', 'Guercif', 'Figuig'
            ],
            'Fès-Meknès' => [
                'Fès', 'Meknès', 'Taza', 'El Hajeb', 'Sefrou', 'Boulemane', 'Taounate', 'Ifrane', 'Moulay Yacoub'
            ],
            'Rabat-Salé-Kénitra' => [
                'Rabat', 'Salé', 'Kénitra', 'Témara', 'Sidi Slimane', 'Khémisset', 'Sidi Kacem'
            ],
            'Béni Mellal-Khénifra' => [
                'Béni Mellal', 'Khouribga', 'Khénifra', 'Fquih Ben Salah', 'Azilal'
            ],
            'Casablanca-Settat' => [
                'Casablanca', 'Settat', 'Mohammedia', 'El Jadida', 'Nouaceur', 'Médiouna', 'Berrechid', 'Sidi Bennour'
            ],
            'Marrakech-Safi' => [
                'Marrakech', 'Safi', 'Essaouira', 'El Kelâa des Sraghna', 'Chichaoua', 'Youssoufia', 'Rehamna'
            ],
            'Drâa-Tafilalet' => [
                'Errachidia', 'Ouarzazate', 'Zagora', 'Midelt', 'Tinghir'
            ],
            'Souss-Massa' => [
                'Agadir', 'Taroudant', 'Inezgane-Aït Melloul', 'Tiznit', 'Chtouka Ait Baha', 'Tata'
            ],
            'Guelmim-Oued Noun' => [
                'Guelmim', 'Tan-Tan', 'Sidi Ifni', 'Assa-Zag'
            ],
            'Laâyoune-Sakia El Hamra' => [
                'Laâyoune', 'Es-Semara', 'Boujdour', 'Tarfaya'
            ],
            'Dakhla-Oued Ed-Dahab' => [
                'Dakhla', 'Aousserd'
            ]
        ];

        foreach ($regionsAndVilles as $regionName => $villes) {
            $region = Region::create(['name' => $regionName]);
            foreach ($villes as $villeName) {
                Ville::create(['name' => $villeName, 'region_id' => $region->id]);
            }
        }
    }
}

