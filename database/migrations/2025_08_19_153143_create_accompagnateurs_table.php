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
        Schema::create('accompagnateurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->string('prenoms');
            $table->string('contact');
            $table->string('email');
            $table->string('numero_badge')->unique();
            $table->unsignedBigInteger('societe_id')->nullable();
            $table->foreign('societe_id')->references('id')->on('societes')->onDelete('set null');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accompagnateurs');
    }
};
