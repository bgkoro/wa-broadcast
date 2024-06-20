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
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->string('phone_number');
            $table->string('provider');
            $table->enum('status', ['onprocess', 'delivered', 'rejected', 'undelivered'])->default('onprocess');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
    }
};
