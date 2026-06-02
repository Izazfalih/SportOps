<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DynamicPricing extends Model
{
    protected $fillable = [
        'field_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'harga',
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
