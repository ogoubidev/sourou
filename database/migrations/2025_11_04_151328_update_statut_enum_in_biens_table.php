<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE biens MODIFY statut ENUM('disponible', 'attribue', 'vendu') NOT NULL DEFAULT 'disponible'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE biens MODIFY statut ENUM('disponible', 'attribue') NOT NULL DEFAULT 'disponible'");
    }
};
