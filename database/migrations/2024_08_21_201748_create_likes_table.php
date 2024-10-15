<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade'); // Directement lié au portfolio
            $table->timestamps();

            $table->unique(['user_id', 'portfolio_id']); // Un utilisateur ne peut liker un tatouage qu'une seule fois
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
