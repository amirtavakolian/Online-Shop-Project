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
        Schema::create('ticket_department_refer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coworker_id');
            $table->foreign('coworker_id')->references('id')->on('coworkers');
            $table->unsignedBigInteger('from_department');
            $table->foreign('from_department')->references('id')->on('departments');
            $table->unsignedBigInteger('to_department');
            $table->foreign('to_department')->references('id')->on('departments');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_department_refer');
    }
};
