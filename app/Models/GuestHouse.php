<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestHouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'Facilities',
        'image',
        'prices',
        'location', 
        'Phone for reservation',
        'status'
    ];
}
              