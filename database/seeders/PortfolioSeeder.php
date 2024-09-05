<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\Portfolio;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Rechercher l'utilisateur "Zeph" par son email ou son login
        $zeph = User::where('login', 'zeph')->first();

        if (!$zeph) {
            $this->command->info('Zeph user not found. Please make sure the user exists.');
            return;
        }

        // Créer le répertoire de destination s'il n'existe pas
        if (!Storage::exists('public/portfolio')) {
            Storage::makeDirectory('public/portfolio');
        }

        // Créer des données de portfolio factices pour Zeph
        $portfolios = [
            [
                'user_id' => $zeph->id,
                'title' => 'Démon japonais',
                'description' => 'Démon japonais que j\'ai tatoué sur le bras d\'un client. Ce tattoo est un de mes préférés et a été réalisé en 5 heures.',
                'image_path' => 'portfolio/zeppettoTat1.jpg',
            ],
            [
                'user_id' => $zeph->id,
                'title' => 'Bonhommes qui dansent',
                'description' => 'Tatouage de bonhommes qui dansent sur le bras d\'un client. Ce tattoo a été réalisé en 3 heures.',
                'image_path' => 'portfolio/zeppettoTat2.jpg',
            ],
            [
                'user_id' => $zeph->id,
                'title' => 'Papillon réaliste',
                'description' => 'Tatouage d\'un papillon réaliste sur la jambe d\'un fidèle client. Ce tattoo a été réalisé en 4 heures.',
                'image_path' => 'portfolio/zeppettoTat3.jpg',
            ],
            [
                'user_id' => $zeph->id,
                'title' => 'Flash',
                'description' => 'Flash avec de nouveaux tatouages. Ils sont tous disponibles à la réservation.',
                'image_path' => 'portfolio/zeppettoTat4.jpg',
            ],
            [
                'user_id' => $zeph->id,
                'title' => 'Flash',
                'description' => 'Flash avec de nouveaux tatouages. Ils sont tous disponibles à la réservation.',
                'image_path' => 'portfolio/zeppettoTat5.jpg',
            ],
            [
                'user_id' => $zeph->id,
                'title' => 'Zeppetto Flowers',
                'description' => 'Fleurs qui me caractérisent tatouées sur le bras d\'une cliente. Ce tattoo a été réalisé en 1 heure.',
                'image_path' => 'portfolio/zeppettoTat6.jpg',
            ],
            [
                'user_id' => $zeph->id,
                'title' => 'Zeppetto Flowers',
                'description' => 'Fleurs qui me caractérisent tatouées sur le bras d\'une cliente. Ce tattoo a été réalisé en 1 heure.',
                'image_path' => 'portfolio/zeppettoTat7.jpg',
            ],
            [
                'user_id' => $zeph->id,
                'title' => 'Poisson chat japonais',
                'description' => 'Poisson chat japonais tatoué sur le mollet d\'un client. Ce tattoo a été réalisé en 2 heures.',
                'image_path' => 'portfolio/zeppettoTat8.jpg',
            ],
            [
                'user_id' => $zeph->id,
                'title' => 'Petite fraise sauvage',
                'description' => 'Petite fraise sauvage tatouée sur la jambe d\'une cliente. Ce tattoo a été réalisé en 1 heure.',
                'image_path' => 'portfolio/zeppettoTat9.jpg',
            ],
        ];

        // Insérer les données de portfolio et copier les images
        foreach ($portfolios as $portfolioData) {
            Portfolio::create($portfolioData);

            // Définir le chemin source et destination
            $sourcePath = database_path('seeders/images/portfolio/' . basename($portfolioData['image_path']));
            $destinationPath = 'public/' . $portfolioData['image_path'];

            // Vérifiez si le fichier n'existe pas déjà dans le stockage, puis copiez-le
            if (!Storage::disk('public')->exists($portfolioData['image_path'])) {
                if (File::exists($sourcePath)) {
                    Storage::disk('public')->put($portfolioData['image_path'], file_get_contents($sourcePath));
                }
            }
        }
    }
}
