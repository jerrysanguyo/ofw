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
        Schema::create('archive_households', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_archive_id')->constrained('archive_users');
            $table->string('full_name');
            $table->foreignId('relation_id')->constrained('type_relations');
            $table->string('birthdate');
            $table->integer('age');
            $table->string('work');
            $table->integer('monthly_income');
            $table->string('voters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_households');
    }
};
