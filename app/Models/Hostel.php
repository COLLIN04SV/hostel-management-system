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
    'total_rooms',
    'description',
    'status'
];

    public function rooms()
{
    return $this->hasMany(Room::class);
}

}