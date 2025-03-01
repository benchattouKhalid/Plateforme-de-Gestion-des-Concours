<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('concours', function (Blueprint $table) {
        $table->string('avis')->nullable()->after('description'); // File path for the notice
    });
}

public function down()
{
    Schema::table('concours', function (Blueprint $table) {
        $table->dropColumn('avis');
    });
}

};
