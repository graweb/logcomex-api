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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->char('code', 10); // Exemplo de coluna CHAR
            $table->string('name', 200); // Exemplo de coluna VARCHAR
            $table->text('description'); // Exemplo de coluna TEXT
            $table->integer('quantity'); // Exemplo de coluna INTEGER
            $table->integer('minimum_quantity')->nullable(); // Exemplo de coluna INTEGER
            $table->decimal('amount', 10,2)->default(0); // Exemplo de coluna DECIMAL
            $table->decimal('minimum_amount', 10,2)->default(0); // Exemplo de coluna DECIMAL
            $table->string('country')->nullable(); // Exemplo de coluna VARCHAR
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
