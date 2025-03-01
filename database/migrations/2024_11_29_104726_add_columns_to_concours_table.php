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
        Schema::table('concours', function (Blueprint $table) {
            $table->string('resultat_ecrit')->nullable();
            $table->string('resultat_orale')->nullable();
            $table->integer('age_limit')->nullable();
            $table->integer('nombres_de_postes')->nullable();
            $table->date('date_concours')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('concours', function (Blueprint $table) {
            $table->dropColumn(['resultat_ecrit', 'resultat_orale', 'age_limit', 'nombres_de_postes', 'date_concours']);
        });
    }
};
