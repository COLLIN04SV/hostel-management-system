<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    protected $fillable = [

        'student_id',

        'allocation_id',

        'room_fee',

        'amount_paid',

        'balance',

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

    public function allocation()
    {
        return $this->belongsTo(Allocation::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper
    |--------------------------------------------------------------------------
    */

    public function updateStatus()
    {
        if ($this->balance <= 0) {

            $this->status = 'Completed';

        } elseif ($this->amount_paid > 0) {

            $this->status = 'Partial';

        } else {

            $this->status = 'Pending';

        }

        $this->save();
    }

    public function payments()
{
    return $this->hasMany(Payment::class);
}
}