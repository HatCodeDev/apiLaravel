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
        Schema::create('bebidas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo',80);
            $table->foreignId('tostados_id')->constrained('tostados')->onUpdate('cascade')->onDelete('restrict');
            $table->decimal('precio', 5, 2); 
            $table->string('filtracion', 100); 
            $table->string('altura', 50); 
            $table->string('complementos',100);
            $table->string('imagen',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bebidas');
    }
};
