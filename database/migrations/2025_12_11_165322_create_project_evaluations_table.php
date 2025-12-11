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
        Schema::create('project_evaluations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('evaluator_id'); // User who created the evaluation
            $table->unsignedBigInteger('team_member_id'); // User who is being evaluated
            $table->string('nama_tim');
            $table->integer('efektivitas_sistem'); // 1-10
            $table->integer('produktivitas_tim');  // 1-10
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('evaluator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('team_member_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_evaluations');
    }
};
