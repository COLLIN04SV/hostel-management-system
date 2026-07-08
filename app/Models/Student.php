<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'registration_number',
        'phone',
        'gender',
        'department',
        'year_of_study',
        'guardian_name',
        'guardian_phone',
        'address',
        'profile_photo'
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function allocation()
{
    return $this->hasOne(Allocation::class)
        ->where('status', 'Active');
}

public function applications()
{
    return $this->hasMany(Application::class);
}

public function payments()
{
    return $this->hasMany(Payment::class);
}

public function allocations()
{
    return $this->hasMany(Allocation::class);
}

public function supportTickets()
{
    return $this->hasMany(SupportTicket::class);
}

}