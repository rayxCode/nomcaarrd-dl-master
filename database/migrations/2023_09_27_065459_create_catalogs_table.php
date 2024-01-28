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
            Schema::create('catalogs', function (Blueprint $table) {
                $table->id();
                $table->string('title')->unique();
                $table->tinyInteger('visibility')->default(0);
                $table->json('authors')->nullable();
                $table->varchar('publisher', 255)->nullable();
                $table->string('description');
                $table->dateTime('publishedDate');
                $table->unsignedBigInteger('type_id');
                $table->foreign('type_id')->references('id')->on('catalogTypes');
                $table->string('fileURL');
                $table->string('status')->nullable();
                $table->double('rating')->default(0);
                $table->double('nUserRated')->default(0);
                $table->int('view_count')->default(0);
                $table->int('dl_count')->default(0);
                $table->string('photo_path');
                $table->string('editedBy')->nullable();
                $table->string('remarks');
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalogs');
    }
};
