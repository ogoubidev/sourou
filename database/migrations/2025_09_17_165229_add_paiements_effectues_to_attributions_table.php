<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('attributions', function (Blueprint $table) {
            $table->integer('paiements_effectues')->default(0);
            $table->integer('mois_total')->default(1); // nombre de paiements attendus
        });
    }
    
    public function down(): void
    {
        Schema::table('attributions', function (Blueprint $table) {
            $table->dropColumn(['paiements_effectues', 'mois_total']);
        });
    }
    
};
