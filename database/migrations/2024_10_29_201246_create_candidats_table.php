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
        Schema::create('candidats', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        $table->string('email')->unique();
        $table->string('CIN')->unique();
        $table->string('telephone')->unique();
        $table->string('adresse');
        $table->string('lieu_de_naissance');
        $table->string('moyenne');
        $table->string('specialte_diplome');
        $table->enum('sexe', ['male', 'female'])->nullable();
        $table->date('date_naissance');
        $table->string('niveauEtude');
        $table->string('diplome');
        $table->string('experienceProfessionnel')->nullable();
        $table->foreignId('concours_id')->constrained()->onDelete('cascade');
        $table->string('candidatNumber')->unique()->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidats');
    }
};
