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
        Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('password');
                $table->string('name');
                $table->varchar('firstname', 50);
                $table->varchar('middlename', 50);
                $table->varchar('lastname', 50);
                $table->unsignedBigInteger('affiliation')->default(1);
                $table->foreign('affiliation')->references('affiliation_id')->on('affiliations');
                $table->string('email')->unique();
                $table->string('photo_path');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('editedBy')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
