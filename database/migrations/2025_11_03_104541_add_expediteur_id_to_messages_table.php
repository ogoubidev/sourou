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
        Schema::table('messages', function (Blueprint $table) {
            $table->unsignedBigInteger('expediteur_id')->after('conversation_id');
    
            // Si tu veux la relation User → Message
            $table->foreign('expediteur_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['expediteur_id']);
            $table->dropColumn('expediteur_id');
        });
    }
    
};
