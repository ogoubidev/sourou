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
        Schema::create('signalements', function (Blueprint $table) {
            $table->id();

            // Client qui a signalé le problème
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');

            // Type de problème (ex: bug, paiement, bien, autre)
            $table->string('categorie')->nullable();

            // Description détaillée du problème
            $table->text('description');

            // Statut du signalement
            $table->enum('statut', ['en_attente', 'en_cours', 'resolu'])->default('en_attente');

            // Optionnel : réponse de l’administrateur
            $table->text('reponse_admin')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signalements');
    }
};
