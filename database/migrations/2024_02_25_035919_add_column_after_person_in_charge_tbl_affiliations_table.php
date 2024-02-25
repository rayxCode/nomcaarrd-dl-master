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
        Schema::table('tbl_affiliations', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('edited_by')->nullable()->after('person_in_charge');
            $table->foreign('edited_by')->references('id')->on('tbl_users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('charge_affiliations', function (Blueprint $table) {
            //
        });
    }
};
