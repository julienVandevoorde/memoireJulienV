<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vérifie que le dossier de destination existe, sinon le crée
        if (!Storage::exists('public/profile_photos')) {
            Storage::makeDirectory('public/profile_photos');
        }

        // Définir les utilisateurs à insérer
        $users = [
            [
                'name' => 'Admin',
                'login' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'admin',
                'gender' => null,
                'profile_photo_path' => null,
                'location' => null,
                'bio' => null,
                'instagram_link' => null,
                'experience_years' => null,
            ],
            [
                'name' => 'Zephyr Jonnaert',
                'login' => 'zeph',
                'email' => 'zeph@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'male',
                'profile_photo_path' => 'profile_photos/profileZeppetto.jpg',
                'location' => null,
                'bio' => 'Experienced tattoo artist since 2020',
                'instagram_link' => null,
                'experience_years' => null,
            ],
            [
                'name' => 'Julien Vandevoorde',
                'login' => 'julienvdv',
                'email' => 'julien@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'client',
                'gender' => 'male',
                'profile_photo_path' => null,
                'location' => null,
                'bio' => null,
                'instagram_link' => null,
                'experience_years' => null,
            ],
        ];

        // Insérer les utilisateurs et copier l'image de profil de Zephyr
        foreach ($users as $userData) {
            $user = User::create($userData);

            // Si l'utilisateur est Zephyr, on copie l'image de profil
            if ($user->login === 'zeph') {
                $sourcePath = database_path('seeders/images/profile_photos/profileZeppetto.jpg');
                $destinationPath = 'public/profile_photos/profileZeppetto.jpg';

                // Vérifie si le fichier n'existe pas déjà dans le stockage, puis le copie
                if (!Storage::disk('public')->exists('profile_photos/profileZeppetto.jpg')) {
                    if (File::exists($sourcePath)) {
                        Storage::disk('public')->put('profile_photos/profileZeppetto.jpg', file_get_contents($sourcePath));
                    }
                }
            }
        }
    }
}
