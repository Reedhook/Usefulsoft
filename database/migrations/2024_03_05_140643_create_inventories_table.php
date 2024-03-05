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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название инвентаря');
            $table->string('status')->default('свободен')->comment('Статус инвентаря');
            $table->unsignedInteger('price_per_day')->comment('оплата за день');
            $table->unsignedInteger('price_per_week')->comment('оплата за неделю');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
