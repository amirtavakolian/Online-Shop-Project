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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('is_opened')->default(0);
            $table->enum('status', ['pending', 'reviewing', 'responded', 'publish_later', 'closed']);
            $table->text('content');
            $table->enum('priority', ['high', 'medium', 'low']);
            $table->timestamp('published_at');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('department_id')->comment('define the departmant of the ticket');
            $table->unsignedBigInteger('coworker_id')->nullable()->comment('which coworker has opened the ticket first');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('coworker_id')->references('id')->on('coworkers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
