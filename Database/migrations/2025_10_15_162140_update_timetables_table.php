<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        Schema::table('timetables', function (Blueprint $table) {
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->string('title');
           $table->string('file_path');
            $table->text('description')->nullable();
            $table->boolean('is_archived')->default(false);
            $table->dropColumn(['column_name', 'day', 'time', 'lecturer']);

        });
    }
};
