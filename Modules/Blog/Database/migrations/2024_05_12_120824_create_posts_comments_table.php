<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->unsigned();
            $table->foreignId('user_id')->unsigned();
            $table->text('content');
            $table->enum('status', [0, 1, 2])->default(0)->comment('0: WAIT | 1: APPROVED | 2: REJECTED');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('posts_comments')->cascadeOnDelete();
            $table->unsignedInteger('like')->default(0);
            $table->unsignedInteger('dislike')->default(0);
            $table->boolean('is_robot_generated')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_comments');
    }
};
