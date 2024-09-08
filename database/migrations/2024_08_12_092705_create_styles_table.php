<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Table des styles
        Schema::create('styles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->unique();
            $table->timestamps();
        });

        // Insérer les styles directement dans la table 'styles'
        $styles = [
            "Abstract",
            "Anime",
            "Black & Grey",
            "Blackwork",
            "Chicano",
            "Dotwork",
            "Etching (Engraving)",
            "Floral",
            "Fineline",
            "Geometric",
            "Hand-Poked",
            "Micro Realism",
            "Dark Art",
            "Japanese (Irezumi)",
            "Bold lettering",
            "Small lettering",
            "Neo Traditional",
            "Neotribal",
            "New School",
            "Ornamental",
            "Realism",
            "Illustrative",
            "Old School (Traditional)",
            "Trash Polka Style",
            "Tribal",
            "Watercolor",
            "Surrealism",
            "Cosmetic",
            "Ignorant"
        ];

        foreach ($styles as $style) {
            DB::table('styles')->insert(['name' => $style, 'created_at' => now(), 'updated_at' => now()]);
        }

        // Table pivot entre styles et utilisateurs (tatoueurs)
        Schema::create('style_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('style_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('style_user');
        Schema::dropIfExists('styles');
    }
};
