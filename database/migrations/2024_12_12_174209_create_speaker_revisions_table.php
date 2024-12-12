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
        Schema::create('speaker_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('speaker_id')->constrained()->onDelete('cascade');
            $table->text('changes'); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('changed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speaker_revisions');
    }
};
