<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'nama_venue',
        'alamat',
        'kontak',
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }
}
