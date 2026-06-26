<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Allocation;

class Room extends Model
{
    protected $fillable = [
        'hostel_id',
        'room_number',
        'floor',
        'capacity',
        'occupied',
        'price',
        'status'
    ];

    public function hostel()
    {
        return $this->belongsTo(Hostel::class);
    }

    public function getAvailableBedsAttribute()
    {
        return $this->capacity - $this->occupied;
    }

    public function allocations()
    {
    return $this->hasMany(Allocation::class);
    }

    public function occupiedBeds()
    {
    return $this->allocations()
        ->where('status', 'Active')
        ->count();
    }

    public function availableBeds()
    {
    return $this->capacity - $this->occupiedBeds();
    }
}