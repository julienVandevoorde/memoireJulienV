<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Référence à la table users pour le tatoueur
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade'); // Référence à la table users pour le client
            $table->integer('rating');
            $table->text('comment')->nullable(); // Le champ 'text' n'a pas besoin de spécifier une longueur
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
