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
        Schema::create('type_needs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->string('remarks');
            $table->timestamps();
        });

        Schema::table('user_needs', function (Blueprint $table) {
            $table->dropColumn('needs');
            $table->foreignId('need_id')->after('id')->cosntrained('type_needs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_needs', function(Blueprint $table) {
            $table->dropForeignId(['need_id']);
            $table->dropColumn('need_id');
            $table->string('needs');
        });

        Schema::dropIfExists('type_needs');
    }
};
