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
                'login' => 'zeppettoTattoo',
                'email' => 'zeph@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'male',
                'profile_photo_path' => 'profile_photos/profileZeppetto.jpg',
                'location' => 'Saint-Gilles',
                'bio' => 'Experienced tattoo artist since 2020',
                'instagram_link' => 'instagram.com/zeppetto.ta2/',
                'experience_years' => 'Less than 5 years',
            ],
            [
                'name' => 'Julien Vandevoorde',
                'login' => 'julienvdv',
                'email' => 'julien@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'client',
                'gender' => 'male',
                'profile_photo_path' => 'profile_photos/profileJulien.jpg',
                'location' => null,
                'bio' => null,
                'instagram_link' => null,
                'experience_years' => null,
            ],
            [
                'name' => 'Annabel Crowe',
                'login' => 'annabelC',
                'email' => 'annabel@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'client',
                'gender' => 'female',
                'profile_photo_path' => 'profile_photos/profileAnnabel.jpg',
                'location' => null,
                'bio' => null,
                'instagram_link' => null,
                'experience_years' => null,
            ],
            [
                'name' => 'Josephine Poncelet',
                'login' => 'art.jooo',
                'email' => 'josephine@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'female',
                'profile_photo_path' => 'profile_photos/profileJosephine.jpg',
                'location' => 'Anderlecht',
                'bio' => 'tattoo artist @souscielbleu DM for appointment',
                'instagram_link' => 'instagram.com/josephine.poncelet/',
                'experience_years' => 'More than 10 years',
            ],
            [
                'name' => 'Mathilde Vandevoorde',
                'login' => 'mathildeVdv',
                'email' => 'mathilde@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'client',
                'gender' => 'female',
                'profile_photo_path' => 'profile_photos/profileMathilde.jpg',
                'location' => null,
                'bio' => null,
                'instagram_link' => null,
                'experience_years' => null,
            ],
            [
                'name' => 'Hadrian Bernaert',
                'login' => 'hadrigonzalezzz',
                'email' => 'hadrian@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'non-binary',
                'profile_photo_path' => null,
                'location' => 'Koekelberg',
                'bio' => 'Tatoueur non binaire #safeplace n\'hésitez pas à me contacter pour un projet',
                'instagram_link' => null,
                'experience_years' => 'Less than 5 years',
            ],
            [
                'name' => 'Harisha Vagabond',
                'login' => 'harisha.ttt',
                'email' => 'harisha@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'male',
                'profile_photo_path' => 'profile_photos/profileHashira.jpg',
                'location' => 'Ixelles',
                'bio' => 'Contactez moi pour des projets sérieux uniquement. Merci! :)',
                'instagram_link' => 'instagram.com/harisha.ttt/',
                'experience_years' => '5 to 10 years',
            ],
            [
                'name' => 'Adri Lepetit',
                'login' => 'adritatoue',
                'email' => 'adri@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'other',
                'profile_photo_path' => 'profile_photos/profileAdri.jpg',
                'location' => 'Forest',
                'bio' => 'From Brasil but I tattoo in Brussels. DM for appointments',
                'instagram_link' => 'instagram.com/adritatoue/',
                'experience_years' => 'More than 10 years',
            ],
            [
                'name' => 'Gaia Vanderwerf',
                'login' => 'beufahtattoo',
                'email' => 'gaia@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'female',
                'profile_photo_path' => 'profile_photos/profileGaia.jpg',
                'location' => 'Saint-Gilles',
                'bio' => 'BXL located! DM for info and prices',
                'instagram_link' => 'instagram.com/beufahtattoo/',
                'experience_years' => '5 to 10 years',
            ],
            [
                'name' => 'Danny Bautista',
                'login' => 'danny.bautista_',
                'email' => 'danny@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'male',
                'profile_photo_path' => 'profile_photos/profileDanny.jpg',
                'location' => 'Watermael-Boitsfort',
                'bio' => 'Freelance illustrator and tattoo artist. DM for appointments. Sponsored bt @jconly_official',
                'instagram_link' => 'instagram.com/danny.bautista__/',
                'experience_years' => 'More than 10 years',
            ],
            [
                'name' => 'Anne-Catherine Pardon',
                'login' => 'annecathpardon',
                'email' => 'annecatherine@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'client',
                'gender' => 'female',
                'profile_photo_path' => null,
                'location' => null,
                'bio' => null,
                'instagram_link' => null,
                'experience_years' => null,
            ],
            [
                'name' => 'Dahan Lee',
                'login' => 'dahan.orient',
                'email' => 'dahan@gmail.com',
                'password' => Hash::make('epfcepfc'),
                'role' => 'tattoo artist',
                'gender' => 'non-binary',
                'profile_photo_path' => 'profile_photos/profileDahan.jpg',
                'location' => 'Etterbeek',
                'bio' => null,
                'instagram_link' => 'instagram.com/dahan.orient/',
                'experience_years' => 'More than 10 years',
            ],

        ];

        // Insérer les utilisateurs et gérer l'image de profil
        foreach ($users as $userData) {
            $user = User::create($userData);

            // Copier l'image de profil si elle est spécifiée
            if ($user->profile_photo_path) {
                $this->copyProfilePhoto($user->profile_photo_path);
            }
        }
    }

    private function copyProfilePhoto(string $relativePath): void
    {
        $sourcePath = database_path('seeders/images/' . $relativePath);
        $destinationPath = 'public/' . $relativePath;

        // Vérifie si le fichier n'existe pas déjà dans le stockage, puis le copie
        if (!Storage::disk('public')->exists($relativePath)) {
            if (File::exists($sourcePath)) {
                Storage::disk('public')->put($relativePath, file_get_contents($sourcePath));
            }
        }
    }
}
