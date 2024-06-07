<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // creat table heroes
        Schema::create('heroes', function (Blueprint $table) {
            // Création des colonnes de la base de données heroes
            // Creat columns of the heroes database
            $table->id();
            $table->string('name');
            $table->string('gender');
            $table->string('race');
            $table->text('description');
            $table->foreignId('skill_id')->constrained('skills');
            $table->foreignId('universe_id')->nullable()->constrained('universes');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};