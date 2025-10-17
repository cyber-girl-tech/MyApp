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
        Schema::table('timetables', function (Blueprint $table) {
            $table->enum('level', ['100', '200', '300', '400', '500'])->after('course_name');
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('timetables', function (Blueprint $table) {
             $table->dropColumn('level');
        });
    }
};
