<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'student_id',
        'hostel_id',
        'status',
        'remarks',
        'application_date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }
}