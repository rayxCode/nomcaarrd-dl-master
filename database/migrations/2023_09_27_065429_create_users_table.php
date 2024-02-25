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
        // Migration file for tbl_users table
        Schema::create('tbl_users', function (Blueprint $table) {
            $table->id();
            $table->integer('access');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('username');
            $table->string('firstname', 50);
            $table->string('middlename', 50)->nullable();
            $table->string('lastname', 50);
            $table->unsignedBigInteger('affiliation_id')->default(1);
            $table->foreign('affiliation_id')->references('id')->on('tbl_affiliations');
            $table->tinyInteger('status');
            $table->timestamp('verified_email_at')->nullable();
            $table->string('photo_path')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->foreign('edited_by')->references('id')->on('tbl_users')->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_users');
    }
};
