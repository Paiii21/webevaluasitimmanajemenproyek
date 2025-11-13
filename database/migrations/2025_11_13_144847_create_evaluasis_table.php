<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evaluasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // relasi ke user
            $table->string('nama_tim');
            $table->integer('efektivitas_sistem');
            $table->integer('produktivitas_tim');
            $table->text('catatan')->nullable();
            $table->timestamps();

            // foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evaluasis');
    }
};
