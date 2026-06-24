<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'nama_venue',
        'alamat',
        'kontak',
        'open_time',
        'close_time',
        'dp_percentage',
        'payment_expiry',
        'notif_new_booking',
        'notif_payment',
        'notif_cancel',
        'merchant_name',
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
