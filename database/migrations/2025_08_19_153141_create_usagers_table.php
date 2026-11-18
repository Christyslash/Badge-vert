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
        Schema::create('usagers', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('prenoms');
            $table->string('contact', 20);
            $table->string('email')->unique()->nullable();
            $table->string('objet');
            $table->enum('statut_usager', ['actif', 'inactif', 'suspendu'])->default('actif');
            $table->string('photo');
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->unsignedBigInteger('societe_id');
            $table->foreign('societe_id')->references('id')->on('societes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usagers');
    }
};
