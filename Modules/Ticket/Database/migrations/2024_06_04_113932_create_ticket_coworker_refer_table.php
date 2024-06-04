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
        Schema::create('ticket_coworker_refer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_coworker');
            $table->foreign('from_coworker')->references('id')->on('coworkers');
            $table->unsignedBigInteger('to_coworker');
            $table->foreign('to_coworker')->references('id')->on('coworkers');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_coworker_refer');
    }
};
