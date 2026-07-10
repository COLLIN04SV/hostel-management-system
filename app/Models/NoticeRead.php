<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoticeRead extends Model
{
    protected $fillable = [
        'notice_id',
        'student_id'
    ];

    public function notice()
    {
        return $this->belongsTo(Notice::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}