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
        Schema::create('tbl_requests', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default(0);
            $table->date('expires_on');
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('tbl_documents')->onDelete('cascade');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_requests');
    }
};
