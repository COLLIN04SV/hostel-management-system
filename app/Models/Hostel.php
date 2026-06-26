<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'capacity',
        'location',
        'description'
    ];

    public function rooms()
{
    return $this->hasMany(Room::class);
}

}