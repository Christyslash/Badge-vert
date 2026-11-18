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
        Schema::create('badges', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('statut', ['actif', 'inactif', 'expiré'])->default('actif');
            $table->date('date_edition');
            $table->date('date_expiration');
            $table->unsignedBigInteger('usager_id');
            $table->foreign('usager_id')->references('id')->on('usagers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('badges');
    }
};
