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
        Schema::create('talk_proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('speaker_id');
            $table->unsignedBigInteger('tag_id');
            $table->string('title');
            $table->text('description');
            $table->string('pdf_path')->nullable();
            $table->timestamps();

            $table->foreign('speaker_id')->references('id')->on('speakers')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talk_proposals');
    }
};
