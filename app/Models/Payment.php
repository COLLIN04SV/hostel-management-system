<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'student_id',
        'student_account_id',
        'amount',
        'payment_method',
        'transaction_reference',
        'payment_date',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function account()
    {
        return $this->belongsTo(StudentAccount::class);
    }
}