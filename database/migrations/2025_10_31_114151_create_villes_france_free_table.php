<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('villes_france_free', function (Blueprint $table) {
            $table->id('ville_id');
            $table->string('ville_nom');
            $table->string('ville_code_postal', 10);
            $table->string('ville_departement', 3);
            $table->decimal('ville_longitude_deg', 10, 7)->nullable();
            $table->decimal('ville_latitude_deg', 10, 7)->nullable();
            $table->integer('ville_population_2012')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('villes_france_free');
    }
};
