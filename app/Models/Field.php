<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
        'venue_id',
        'nama_lapangan',
        'jenis_olahraga',
        'status',
        'harga',
        'deskripsi',
        'foto',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function dynamicPricings()
    {
        return $this->hasMany(DynamicPricing::class);
    }
}
