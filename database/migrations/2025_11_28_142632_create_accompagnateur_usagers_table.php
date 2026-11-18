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
        Schema::create('accompagnateur_usagers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('accompagnateur_id');
            $table->foreign('accompagnateur_id')->references('id')->on('accompagnateurs')->onDelete('cascade');
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
        Schema::dropIfExists('accompagnateur_usagers');
    }
};
