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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('time_to_read');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('view')->default(0);
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->string('stream_url')->nullable();
            $table->unsignedBigInteger('related_post_id')->nullable();
            $table->boolean('disable_comment')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('related_post_id')->references('id')->on('posts')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
