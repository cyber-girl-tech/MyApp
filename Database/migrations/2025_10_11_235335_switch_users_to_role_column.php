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
        Schema::table('users', function (Blueprint $table) {
            //1.Drop the old boolean column
            $table->dropColumn('is_admin');

            $table->string('role')->default('student');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //Undo the change: drop 'role' and add back 'is_admin'
            $table->dropColumn('role');
           
        });
    }
};
