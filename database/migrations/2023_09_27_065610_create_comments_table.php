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
        Schema::create('tbl_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('tbl_users')->onDelete('cascade');
            $table->unsignedBigInteger('document_id');
            $table->foreign('document_id')->references('id')->on('tbl_documents')->onDelete('cascade');
            $table->double('rating');
            $table->string('comment');
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
        Schema::dropIfExists('tbl_comments');
    }
};
