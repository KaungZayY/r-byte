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
        Schema::create('teammate_ticket', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teammate_id');
            $table->unsignedBigInteger('ticket_id');
            $table->unsignedBigInteger('assigned_by');
            $table->unique(['ticket_id','teammate_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teammate_ticket');
    }
};
