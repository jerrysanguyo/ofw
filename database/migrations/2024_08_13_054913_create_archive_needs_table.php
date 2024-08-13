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
        Schema::create('archive_needs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_archive_id')->constrained('archive_users');
            $table->foreignId('need_id')->constrained('type_needs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_needs');
    }
};
