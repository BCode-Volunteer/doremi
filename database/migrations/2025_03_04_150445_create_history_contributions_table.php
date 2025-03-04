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
        Schema::create('contributions_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contribution_id');
            $table->decimal('amount');
            $table->date('date');
            $table->timestamps();

            $table->foreign('contribution_id')->references('id')->on('contributions')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_contributions');
    }
};
