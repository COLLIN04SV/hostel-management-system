<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $fillable = [
        'student_id',
        'room_id',
        'allocated_date',
        'checkout_date',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}