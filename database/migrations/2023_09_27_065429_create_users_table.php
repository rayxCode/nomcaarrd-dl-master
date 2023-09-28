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
                $table->id('users_id');
                $table->string('password');
                $table->string('name');
                $table->dateTime('birthdate');
                $table->unsignedBigInteger('affiliation');
                $table->foreign('affiliation')->references('affiliation_id')->on('affiliations');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('editedBy');
                $table->rememberToken();
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
