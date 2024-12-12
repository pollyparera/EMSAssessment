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
        Schema::create('talk_proposal_revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talk_proposal_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('talk_proposal_revisions');
    }
};
