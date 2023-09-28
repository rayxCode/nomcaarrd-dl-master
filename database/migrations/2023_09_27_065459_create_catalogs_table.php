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
                $table->id('catalog_id');
                $table->string('title')->unique();
                $table->string('description');
                // author_id was here
                $table->dateTime('publishedDate');
                $table->unsignedBigInteger('type_id');
                $table->foreign('type_id')->references('type_id')->on('catalogTypes');
                $table->string('fileURL');
                $table->string('status');
                // comments table was here
                $table->float('rating');
                $table->string('editedBy');
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
