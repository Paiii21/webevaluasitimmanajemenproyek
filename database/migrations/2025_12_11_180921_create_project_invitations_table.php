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
        Schema::create('project_invitations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('email'); // Email of the invited user
            $table->unsignedBigInteger('inviter_id'); // User who sent the invitation
            $table->enum('role', ['member', 'manager'])->default('member');
            $table->string('token')->unique(); // Unique token for invitation acceptance
            $table->timestamp('accepted_at')->nullable(); // When the invitation was accepted
            $table->timestamp('expires_at')->nullable(); // When the invitation expires
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('inviter_id')->references('id')->on('users')->onDelete('cascade');

            // Index for email lookups
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_invitations');
    }
};
