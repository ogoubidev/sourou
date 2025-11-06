<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('biens', function (Blueprint $table) {
            // Ajouter la colonne 'etat'
            $table->string('etat')->nullable()->after('categorie');

            // Modifier la catégorie existante : 'parcelles' → 'terrain'
            $table->string('categorie')->default('maisons')->change();
        });

        DB::table('biens')->where('categorie', 'parcelles')->update(['categorie' => 'terrain']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biens', function (Blueprint $table) {
            $table->dropColumn('etat');

            DB::table('biens')->where('categorie', 'terrain')->update(['categorie' => 'parcelles']);
        });
    }
};
