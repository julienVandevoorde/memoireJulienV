<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Zephyr Jonnaert',
            'login' => 'zeph',
            'email' => 'zeph@gmail.com',
            'password' => Hash::make('epfcepfc'),
            'role' => 'tattoo artist',
            'gender' => 'male',
            'profile_photo_path' => null,
            'location' => 'Watermael-Boitsfort',
            'bio' => 'Experienced tattoo artist since 2020',
            'instagram_link' => 'https://www.instagram.com/zeppetto.ta2/',
            'experience_years' => 5,
        ]);

        User::create([
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
        ]);

        User::create([
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
        ]);
    }
}
