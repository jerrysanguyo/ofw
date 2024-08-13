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
        Schema::create('archive_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_archive_id')->constrained('archive_users');
            $table->string('house_number');
            $table->foreignId('barangay_id')->constrained('type_barangays');
            $table->string('street');
            $table->foreignId('city_id')->constrained('Type_cities');
            $table->integer('residence_years');
            $table->foreignId('residence_id')->constrained('type_residences');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_addresses');
    }
};
