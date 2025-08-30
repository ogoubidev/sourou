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
        Schema::table('biens', function (Blueprint $table) {
            // Ajouter une colonne 'categorie' avec des valeurs possibles
            $table->enum('categorie', ['maisons', 'parcelles', 'vehicules', 'mobilier'])
                  ->default('maisons')
                  ->after('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biens', function (Blueprint $table) {
            $table->dropColumn('categorie');
        });
    }
};
