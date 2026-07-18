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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');
            $table->dateTime('date_time');
            $table->string('place_city');
            $table->string('place_address');
            $table->unsignedTinyInteger('buffer_time');
            $table->unsignedTinyInteger('distance');
            $table->unsignedTinyInteger('pace');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
