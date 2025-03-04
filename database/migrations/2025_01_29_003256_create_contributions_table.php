<?php

use App\Enums\ContributionStatusEnum;
use App\Enums\ContributionTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contributor_id');
            $table->enum('type', array_column(ContributionTypeEnum::cases(), 'value'));
            $table->decimal('value')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table
                ->enum('status', array_column(ContributionStatusEnum::cases(), 'value'))
                ->default(ContributionStatusEnum::PENDING);
            $table->timestamps();

            $table->foreign('contributor_id')->references('id')->on('contributors')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
