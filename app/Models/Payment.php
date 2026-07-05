<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'amount',
        'payment_method',
        'transaction_reference',
        'payment_date',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}