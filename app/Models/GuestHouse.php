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
        'address', 
        'Phone for reservation'
    ];
}
              