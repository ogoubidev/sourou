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
        Schema::create('temoignages', function (Blueprint $table) {
            $table->id(); 
            $table->string('name'); 
            $table->string('surname'); 
            $table->string('role')->nullable();
            $table->text('message'); 
            $table->string('photo')->nullable(); 
            $table->tinyInteger('note')->default(5); // note sur 5 $table->timestamps(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temoignages');
    }
};
