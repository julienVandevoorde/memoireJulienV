<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('login', 30)->unique();
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role'); // client, tattoo artist, admin
            $table->string('gender')->nullable(); // homme, femme, non binaire, autre
            $table->string('profile_photo_path')->nullable(); // Chemin de la photo de profil

            // Champs spécifiques pour les tatoueurs
            $table->string('location')->nullable(); // Localisation du tatoueur
            $table->text('bio')->nullable(); // Bio du tatoueur
            $table->string('instagram_link')->nullable(); // Lien vers Instagram
            $table->string('experience_years')->nullable(); // Années d'expérience

            $table->rememberToken();
            $table->timestamps();

            // Indexation pour optimiser les requêtes par rôle
            $table->index('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}
