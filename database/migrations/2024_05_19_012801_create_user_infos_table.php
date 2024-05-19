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
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->date('birthdate');
            $table->integer('age');
            $table->foreignId('gender_id')->constrained('type_genders');
            $table->string('birthplace');
            $table->foreignId('religion_id')->constrained('type_religions');
            $table->foreignId('civil_id')->constrained('type_civil_statuses');
            $table->string('present_job');
            $table->foreignId('education_id')->constrained('type_educational_attainments');
            $table->string('voters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_infos');
    }
};
