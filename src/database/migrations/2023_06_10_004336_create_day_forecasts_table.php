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
        Schema::create('day_forecasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id')->nullable(true);
            $table->decimal('average_temperature', 3, 1);
            $table->decimal('maximum_temperature', 3, 1);
            $table->decimal('minimum_temperature', 3, 1);
            $table->date('date');
            $table->timestamps();

            $table->foreign('report_id')
            ->references('id')
            ->on('reports')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_forecasts');
    }
};
