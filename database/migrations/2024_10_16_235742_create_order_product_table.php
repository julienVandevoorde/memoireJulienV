<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Relation avec la commande
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relation avec le produit
            $table->integer('quantity'); // Quantité du produit commandé
            $table->decimal('price', 8, 2); // Prix du produit au moment de la commande
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
