<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique('users_email_unique'); // Drops the unique constraint
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // You might want to add back the unique constraint in the down method if you ever rollback the migration
            $table->unique('email');
        });
    }
};
