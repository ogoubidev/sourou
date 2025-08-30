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
        Schema::table('locations', function (Blueprint $table) {
            $table->enum('statut', ['en_attente', 'attribue', 'disponible'])
                  ->default('en_attente')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->enum('statut', ['en_attente_paiement', 'payee', 'annulee'])
                  ->default('en_attente_paiement')
                  ->change();
        });
    }
};
