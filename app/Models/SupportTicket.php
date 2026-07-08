<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'student_id',
        'subject',
        'message',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}