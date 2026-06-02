<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'field_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'total_harga',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    public function checkin()
    {
        return $this->hasOne(Checkin::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
