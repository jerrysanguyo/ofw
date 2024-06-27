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
        Schema::table('type_barangays', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_cities', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_civil_statuses', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_continents', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_contracts', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_countries', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_educational_attainments', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_genders', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_ids', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_jobs', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_owwas', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_relations', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_religions', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_residences', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });

        Schema::table('type_sub_jobs', function (Blueprint $table) {
            $table->string('remarks')->after('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('type_barangays', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_cities', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_civil_statuses', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_continents', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_contracts', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_countries', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_educational_attainments', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_genders', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_ids', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_jobs', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_owwas', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_relations', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_religions', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_residences', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });

        Schema::table('type_sub_jobs', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
};