<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    // Define the fields that are safe to be mass assigned
    protected $fillable = [
        'course_name',
        'level',
        'description',
         'day',
        'time',
        'user_id'
       
    ];

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'timetables';
}