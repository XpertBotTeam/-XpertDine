<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'phoneNumber',
        'images',
        'category',
      
        'city',
        'openTime',
        'closeTime'
    ];

    protected $casts=[
        'images' => 'array'
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
