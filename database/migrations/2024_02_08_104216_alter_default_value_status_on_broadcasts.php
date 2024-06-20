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
        Schema::table('broadcasts', function (Blueprint $table) {
            $table->enum('status', ['onprocess', 'delivered', 'rejected', 'undelivered'])->default('delivered')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('broadcasts', function (Blueprint $table) {
            $table->enum('status', ['onprocess', 'delivered', 'rejected', 'undelivered'])->default('onprocess')->change();
        });
    }
};
