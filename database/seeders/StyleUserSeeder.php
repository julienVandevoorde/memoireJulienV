<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Style;

class StyleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer tous les styles
        $styles = Style::all();

        // Récupérer tous les tatoueurs
        $tattooArtists = User::where('role', 'tattoo artist')->get();

        foreach ($tattooArtists as $artist) {
            // Sélectionne aléatoirement 1 à 3 styles pour chaque tatoueur
            $randomStyles = $styles->random(rand(1, 3))->pluck('id');
            $artist->styles()->attach($randomStyles);
        }
    }
}
