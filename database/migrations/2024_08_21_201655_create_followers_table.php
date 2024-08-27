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
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade'); // L'utilisateur qui suit
            $table->foreignId('followed_id')->constrained('users')->onDelete('cascade'); // L'utilisateur suivi
            $table->timestamps();

            $table->unique(['follower_id', 'followed_id']); // Un utilisateur ne peut suivre qu'une seule fois un autre utilisateur
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
