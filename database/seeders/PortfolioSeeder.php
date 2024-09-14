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
        // Créer le répertoire de destination s'il n'existe pas
        if (!Storage::exists('public/portfolio')) {
            Storage::makeDirectory('public/portfolio');
        }

        // Liste des tatoueurs par login pour lesquels on va créer des portfolios
        $tattooArtistsLogins = [
            'zeppettoTattoo' => [
                [
                    'title' => 'Démon japonais',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat1.jpg',
                ],
                [
                    'title' => 'Bonhommes qui dansent',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat2.jpg',
                ],
                [
                    'title' => 'Papillon réaliste',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat3.jpg',
                ],
                [
                    'title' => 'Flash',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat4.jpg',
                ],
                [
                    'title' => 'Flash',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat5.jpg',
                ],
                [
                    'title' => 'Zeppetto Flowers',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat6.jpg',
                ],
                [
                    'title' => 'Zeppetto Flowers',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat7.jpg',
                ],
                [
                    'title' => 'Poisson chat japonais',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat8.jpg',
                ],
                [
                    'title' => 'Petite fraise sauvage',
                    'description' => '',
                    'image_path' => 'portfolio/zeppettoTat9.jpg',
                ],
            ],
            'art.jooo' => [
                [
                    'title' => 'Oeil mélancolique étoilé',
                    'description' => '',
                    'image_path' => 'portfolio/josephineTat1.jpg',
                ],
                [
                    'title' => 'Femme à franche (dot style)',
                    'description' => '',
                    'image_path' => 'portfolio/josephineTat2.jpg',
                ],
                [
                    'title' => 'Cachet japonais - fleurs',
                    'description' => '',
                    'image_path' => 'portfolio/josephineTat3.jpg',
                ],
                [
                    'title' => 'Volcan en éruption de joie',
                    'description' => '',
                    'image_path' => 'portfolio/josephineTat4.jpg',
                ],
                [
                    'title' => 'Démon japonais',
                    'description' => '',
                    'image_path' => 'portfolio/josephineTat5.jpg',
                ],
                [
                    'title' => 'peinture à l\'ancienne',
                    'description' => '',
                    'image_path' => 'portfolio/josephineTat6.jpg',
                ],
                [
                    'title' => 'Flash',
                    'description' => '',
                    'image_path' => 'portfolio/josephineTat7.jpg',
                ],
                [
                    'title' => 'Carpe Koi épaule',
                    'description' => '',
                    'image_path' => 'portfolio/josephineTat8.jpg',
                ],
            ],
            'hadrigonzalezzz' => [
                [
                    'title' => 'Flowers behind the ear',
                    'description' => '',
                    'image_path' => 'portfolio/hadriTat1.jpg',
                ],
                [
                    'title' => 'Lucky duck',
                    'description' => '',
                    'image_path' => 'portfolio/hadriTat2.jpg',
                ],
                [
                    'title' => 'Devil\'s ass',
                    'description' => '',
                    'image_path' => 'portfolio/hadriTat3.jpg',
                ],
                [
                    'title' => 'Earth',
                    'description' => '',
                    'image_path' => 'portfolio/hadriTat4.jpg',
                ],
            ],
            'harisha.ttt' => [
                [
                    'title' => 'Katana et dragon',
                    'description' => '',
                    'image_path' => 'portfolio/HarishaTat1.jpg',
                ],
                [
                    'title' => 'Flash 73',
                    'description' => '',
                    'image_path' => 'portfolio/HarishaTat2.jpg',
                ],
                [
                    'title' => 'Guts',
                    'description' => '',
                    'image_path' => 'portfolio/HarishaTat3.jpg',
                ],
                [
                    'title' => 'Dragon japonais',
                    'description' => '',
                    'image_path' => 'portfolio/HarishaTat4.jpg',
                ],
                [
                    'title' => 'Nature morte',
                    'description' => '',
                    'image_path' => 'portfolio/HarishaTat5.jpg',
                ],
                [
                    'title' => 'Entité maléfique',
                    'description' => '',
                    'image_path' => 'portfolio/HarishaTat6.jpg',
                ],
                [
                    'title' => 'Flash 74',
                    'description' => '',
                    'image_path' => 'portfolio/HarishaTat7.jpg',
                ],
                [
                    'title' => 'Femme de Yakuza',
                    'description' => '',
                    'image_path' => 'portfolio/HarishaTat8.jpg',
                ],
            ],
            'danny.bautista_' => [
                [
                    'title' => 'Piranha',
                    'description' => '',
                    'image_path' => 'portfolio/dannyTat1.jpg',
                ],
                [
                    'title' => 'Flash Hello Kitty gore',
                    'description' => '',
                    'image_path' => 'portfolio/dannyTat2.jpg',
                ],
                [
                    'title' => 'Skull and sword',
                    'description' => '',
                    'image_path' => 'portfolio/dannyTat3.jpg',
                ],
                [
                    'title' => 'Papillon de nuit',
                    'description' => '',
                    'image_path' => 'portfolio/dannyTat4.jpg',
                ],
                [
                    'title' => 'Scorpio',
                    'description' => '',
                    'image_path' => 'portfolio/dannyTat5.jpg',
                ],
                [
                    'title' => 'Mermaid',
                    'description' => '',
                    'image_path' => 'portfolio/dannyTat6.jpg',
                ],
            ]
        ];

        // Créer les portfolios pour chaque tatoueur
        foreach ($tattooArtistsLogins as $login => $portfolios) {
            $artist = User::where('login', $login)->first();

            if (!$artist) {
                $this->command->info("User with login '{$login}' not found. Please make sure the user exists.");
                continue;
            }

            // Insérer les portfolios pour l'utilisateur spécifique
            foreach ($portfolios as $portfolioData) {
                Portfolio::create([
                    'user_id' => $artist->id,
                    'title' => $portfolioData['title'],
                    'description' => $portfolioData['description'],
                    'image_path' => $portfolioData['image_path'],
                ]);

                // Définir le chemin source et destination
                $sourcePath = database_path('seeders/images/portfolio/' . basename($portfolioData['image_path'])); // Correction du chemin source
                $destinationPath = 'public/' . $portfolioData['image_path'];

                // Vérifiez si le fichier n'existe pas déjà dans le stockage, puis copiez-le
                if (!Storage::disk('public')->exists($portfolioData['image_path'])) {
                    if (File::exists($sourcePath)) {
                        Storage::disk('public')->put($portfolioData['image_path'], file_get_contents($sourcePath));
                    } else {
                        $this->command->info("Image not found: " . $sourcePath);
                    }
                }
            }
        }
    }
}
