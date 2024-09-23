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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sprint_id');
            $table->unsignedBigInteger('backlog_id')->nullable();
            $table->unsignedBigInteger('project_id');
            $table->string('ticket_name');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('position');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('duration');
            $table->unsignedBigInteger('backlog_created_by')->nullable();
            $table->unsignedBigInteger('ticket_created_by');
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
