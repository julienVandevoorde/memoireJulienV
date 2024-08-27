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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // L'utilisateur qui like
            $table->morphs('likeable'); // Contenu qui est liké (post, portfolio, etc.)
            $table->timestamps();

            $table->unique(['user_id', 'likeable_id', 'likeable_type']); // Un utilisateur ne peut liker un élément qu'une seule fois
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
