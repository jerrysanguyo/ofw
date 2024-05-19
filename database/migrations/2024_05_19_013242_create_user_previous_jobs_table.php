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
        Schema::create('user_previous_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('job_id')->constrained('type_jobs');
            $table->foreignId('sub_job_id')->constrained('type_sub_jobs');
            $table->foreignId('continent_id')->constrained('type_continents');
            $table->foreignId('country_id')->constrained('type_countries');
            $table->integer('years_abbroad');
            $table->foreignId('contract_id')->constrained('type_contracts');
            $table->date('last_departure');
            $table->date('last_arrival');
            $table->foreignId('owwa_id')->constrained('type_owwas');
            $table->string('intent_return');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_previous_jobs');
    }
};
