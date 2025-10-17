<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // Define the fields that are safe to be mass assigned
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'user_id'
    ];

    // Optional: Define date casting for automatic Carbon instance conversion
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Define the relationship to the User who created the event
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}