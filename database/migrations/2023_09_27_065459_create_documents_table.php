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
        Schema::create('tbl_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->tinyInteger('visibility')->default(0);
            $table->string('publisher', 255)->nullable();
            $table->string('description');
            $table->dateTime('publishedDate');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('tbl_categories');
            $table->string('fileURL');
            $table->string('status')->nullable();
            $table->double('rating')->default(0);
            $table->double('nUserRated')->default(0);
            $table->integer('view_count')->default(0);
            $table->integer('dl_count')->default(0);
            $table->string('photo_path');
            $table->string('remarks');
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
        Schema::dropIfExists('tbl_documents');
    }
};
