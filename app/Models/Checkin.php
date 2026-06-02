<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    protected $fillable = [
        'booking_id',
        'penjaga_id',
        'waktu_checkin',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function penjaga()
    {
        return $this->belongsTo(User::class, 'penjaga_id');
    }
}
