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
        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->string('code_visite')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('objet');
            $table->string('etat_visite')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('usager_id');
            $table->foreign('usager_id')->references('id')->on('usagers')->onDelete('cascade');
            $table->unsignedBigInteger('accompagnateur_id')->nullable();
            $table->foreign('accompagnateur_id')->references('id')->on('accompagnateurs')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
